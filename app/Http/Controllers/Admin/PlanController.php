<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function __construct(Plan $plan)
    {
        $this->middleware(['permission:plan-list|plan-create|plan-edit|plan-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:plan-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:plan-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:plan-delete'], ['only' => ['destroy']]);
        $this->get_web();
        $this->plan = $plan;
    }

    protected function getInfo($request)
    {
        $query = $this->plan->orderBy('id', 'DESC');
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
        return view('admin/plans/list', compact('data'));
    }

    public function create(Request $request)
    {
        $plan_info = null;
        $title = 'Add Plans';
        return view('admin/plans/form', compact('plan_info', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, $this->planValidate($request));
        try {
            $data = $this->mapplanData($request);
            $this->plan->fill($data)->save();
            $request->session()->flash('success', 'Plans created successfully.');
            return redirect()->route('plan.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function planValidate($request)
    {
        $data = [
            'title' => 'required|string|min:3|max:190',
            'plan_basis' => 'required',
            'price' => 'required|numeric',
            'publish_status' => 'required|numeric|in:0,1',


        ];

        return $data;
    }
    protected function mapplanData($request, $newsInfo = null)
    {
        $data = [
            'title' => htmlentities($request->title),
            'slug' => Str::slug($request->title),
            'plan_basis' => $request->plan_basis,
            'price' => $request->price,
            'list' => $request->list,
            'meta_title' => $request->meta_title,
            'meta_keyphrase' => $request->meta_keyphrase,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'publish_status' => $request->publish_status,
            'display_home' => $request->display_home,
            'created_by' => Auth::user()->id,
        ];
        if ($request->isMethod('post')) {
            $data['created_by'] = Auth::user()->id;
        } elseif ($request->isMethod('put')) {
            $data['updated_by'] = Auth::user()->id;
        }

        return $data;
    }
    public function edit(Request $request, $id)
    {
        $plan_info = $this->plan->find($id);
        if (!$plan_info) {
            abort(404);
        }
        $title = 'Update Plans';
        return view('admin/plans/form', compact('plan_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $plan_info = $this->plan->find($id);
        if (!$plan_info) {
            abort(404);
        }
        $this->validate($request, $this->planValidate($request));
        try {
            $data = $this->mapplanData($request);
            $plan_info->fill($data)->save();
            $request->session()->flash('success', 'Plan updated successfully.');
            return redirect()->route('plan.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $plan_info = $this->plan->find($id);
        if (!$plan_info) {
            abort(404);
        }
        try {
            $plan_info->updated_by = Auth::user()->id;
            $plan_info->save();
            $plan_info->delete();
            $request->session()->flash('success', 'Plan deleted successfully.');
            return redirect()->route('plan.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        $this->plan->find($request->id)->update(['publish_status'=>$request->status]);

    }
    public function changedisplayhome(Request $request)
    {
        $this->plan->find($request->id)->update(['display_home'=>$request->status]);

    }
}
