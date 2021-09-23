<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function __construct(Testimonial $testimonial)
    {
        $this->middleware(['permission:testimonial-list|testimonial-create|testimonial-edit|testimonial-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:testimonial-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:testimonial-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:testimonial-delete'], ['only' => ['destroy']]);
        $this->testimonial = $testimonial;
    }

    protected function gettestimonial($request)
    {
        $query = $this->testimonial;
        if (isset($request->status)) {
            $query = $this->testimonial->where('publish_status', $request->status);
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', "%{$keyword}%");
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->gettestimonial($request);
        return view('admin/testimonials/list', compact('data'));
    }

    public function create(Request $request)
    {
        $testimonial_info = null;
        $title = 'Add testimonial';
        return view('admin/testimonials/form', compact('testimonial_info', 'title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->testimonialValidate($request));
        try {
            $data = $this->maptestimonialData($request);
            $this->testimonial->fill($data)->save();
            $request->session()->flash('success', 'testimonial created successfully.');
            cache()->forget('app_testimonials');
            return redirect()->route('testimonial.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function testimonialValidate($request)
    {
        $data = [
            'name' => 'required|string|min:3|max:190',
            'publish_status' => 'required|numeric|in:0,1',
        ];
        return $data;
    }

    protected function maptestimonialData($request)
    {
        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'first_description' => $request->first_description,
            'second_description' => $request->second_description,
            'publish_status' => $request->publish_status,
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
        $testimonial_info = $this->testimonial->find($id);
        if (!$testimonial_info) {
            abort(404);
        }
        $title = 'Update testimonial';
        return view('admin/testimonials/form', compact('testimonial_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $testimonial_info = $this->testimonial->find($id);
        if (!$testimonial_info) {
            abort(404);
        }
        $this->validate($request, $this->testimonialValidate($request));
        try {
            $data = $this->maptestimonialData($request);
            $testimonial_info->fill($data)->save();
            $request->session()->flash('success', 'testimonial updated successfully.');
            return redirect()->route('testimonial.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $testimonial_info = $this->testimonial->find($id);
        if (!$testimonial_info) {
            abort(404);
        }
        try {
            $testimonial_info->updated_by = Auth::user()->id;
            $testimonial_info->save();
            $testimonial_info->delete();
            $request->session()->flash('success', 'testimonial deleted successfully.');
            cache()->forget('app_testimonials');
            return redirect()->route('testimonial.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        $this->testimonial->find($request->testimonial_id)->update(['publish_status'=>$request->status]);

    }
    public function changedisplayhome(Request $request)
    {
        $this->testimonial->find($request->id)->update(['display_home'=>$request->status]);

    }
}
