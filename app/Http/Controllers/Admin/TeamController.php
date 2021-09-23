<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function __construct(Team $team)
    {
        $this->middleware(['permission:team-list|team-create|team-edit|team-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:team-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:team-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:team-delete'], ['only' => ['destroy']]);
        $this->get_web();
        $this->team = $team;
    }

    protected function getInfo($request)
    {
        $query = $this->team->orderBy('id', 'DESC');
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
        return view('admin/teams/list', compact('data'));
    }

    public function create(Request $request)
    {
        $team_info = null;
        $title = 'Add Team';
        return view('admin/teams/form', compact('team_info', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, $this->teamValidate($request));
        try {
            $data = $this->mapteamData($request);
            $this->team->fill($data)->save();
            $request->session()->flash('success', 'Team created successfully.');
            return redirect()->route('team.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function teamValidate($request)
    {
        $data = [
            'title' => 'required|string|min:3|max:190',
            'job_title' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'publish_status' => 'required|numeric|in:0,1',
        ];
        if ($request->isMethod('post')) {
            $data['image'] = 'required';
        }
        return $data;
    }
    protected function mapteamData($request, $newsInfo = null)
    {
        $data = [
            'title' => htmlentities($request->title),
            'slug' => Str::slug($request->title),
            'job_title' => $request->job_title,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'description' => $request->description,
            'facebook' => $request->facebook,
            'whatsapp' => $request->whatsapp,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'linkedin' => $request->linkedin,
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
        if ($request->image) {
            $data['image'] = $request->image;
        }
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $team_info = $this->team->find($id);
        if (!$team_info) {
            abort(404);
        }
        $title = 'Update Team';
        return view('admin/teams/form', compact('team_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $team_info = $this->team->find($id);
        if (!$team_info) {
            abort(404);
        }
        $this->validate($request, $this->teamValidate($request));
        try {
            $data = $this->mapteamData($request);
            $team_info->fill($data)->save();
            $request->session()->flash('success', 'Team updated successfully.');
            return redirect()->route('team.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $team_info = $this->team->find($id);
        if (!$team_info) {
            abort(404);
        }
        try {
            $team_info->updated_by = Auth::user()->id;
            $team_info->save();
            $team_info->delete();
            $request->session()->flash('success', 'Team deleted successfully.');
            return redirect()->route('team.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        $this->team->find($request->id)->update(['publish_status'=>$request->status]);

    }
    public function changedisplayhome(Request $request)
    {
        $this->team->find($request->id)->update(['display_home'=>$request->status]);

    }
}
