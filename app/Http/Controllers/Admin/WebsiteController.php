<?php

namespace App\Http\Controllers\Admin;

use App\Models\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function __construct(Website $website)
    {
        $this->middleware(['permission:website-list|website-create|website-edit|website-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:website-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:website-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:website-delete'], ['only' => ['destroy']]);
        $this->website = $website;
    }

    protected function getwebsite($request)
    {
        $query = $this->website;
        if (isset($request->status)) {
            $query = $this->website->where('publish_status', $request->status);
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', "%{$keyword}%");
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
     //   dd($request);
        $data = $this->getwebsite($request);
     //   dd($data);
        return view('admin/websites/list', compact('data'));
    }

    public function create(Request $request)
    {
        $website_info = null;
        $title = 'Add Website Content';
        return view('admin/websites/form', compact('website_info', 'title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->websiteValidate($request));
        try {
            $data = $this->mapwebsiteData($request);
            $this->website->fill($data)->save();
            $request->session()->flash('success', 'Website Content created successfully.');
            return redirect()->route('website.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function websiteValidate($request)
    {
        $data = [
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            'footer_desc' => 'required',
            'copyright' => 'required',

        ];
        if ($request->isMethod('post')) {
            $data['logo'] = 'required';
        }
        return $data;
    }

    protected function mapwebsiteData($request)
    {
        $data = [
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'footer_desc' => $request->footer_desc,
            'copyright' => $request->copyright,
            'meta_title' => $request->meta_title,
            'meta_keyphrase' => $request->meta_keyphrase,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,

        ];
        if ($request->isMethod('post')) {
            $data['created_by'] = Auth::user()->id;
        } elseif ($request->isMethod('put')) {
            $data['updated_by'] = Auth::user()->id;
        }
        if ($request->logo) {
            $data['logo'] = $request->logo;
        }
        return $data;
    }

    public function edit(Request $request, $id)
    {
        $website_info = $this->website->find($id);
        if (!$website_info) {
            abort(404);
        }
        $title = 'Update Website Content';
        return view('admin/websites/form', compact('website_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $website_info = $this->website->find($id);
        if (!$website_info) {
            abort(404);
        }
        $this->validate($request, $this->websiteValidate($request));
        try {
            $data = $this->mapwebsiteData($request);
            $website_info->fill($data)->save();
            $request->session()->flash('success', 'Website Content updated successfully.');
            return redirect()->route('website.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $website_info = $this->website->find($id);
        if (!$website_info) {
            abort(404);
        }
        try {
            $website_info->updated_by = Auth::user()->id;
            $website_info->save();
            $website_info->delete();
            $request->session()->flash('success', 'Website Content deleted successfully.');
            return redirect()->route('website.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        $this->website->find($request->website_id)->update(['publish_status'=>$request->status]);

    }

}
