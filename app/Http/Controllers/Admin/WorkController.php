<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Work;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function __construct(Work $work)
    {
        $this->middleware(['permission:work-list|work-create|work-edit|work-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:work-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:work-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:work-delete'], ['only' => ['destroy']]);
        $this->work = $work;
    }

    protected function getwork($request)
    {
        $query = $this->work;
        if (isset($request->status)) {
            $query = $this->work->where('publish_status', $request->status);
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', "%{$keyword}%");
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getwork($request);
    //    dd($data);
        return view('admin/works/list', compact('data'));
    }

    public function create(Request $request)
    {
        $work_info = null;
        $title = 'Add Work Together';
        return view('admin/works/form', compact('work_info', 'title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->workValidate($request));
        try {
            $data = $this->mapworkData($request);
            $this->work->fill($data)->save();
            $request->session()->flash('success', 'Work Together created successfully.');
            cache()->forget('app_works');
            return redirect()->route('work.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function workValidate($request)
    {
        $data = [
            'title' => 'required|string|min:3|max:190',
            'publish_status' => 'required|numeric|in:0,1',
        ];
        if ($request->isMethod('post')) {
            $data['featured_image'] = 'required';
        }
        return $data;
    }

    protected function mapworkData($request)
    {
        $data = [
            'title' => htmlentities($request->title),
            'description' => $request->description,
            'display_home' => $request->display_home,
            'publish_status' => $request->publish_status,
        ];
        if ($request->isMethod('post')) {
            $data['created_by'] = Auth::user()->id;
        } elseif ($request->isMethod('put')) {
            $data['updated_by'] = Auth::user()->id;
        }
        if ($request->featured_image) {
            $data['featured_image'] = $request->featured_image;
        }
        return $data;
    }

    public function edit(Request $request, $id)
    {
        $work_info = $this->work->find($id);
        if (!$work_info) {
            abort(404);
        }
        $title = 'Update Work Together';
        return view('admin/works/form', compact('work_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $work_info = $this->work->find($id);
        if (!$work_info) {
            abort(404);
        }
        $this->validate($request, $this->workValidate($request));
        try {
            $data = $this->mapworkData($request);
            $work_info->fill($data)->save();
            $request->session()->flash('success', 'Work Together updated successfully.');
            return redirect()->route('work.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $work_info = $this->work->find($id);
        if (!$work_info) {
            abort(404);
        }
        try {
            $work_info->updated_by = Auth::user()->id;
            $work_info->save();
            $work_info->delete();
            $request->session()->flash('success', 'Work Together deleted successfully.');
            cache()->forget('app_works');
            return redirect()->route('work.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        $this->work->find($request->work_id)->update(['publish_status'=>$request->status]);

    }
    public function changedisplayhome(Request $request)
    {
        $this->work->find($request->id)->update(['display_home'=>$request->status]);

    }
}
