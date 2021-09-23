<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Marketing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketingController extends Controller
{
    public function __construct(Marketing $marketing)
    {
        $this->middleware(['permission:marketing-list|marketing-create|marketing-edit|marketing-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:marketing-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:marketing-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:marketing-delete'], ['only' => ['destroy']]);
        $this->get_web();
        $this->marketing = $marketing;
    }

    protected function getInfo($request)
    {
        $query = $this->marketing->orderBy('id', 'DESC');
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
        return view('admin/marketings/list', compact('data'));
    }

    public function create(Request $request)
    {
        $marketing_info = null;
        $title = 'Add Marketing Service';
        return view('admin/marketings/form', compact('marketing_info', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, $this->marketingValidate($request));
        try {
            $data = $this->mapmarketingData($request);
            $this->marketing->fill($data)->save();
            $request->session()->flash('success', 'Marketing Service created successfully.');
            return redirect()->route('marketing.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function marketingValidate($request)
    {
        $data = [
            'title' => 'required|string|min:3|max:190',
            'position' => 'required|numeric',
            'publish_status' => 'required|numeric|in:0,1',
        ];
        if ($request->isMethod('post')) {
            $data['image'] = 'required';
        }
        return $data;
    }
    protected function mapmarketingData($request, $newsInfo = null)
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
        if ($request->image) {
            $data['image'] = $request->image;
        }
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $marketing_info = $this->marketing->find($id);
        if (!$marketing_info) {
            abort(404);
        }
        $title = 'Update Marketing Service';
        return view('admin/marketings/form', compact('marketing_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $marketing_info = $this->marketing->find($id);
        if (!$marketing_info) {
            abort(404);
        }
        $this->validate($request, $this->marketingValidate($request));
        try {
            $data = $this->mapmarketingData($request);
            $marketing_info->fill($data)->save();
            $request->session()->flash('success', 'Marketing Service updated successfully.');
            return redirect()->route('marketing.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $marketing_info = $this->marketing->find($id);
        if (!$marketing_info) {
            abort(404);
        }
        try {
            $marketing_info->updated_by = Auth::user()->id;
            $marketing_info->save();
            $marketing_info->delete();
            $request->session()->flash('success', 'Marketing Service deleted successfully.');
            return redirect()->route('marketing.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        $this->marketing->find($request->id)->update(['publish_status'=>$request->status]);

    }
    public function changedisplayhome(Request $request)
    {
        $this->marketing->find($request->id)->update(['display_home'=>$request->status]);

    }
}
