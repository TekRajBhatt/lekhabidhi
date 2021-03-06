<?php

namespace Mafftor\LaravelFileManager\Controllers;

use Illuminate\Support\Facades\Log;
use Mafftor\LaravelFileManager\Events\ImageIsUploading;
use Mafftor\LaravelFileManager\Events\ImageWasUploaded;
use Mafftor\LaravelFileManager\Lfm;

class UploadController extends LfmController
{
    protected $errors;

    public function __construct()
    {
        parent::__construct();
        $this->errors = [];
    }

    /**
     * Upload files
     *
     * @param void
     * @return string
     */
    public function upload()
    {
        $uploaded_files = request()->file('upload');
        $error_bag = [];
        $new_filename = null;

        foreach (is_array($uploaded_files) ? $uploaded_files : [$uploaded_files] as $file) {
            try {
                $new_filename = $this->lfm->upload($file);
            } catch (\Exception $e) {
                Log::error($e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
                array_push($error_bag, $e->getMessage());
            }
        }

        // if (is_array($uploaded_files)) {
        //     $response = count($error_bag) > 0 ? $error_bag : $new_filename;
        // } else { // upload via ckeditor 'Upload' tab
        //     if (is_null($new_filename)) {
        //         $response = $error_bag[0];
        //     } else {
        //         $response = view(Lfm::PACKAGE_NAME . '::use')
        //             ->withFile(($this->lfm->setName($new_filename))->url());
        //     }
        // }

     
        if (is_array($uploaded_files)) {
            $response = count($error_bag) > 0 ? $error_bag : parent::$success_response;
        } else { // upload via ckeditor5 expects json responses
            if (is_null($new_filename)) {
                $response = [
                    'error' => [ 'message' =>  $error_bag[0] ]
                ];
            } else {
                $url = $this->lfm->setName($new_filename)->url();

                $response = [
                    'url' => $url,
                    'uploaded' => $url
                ];
            }
        }

        return response()->json($response);
    }
}
