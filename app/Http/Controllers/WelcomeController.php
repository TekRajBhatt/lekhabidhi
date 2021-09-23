<?php

namespace App\Http\Controllers;

use App\Models\Welcome;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class WelcomeController extends Controller
{
    public function __construct(Welcome $welcome)
    {
        $this->middleware(['permission:welcome-list|welcome-create|welcome-edit|welcome-delete'], ['only' => ['index', 'store']]);
        // $this->middleware(['permission:welcome-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:welcome-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:welcome-delete'], ['only' => ['destroy']]);
        $this->get_web();
        $this->welcome = $welcome;
    }

    protected function getInfo($request)
    {
        $query = $this->welcome->orderBy('id', 'DESC');
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', "%{$keyword}%");
        }
        return $query->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getInfo($request);
        //   dd($data);
        return view('admin/welcomes/list', compact('data'));
    }

    public function create(Request $request)
    {
       //
    }

    public function store(Request $request)
    {
        //   dd($request->all());
        $this->validate($request, $this->welcomeValidate($request));
        try {
            $data = $this->mapwelcomeData($request);
            $this->welcome->fill($data)->save();
            Mail::to($request->email)->send(new WelcomeMail());
            return  redirect()->route('index')->with('success', 'Subscribed successfully.');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function welcomeValidate($request)
    {
        $data = [
            'email' => 'required|email',

        ];

        return $data;
    }
    protected function mapwelcomeData($request)
    {
        $data = [
            'email' => $request->email,

        ];

        return $data;
    }
    public function edit(Request $request, $id)
    {
       //
    }

    public function update(Request $request, $id)
    {
      //
    }

    public function destroy(Request $request, $id)
    {
        $welcome_info = $this->welcome->find($id);
        if (!$welcome_info) {
            abort(404);
        }
        try {
            $welcome_info->delete();
            $request->session()->flash('success', 'Subscriber deleted successfully.');
            return redirect()->route('welcome.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

}
