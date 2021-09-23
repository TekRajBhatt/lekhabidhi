<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Detail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail = Detail::all();
        return view('admin.details.list', compact('detail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.details.form');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $detail =  Detail::create([
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

        $detail->save();

        return redirect()->route('detail.index')->with('success', 'Details created successfully.');
    }


    public function edit($id)
    {
        $detail = Detail::findorfail($id);
        return view('admin.details.edit ', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $detail = Detail::findorfail($id);

        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $detail->update([
            'title' => $request->title,
            'description' => $request->description,
            'publish_status' => $request->publish_status,
            'updated_by' => Auth::user()->id
        ]);

        $detail->update();

        return redirect()->route('detail.index')->with('success', 'Details Updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        return view('admin/details/list',compact('detail'));
    }

    public function destroy($id)
    {
        $detail = Detail::findorfail($id);
        $detail->delete();
        return redirect()->route('detail.index')->with('success', 'Details Deleted successfully.');

    }

    public function changeStatus(Request $request, $id)
    {
        $detail = Detail::findorfail($id);
        $this->$detail->find($request->id)->update(['publish_status'=>$request->status]);

    }

    // public function display(){


    //     return view('website.detail');

    // }

    // $detail = Detail::where('slug', $slug)->first();
    // return view('website.detail')->with('game', $detail);
}
