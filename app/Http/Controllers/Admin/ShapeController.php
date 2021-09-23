<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shape;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShapeController extends Controller
{
    public function __construct(Shape $shape)
    {
        $this->middleware(['permission:shape-list|shape-create|shape-edit|shape-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:shape-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:shape-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:shape-delete'], ['only' => ['destroy']]);
        $this->shape = $shape;
    }

    protected function getshape($request)
    {
        $query = $this->shape;
        if (isset($request->status)) {
            $query = $this->shape->where('publish_status', $request->status);
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', "%{$keyword}%");
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getshape($request);
        return view('admin/shape/list', compact('data'));
    }

    public function create(Request $request)
    {
        $shape_info = null;
        $title = 'Add shape';
        return view('admin/shape/form', compact('shape_info', 'title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->shapeValidate($request));
        try {
            $data = $this->mapshapeData($request);
            $this->shape->fill($data)->save();
            $request->session()->flash('success', 'shape created successfully.');
            return redirect()->route('shape.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function shapeValidate($request)
    {
        $data = [
            'title' => 'required|string|min:3|max:190',
            'publish_status' => 'required|numeric|in:0,1',
        ];
        if ($request->isMethod('post')) {
            $data['image'] = 'required';
        }
        if ($request->isMethod('post')) {
            $data['video'] = 'required';
        }
        return $data;
    }

    protected function mapshapeData($request)
    {
        $data = [
            'title' => htmlentities($request->title),
            'description' => $request->description,
            'publish_status' => $request->publish_status,
        ];
        if ($request->isMethod('post')) {
            $data['created_by'] = Auth::user()->id;
        } elseif ($request->isMethod('put')) {
            $data['updated_by'] = Auth::user()->id;
        }
        if ($request->image) {
            $data['image'] = $request->image;
        }
        if ($request->video) {
            $data['video'] = $request->video;
        }
        return $data;
    }

    public function edit(Request $request, $id)
    {
        $shape_info = $this->shape->find($id);
        if (!$shape_info) {
            abort(404);
        }
        $title = 'Update Build Your shape';
        return view('admin/shape/form', compact('shape_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $shape_info = $this->shape->find($id);
        if (!$shape_info) {
            abort(404);
        }
        $this->validate($request, $this->shapeValidate($request));
        try {
            $data = $this->mapshapeData($request);
            $shape_info->fill($data)->save();
            $request->session()->flash('success', 'shape updated successfully.');
            return redirect()->route('shape.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {

    }

    public function changeStatus(Request $request)
    {
        $this->shape->find($request->shape_id)->update(['publish_status'=>$request->status]);

    }

}
