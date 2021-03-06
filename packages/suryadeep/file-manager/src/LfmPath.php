<?php

namespace Mafftor\LaravelFileManager;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Mafftor\LaravelFileManager\Events\ImageIsUploading;
use Mafftor\LaravelFileManager\Events\ImageWasUploaded;

class LfmPath
{
    private $working_dir;
    private $item_name;
    private $item_file_name;
    private $is_thumb = false;

    private $helper;

    public function __construct(Lfm $lfm = null)
    {
        $this->helper = $lfm;
    }

    public function __get($var_name)
    {
        if ($var_name == 'storage') {
            return $this->helper->getStorage($this->path('url'));
        }
    }

    public function __call($function_name, $arguments)
    {
        return $this->storage->$function_name(...$arguments);
    }

    public function dir($working_dir)
    {
        $this->working_dir = $working_dir;

        return $this;
    }

    public function thumb($is_thumb = true)
    {
        $this->is_thumb = $is_thumb;

        return $this;
    }

    public function setName($item_name)
    {
        // dd($item_name);
        $this->item_name = $item_name;

        return $this;
    }

    public function getName()
    {
        // dd($this->item_name);
        return $this->item_name;
    }

    public function setFileName($item_file_name)
    {
        $this->item_file_name = $item_file_name;

        return $this;
    }

    public function getFileName()
    {
        return $this->item_file_name;
    }

    public function path($type = 'storage')
    {
        if ($type == 'working_dir') {
            // working directory: /{user_slug}
            return $this->translateToLfmPath($this->normalizeWorkingDir());
        } elseif ($type == 'url') {
            // storage: files/{user_slug}
            return $this->helper->getCategoryName() . $this->path('working_dir');
        } elseif ($type == 'storage') {
            // storage: files/{user_slug}
            // storage on windows: files\{user_slug}
            // dd( $this->translateToOsPath($this->path('url')));
            return $this->translateToOsPath($this->path('url'));
        } else {
            // absolute: /var/www/html/project/storage/app/files/{user_slug}
            // absolute on windows: C:\project\storage\app\files\{user_slug}

            return $this->storage->rootPath() . $this->path('storage');
        }
    }

    public function translateToLfmPath($path)
    {
        return str_replace($this->helper->ds(), Lfm::DS, $path);
    }

    public function translateToOsPath($path)
    {
        return str_replace(Lfm::DS, $this->helper->ds(), $path);
    }

    public function url()
    {
        // dd($this->storage->url($this->path('url')));
        return $this->storage->url($this->path('url'));
    }

    public function folders()
    {
        $all_folders = $this->storage->directories();
        if ($this->helper->input('search')) {
            $search = preg_quote($this->helper->input('search'), '/');
            $all_folders = preg_grep('/' . $search . '[^\/]*$/iu', $all_folders);
        }

        $all_folders = array_map(function ($directory_path) {
            return $this->pretty($directory_path, true);
        }, $all_folders);

        $folders = array_filter($all_folders, function ($directory) {
            return $directory->name !== $this->helper->getThumbFolderName();
        });

        return $this->sortByColumn($folders);
    }

    public function files()
    {
        $files = $this->storage->files();
        if ($this->helper->input('search')) {
            $files = preg_grep('/' . preg_quote($this->helper->input('search'), '/') . '[^\/]*$/iu', $files);
        }

        $files = array_map(function ($file_path) {
            return $this->pretty($file_path);
        }, $files);

        return $this->sortByColumn($files);
    }

    public function pretty($item_path, bool $isDirectory = false)
    {
        return Container::getInstance()->makeWith(LfmItem::class, [
            'lfm' => (clone $this)->setName($this->helper->getNameFromPath($item_path))
                ->setFileName($this->helper->getNameFromPath($item_path, PATHINFO_FILENAME)),
            'helper' => $this->helper,
            'isDirectory' => $isDirectory,
        ]);
    }

    public function delete()
    {
        if ($this->isDirectory()) {
            return $this->storage->deleteDirectory();
        } else {
            return $this->storage->delete();
        }
    }

    /**
     * Create folder if not exist.
     *
     * @return mixed
     */
    public function createFolder()
    {
        if ($this->storage->exists($this)) {
            return false;
        }

        $this->storage->makeDirectory(0777, true, true);
    }

