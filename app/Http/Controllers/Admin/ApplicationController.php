<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('career:id,title')->latest()->paginate(10);
        
        return view('admin.application.list', compact('applications'));
    }

    public function download($id)
    {
        $application =  Application::findorfail($id);
        $file = public_path() . '/uploads/applications/' . $application->documents;
        return response()->download($file);
    }

    public function show($id)
    {
        $application = Application::with('career:id,title,slug')->findorfail($id);
        $title = $application->name;
        return view('admin.application.show', compact('title', 'application'));
    }
}
