<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::all();
        return view('admin.services.list', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.services.form');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $service =  Service::create([
            'title' => $request['title'],
            'slug' => Str::slug($request['title']),
            'description' => $request['description'],
            'created_by' => Auth::user()->id,
        ]);

        if ($request->isMethod('post')) {
            $data['created_by'] = Auth::user()->id;
        } elseif ($request->isMethod('put')) {
            $data['updated_by'] = Auth::user()->id;
        }

        $service->save();

        return redirect()->route('service.index')->with('success', 'services created successfully.');
    }


    public function edit($id)
    {
        $service = Service::findorfail($id);
        return view('admin.services.edit ', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findorfail($id);

        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'publish_status' => $request->publish_status,
            'updated_by' => Auth::user()->id
        ]);

        $service->update();

        return redirect()->route('service.index')->with('success', 'services Updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('admin/services/list',compact('service'));
    }

    public function destroy($id)
    {
        $service = Service::findorfail($id);
        $service->delete();
        return redirect()->route('service.index')->with('success', 'services Deleted successfully.');

    }

    public function changeStatus(Request $request, $id)
    {
        $service = Service::findorfail($id);
        $this->$service->find($request->id)->update(['publish_status'=>$request->status]);

    }

    // public function display(){


    //     return view('website.service');

    // }

    // $service = service::where('slug', $slug)->first();
    // return view('website.service')->with('game', $service);
}