    public function isDirectory()
    {
        $working_dir = $this->path('working_dir');
        $parent_dir = substr($working_dir, 0, strrpos($working_dir, '/'));

        $parent_directories = array_map(function ($directory_path) {
            return app(static::class)->translateToLfmPath($directory_path);
        }, app(static::class)->dir($parent_dir)->directories());

        return in_array($this->path('url'), $parent_directories);
    }

    /**
     * Check a folder and its subfolders is empty or not.
     *
     * @return bool
     */
    public function directoryIsEmpty()
    {
        return count($this->storage->allFiles()) == 0;
    }

    public function normalizeWorkingDir()
    {
        $path = $this->working_dir
            ?: $this->helper->input('working_dir')
            ?: $this->helper->getRootFolder();
        if ($this->is_thumb) {
            // Prevent if working dir is "/" normalizeWorkingDir will add double "//" that breaks S3 functionality
            $path = rtrim($path, Lfm::DS) . Lfm::DS . $this->helper->getThumbFolderName();
        }
        if ($this->getName()) {
            // if(is_array($this->getName())){
            //     dd($this->getName());
            // }
            // Prevent if working dir is "/" normalizeWorkingDir will add double "//" that breaks S3 functionality
            if (is_array($this->getName())) {
                // dd($this->getName());
                $name = $this->getName()['name'];
            } else {
                $name = $this->getName();
            }
            $path = rtrim($path, Lfm::DS) . Lfm::DS . $name;
        }
        return $path;
    }
 
    /**
     * Sort files and directories.
     *
     * @param mixed $arr_items Array of files or folders or both.
     * @return array of object
     */
    public function sortByColumn($arr_items)
    {
        $sort_by = $this->helper->input('sort_type');
        if (in_array($sort_by, ['name', 'time'])) {
            $key_to_sort = $sort_by;
        } else {
            $key_to_sort = 'name';
        }

        usort($arr_items, function ($a, $b) use ($key_to_sort) {
            if($key_to_sort == 'time'){
                return strcmp($b->{$key_to_sort}, $a->{$key_to_sort});

            }else {
                return strcmp($a->{$key_to_sort}, $b->{$key_to_sort});

            }
        });

        return $arr_items;
    }

    public function error($error_type, $variables = [])
    {
        return $this->helper->error($error_type, $variables);
    }

    // Upload section
    public function upload($file)
    {
        if (true !== $errors = $this->uploadValidator($file)) {
            return $errors;
        }

        $new_file_name = $this->getNewName($file);
        $new_file_path = $this->setName($new_file_name)->path('absolute');

        event(new ImageIsUploading($new_file_path));
        try {
            $new_file_name = $this->saveFile($file, $new_file_name);
        } catch (Exception $e) {
            Log::info($e);
            return $this->error('invalid');
        }
        // TODO should be "FileWasUploaded"
        event(new ImageWasUploaded($new_file_path));

        return $this->pretty($new_file_name)->fill()->attributes;
    }

    /**
     * Validate file upload
     *
     * @param $file
     * @return bool|JsonResponse
     * @throws Exception
     */
    private function uploadValidator($file)
    {
        if (empty($file)) {
            return $this->error('file-empty');
        } elseif (!$file instanceof UploadedFile) {
            return $this->error('instance');
        } elseif ($file->getError() == UPLOAD_ERR_INI_SIZE) {
            return $this->error('file-size', ['max' => ini_get('upload_max_filesize')]);
        } elseif ($file->getError() != UPLOAD_ERR_OK) {
            throw new Exception('File failed to upload. Error code: ' . $file->getError());
        }

        $new_file_name = $this->getNewName($file);

        if ($this->setName($new_file_name)->exists() && config('lfm.rename_file.duplicate', '-%s') === false) {
            return $this->error('file-exist');
        }

        if (config('lfm.should_validate_mime', true)) {
            $mimetype = $file->getMimeType();
            if (false === in_array($mimetype, $this->helper->availableMimeTypes())) {
                return $this->error('mime', ['mime' => $mimetype]);
            }
        }

        if (config('lfm.should_validate_size', true)) {
            // size to kb unit is needed
            $file_size = $file->getSize() / 1000;
            if ($file_size > $this->helper->maxUploadSize()) {
                return $this->error('size', ['size' => $file_size]);
            }
        }

        return true;
    }

