<?php

namespace Mafftor\LaravelFileManager\Controllers;

use Illuminate\Support\Facades\Storage;

class RedirectController extends LfmController
{
    public function showFile($file_path)
    {
        $storage = Storage::disk($this->helper->config('disk'));

        if (! $storage->exists($file_path)) {
            abort(404);
        }
        // dd($storage->get($file_path));

        return response($storage->get($file_path))
            ->header('Content-Type', $storage->mimeType($file_path));
    }
}
