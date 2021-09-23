<?php

namespace App\Http\Controllers\Admin;

use App\Models\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    public function __construct(Business $business)
    {
        $this->middleware(['permission:business-list|business-create|business-edit|business-delete'], ['only' => ['index', 'store']]);
     //   $this->middleware(['permission:business-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:business-edit'], ['only' => ['edit', 'update']]);
     //   $this->middleware(['permission:business-delete'], ['only' => ['destroy']]);
        $this->business = $business;
    }

    protected function getbusiness($request)
    {
        $query = $this->business;
        if (isset($request->status)) {
            $query = $this->business->where('publish_status', $request->status);
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', "%{$keyword}%");
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getbusiness($request);
        return view('admin/business/list', compact('data'));
    }

    public function create(Request $request)
    {
        $business_info = null;
        $title = 'Add Business';
        return view('admin/business/form', compact('business_info', 'title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->businessValidate($request));
        try {
            $data = $this->mapbusinessData($request);
            $this->business->fill($data)->save();
            $request->session()->flash('success', 'Business created successfully.');
            return redirect()->route('business.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function businessValidate($request)
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

    protected function mapbusinessData($request)
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
        $business_info = $this->business->find($id);
        if (!$business_info) {
            abort(404);
        }
        $title = 'Update Build Your Business';
        return view('admin/business/form', compact('business_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $business_info = $this->business->find($id);
        if (!$business_info) {
            abort(404);
        }
        $this->validate($request, $this->businessValidate($request));
        try {
            $data = $this->mapbusinessData($request);
            $business_info->fill($data)->save();
            $request->session()->flash('success', 'Business updated successfully.');
            return redirect()->route('business.index');
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
        $this->business->find($request->business_id)->update(['publish_status'=>$request->status]);

    }

}