    /**
     * Generate new name for file
     *
     * @param UploadedFile $file
     * @return string
     */
    private function getNewName($file): string
    {
        $name = $this->helper->translateFromUtf8(trim(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));

        if (config('lfm.rename_file.uniqid', false) === true) {
            $name = uniqid();
        } elseif (config('lfm.rename_file.slug', true) === true) {
            $name = Str::slug($name);
        }

        return $this->uniquifyName($name, $file->getClientOriginalExtension());
    }


    /**
     * Generate unique name for file if it necessary
     *
     * @param string $name
     * @param string $extension
     * @return string
     */
    private function uniquifyName(string $name, string $extension): string
    {
        $duplicate = config('lfm.rename_file.duplicate', '-%s');
        $i = 0;

        do {
            $result = $name;

            if ($i && is_string($duplicate)) {
                $result .= sprintf($duplicate, $i);
            }

            // Append the extension if it exists
            if ($extension) {
                $result .= '.' . $extension;
            }

            $i++;
        } while (is_string($duplicate) ? $this->setName($result)->exists() : false);

        return $result;
    }

    private function saveFile($file, $new_file_name)
    {
        $this->setName($new_file_name)->storage->save($file);

        $this->compressImage($new_file_name);

        $this->makeThumbnail($new_file_name);

        return $new_file_name;
    }

    public function makeThumbnail($file_name,$overWrite=false, $image_name= null)
    {
        $original_image = $this->pretty($file_name);

        if (!$original_image->shouldCreateThumb()) {
            return;
        }

        // create folder for thumbnails
        $this->setName(null)->thumb(true)->createFolder();

        // generate cropped image content
        // dd($file_name);

        $this->setName($file_name)->thumb(true);
        $image = Image::make($original_image->get())
            ->fit(config('lfm.thumb_img_width', 200), config('lfm.thumb_img_height', 200));

        $quality = is_int(config('lfm.compress_image', 90)) ? config('lfm.compress_image', 90) : 90;

        $this->storage->put($image->stream(null, $quality)->detach(), 'public');
        if($overWrite){
            $file_name   = $image_name;
        }
        // if(!$overWrite && $image_name){
        //     $file_name = $image_name;
        // }
        
        $name = pathinfo($file_name, PATHINFO_FILENAME);
        // dd($name);
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
        foreach (config('lfm.other_img_size') as $img_size) {

            $filename = "$name-$img_size[0]x$img_size[1].$ext";
            $this->setName($filename)->thumb(true);
            $image = Image::make($original_image->get())
                ->fit($img_size[0], $img_size[1]);
            $quality = is_int(config('lfm.compress_image', 90)) ? config('lfm.compress_image', 90) : 90;
            $this->storage->put($image->stream(null, $quality)->detach(), 'public');
        }
    }
    public function getImages($file_name)
    {
        $name = pathinfo($file_name, PATHINFO_FILENAME);
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $images = [];
        foreach (config('lfm.other_img_size') as $img_size) {
            $images[] = "$name-$img_size[0]x$img_size[1].$ext";
        }
        return $images;
    }

    /**
     * Compress the image if it possible
     *
     * @param $file_name
     */
    public function compressImage($file_name)
    {
        $original_image = $this->pretty($file_name);

        if (!$original_image->shouldCompressImage()) {
            return;
        }

        $compress_image = config('lfm.compress_image', 90);

        if (is_int($compress_image)) {
            // $image = Image::make($original_image->get());
            $image = Image::make($original_image->get())->resize(1500, null, function ($constraint) {
                $constraint->aspectRatio(); //to preserve the aspect ratio
                $constraint->upsize();
            });
            $this->storage->put($image->stream(null, $compress_image)->detach(), 'public');
        } elseif (is_string($compress_image)) {
            \Tinify\setKey($compress_image);
            \Tinify\fromBuffer($original_image->get())->toFile($original_image->path());
        }
    }
}
