<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Commit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommitController extends Controller
{
    public function __construct(Commit $commit)
    {
        $this->middleware(['permission:commit-list|commit-create|commit-edit|commit-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:commit-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:commit-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:commit-delete'], ['only' => ['destroy']]);
        $this->get_web();
        $this->commit = $commit;
    }

    protected function getInfo($request)
    {
        $query = $this->commit->orderBy('id', 'DESC');
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
        return view('admin/commits/list', compact('data'));
    }

    public function create(Request $request)
    {
        $commit_info = null;
        $title = 'Add Commited To Change';
        return view('admin/commits/form', compact('commit_info', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, $this->commitValidate($request));
        try {
            $data = $this->mapcommitData($request);
            $this->commit->fill($data)->save();
            $request->session()->flash('success', 'Committed To Change created successfully.');
            return redirect()->route('commit.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function commitValidate($request)
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
    protected function mapcommitData($request, $newsInfo = null)
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
        $commit_info = $this->commit->find($id);
        if (!$commit_info) {
            abort(404);
        }
        $title = 'Update Committed To Change';
        return view('admin/commits/form', compact('commit_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $commit_info = $this->commit->find($id);
        if (!$commit_info) {
            abort(404);
        }
        $this->validate($request, $this->commitValidate($request));
        try {
            $data = $this->mapcommitData($request);
            $commit_info->fill($data)->save();
            $request->session()->flash('success', 'Committed To Change updated successfully.');
            return redirect()->route('commit.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $commit_info = $this->commit->find($id);
        if (!$commit_info) {
            abort(404);
        }
        try {
            $commit_info->updated_by = Auth::user()->id;
            $commit_info->save();
            $commit_info->delete();
            $request->session()->flash('success', 'Committed To Change deleted successfully.');
            return redirect()->route('commit.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        $this->commit->find($request->id)->update(['publish_status'=>$request->status]);

    }
    public function changedisplayhome(Request $request)
    {
        $this->commit->find($request->id)->update(['display_home'=>$request->status]);

    }
}
