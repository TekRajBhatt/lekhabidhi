<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function __construct(Client $partner)
    {
        $this->middleware(['permission:partner-list|partner-create|partner-edit|partner-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:partner-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:partner-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:partner-delete'], ['only' => ['destroy']]);
        $this->partner = $partner;
    }

    protected function getpartner($request)
    {
        $query = $this->partner;
        if (isset($request->status)) {
            $query = $this->partner->where('publish_status', $request->status);
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', "%{$keyword}%");
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getpartner($request);
        // dd($data);
        return view('admin/partners/list', compact('data'));
    }

    public function create(Request $request)
    {
        $partner_info = null;
        $title = 'Add Partner';
        return view('admin/partners/form', compact('partner_info', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $url = validate_url($request->url);
        // dd($url);
        if ($url) {
            $this->validate($request, $this->partnerValidate($request));
            try {
                $data = $this->mappartnerData($request);
                // dd($data);
                $this->partner->fill($data)->save();
                $request->session()->flash('success', 'Partner created successfully.');
                return redirect()->route('partner.index');
            } catch (\Exception $error) {
                $request->session()->flash('error', $error->getMessage());
                return redirect()->back();
            }
        } else {
            $request->session()->flash('error', "Invalid URL !!");
            return redirect()->back();
        }
    }

    protected function partnerValidate($request)
    {
        $data = [
            'title' => 'required|string|min:3|max:190',
            'position' => 'required|numeric',
            'short_description' => 'nullable|max:191',
            'publish_status' => 'required|numeric|in:0,1',
        ];
        if ($request->isMethod('post')) {
            $data['logo'] = 'required';
        }
        return $data;
    }
    protected function mappartnerData($request)
    {
        $data = [
            'title' => $request->title,
            "slug" => $this->getSlug($request->title),
            'date' => $request->date,
            'partner_name' => $request->partner_name,
            'display_home' => $request->display_home,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'meta_keyphrase' => $request->meta_keyphrase,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'develop_by' => $request->develop_by,
            'title' => $request->title,
            'title' => $request->title,
            'url' => $request->url,
            'publish_status' => $request->publish_status,
            'position' => $request->position,
        ];
        if ($request->isMethod('post')) {
            $data['created_by'] = Auth::user()->id;
        } elseif ($request->isMethod('put')) {
            $data['updated_by'] = Auth::user()->id;
        }
        // if ($request->image) {
        //     $data['image'] = $request->image;
        // }
        if ($request->logo) {
            $data['logo'] = $request->logo;
        }
        return $data;
    }

    public function edit(Request $request, $id)
    {
        $partner_info = $this->partner->find($id);
        if (!$partner_info) {
            abort(404);
        }
        $title = 'Update Partner';
        return view('admin/partners/form', compact('partner_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $partner_info = $this->partner->find($id);
        if (!$partner_info) {
            abort(404);
        }
        $this->validate($request, $this->partnerValidate($request));
        try {
            $data = $this->mappartnerData($request);
            $partner_info->fill($data)->save();
            $request->session()->flash('success', 'Partner updated successfully.');
            return redirect()->route('partner.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $partner_info = $this->partner->find($id);
        if (!$partner_info) {
            abort(404);
        }
        try {
            $partner_info->updated_by = Auth::user()->id;
            $partner_info->save();
            $partner_info->delete();
            $request->session()->flash('success', 'Partner deleted successfully.');
            return redirect()->route('partner.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    protected function getSlug($title)
    {
        $slug = Str::slug($title);
        $find = $this->partner->where('slug', $slug)->first();
        if (request()->isMethod('post')) {
            if ($find) {
                $slug = $slug . '-' . rand(1111, 9999);
            }
        }

        return $slug;
    }

    public function changeStatus(Request $request)
    {
        $this->partner->find($request->id)->update(['publish_status' => $request->status]);
    }
    public function changedisplayhome(Request $request)
    {
        $this->partner->find($request->id)->update(['display_home' => $request->status]);
    }
}
