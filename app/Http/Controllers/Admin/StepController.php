<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Step;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StepController extends Controller
{
    public function __construct(Step $step)
    {
        $this->middleware(['permission:step-list|step-create|step-edit|step-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:step-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:step-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:step-delete'], ['only' => ['destroy']]);
        $this->get_web();
        $this->step = $step;
    }

    protected function getInfo($request)
    {
        $query = $this->step->orderBy('id', 'DESC');
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
        return view('admin/steps/list', compact('data'));
    }

    public function create(Request $request)
    {
        $step_info = null;
        $title = 'Add Steps To Grow Business';
        return view('admin/steps/form', compact('step_info', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, $this->stepValidate($request));
        try {
            $data = $this->mapstepData($request);
            $this->step->fill($data)->save();
            $request->session()->flash('success', 'Steps created successfully.');
            return redirect()->route('step.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function stepValidate($request)
    {
        $data = [
            'title' => 'required|string|min:3|max:190',
            'position' => 'required|numeric',
            'publish_status' => 'required|numeric|in:0,1',

            'image' => 'required',

        ];
        // if ($request->isMethod('post')) {
        //     $data['image'] = 'required';
        // }
        return $data;
    }
    protected function mapstepData($request, $newsInfo = null)
    {
        $data = [
            'title' => htmlentities($request->title),
            'description' => $request->description,
            'image' => $request->image,
            'meta_title' => $request->meta_title,
            'meta_keyphrase' => $request->meta_keyphrase,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'slug' => Str::slug($request->title),
            'position' => $request->position,
            'publish_status' => $request->publish_status,
            'display_home' => $request->display_home,
            'created_by' => Auth::user()->id,
        ];
        if ($request->isMethod('post')) {
            $data['created_by'] = Auth::user()->id;
        } elseif ($request->isMethod('put')) {
            $data['updated_by'] = Auth::user()->id;
        }
        // if ($request->image) {
        //     $data['image'] = $request->image;
        // }
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $step_info = $this->step->find($id);
        if (!$step_info) {
            abort(404);
        }
        $title = 'Update Steps To Grow Business';
        return view('admin/steps/form', compact('step_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $step_info = $this->step->find($id);
        if (!$step_info) {
            abort(404);
        }
        $this->validate($request, $this->stepValidate($request));
        try {
            $data = $this->mapstepData($request);
            $step_info->fill($data)->save();
            $request->session()->flash('success', 'Steps updated successfully.');
            return redirect()->route('step.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $step_info = $this->step->find($id);
        if (!$step_info) {
            abort(404);
        }
        try {
            $step_info->updated_by = Auth::user()->id;
            $step_info->save();
            $step_info->delete();
            $request->session()->flash('success', 'Steps deleted successfully.');
            return redirect()->route('step.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        $this->step->find($request->id)->update(['publish_status'=>$request->status]);

    }
    public function changedisplayhome(Request $request)
    {
        $this->step->find($request->id)->update(['display_home'=>$request->status]);

    }
}
