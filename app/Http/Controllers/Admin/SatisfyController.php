<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Satisfy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SatisfyController extends Controller
{
    public function __construct(Satisfy $satisfy)
    {
        $this->middleware(['permission:satisfy-list|satisfy-create|satisfy-edit|satisfy-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:satisfy-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:satisfy-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:satisfy-delete'], ['only' => ['destroy']]);
        $this->get_web();
        $this->satisfy = $satisfy;
    }

    protected function getInfo($request)
    {
        $query = $this->satisfy->orderBy('id', 'DESC');
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', "%{$keyword}%");
        }
        return $query->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getInfo($request);
        // dd($data);
        return view('admin/satisfys/list', compact('data'));
    }

    public function create(Request $request)
    {
        $satisfy_info = null;
        $title = 'Add satisfy Service';
        return view('admin/satisfys/form', compact('satisfy_info', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, $this->satisfyValidate($request));
        try {
            $data = $this->mapsatisfyData($request);
            $this->satisfy->fill($data)->save();
            $request->session()->flash('success', 'satisfy Service created successfully.');
            return redirect()->route('satisfy.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function satisfyValidate($request)
    {
        $data = [
            'title' => 'required|string|min:3|max:190',
            'number' => 'required|numeric',
            'publish_status' => 'required|numeric|in:0,1',
        ];
        if ($request->isMethod('post')) {
            $data['image'] = 'required';
        }
        return $data;
    }
    protected function mapsatisfyData($request, $newsInfo = null)
    {
        $data = [
            'title' => htmlentities($request->title),
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_keyphrase' => $request->meta_keyphrase,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'slug' => Str::slug($request->title),
            'features' => $request->features,
            'number' => $request->number,
            'publish_status' => $request->publish_status,
            'display_home' => $request->display_home,
            'created_by' => Auth::user()->id,
        ];
        if ($request->isMethod('post')) {
            $data['created_by'] = Auth::user()->id;
        } elseif ($request->isMethod('put')) {
            $data['updated_by'] = Auth::user()->id;
        }
        if ($request->image) {
            $data['image'] = $request->image;
        }
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $satisfy_info = $this->satisfy->find($id);
        if (!$satisfy_info) {
            abort(404);
        }
        $title = 'Update satisfy Service';
        return view('admin/satisfys/form', compact('satisfy_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $satisfy_info = $this->satisfy->find($id);
        if (!$satisfy_info) {
            abort(404);
        }
        $this->validate($request, $this->satisfyValidate($request));
        try {
            $data = $this->mapsatisfyData($request);
            $satisfy_info->fill($data)->save();
            $request->session()->flash('success', 'satisfy Service updated successfully.');
            return redirect()->route('satisfy.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $satisfy_info = $this->satisfy->find($id);
        if (!$satisfy_info) {
            abort(404);
        }
        try {
            $satisfy_info->updated_by = Auth::user()->id;
            $satisfy_info->save();
            $satisfy_info->delete();
            $request->session()->flash('success', 'satisfy Service deleted successfully.');
            return redirect()->route('satisfy.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        $this->satisfy->find($request->id)->update(['publish_status'=>$request->status]);

    }
    public function changedisplayhome(Request $request)
    {
        $this->satisfy->find($request->id)->update(['display_home'=>$request->status]);

    }
}
