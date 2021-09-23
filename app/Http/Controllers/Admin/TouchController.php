<?php

namespace App\Http\Controllers\Admin;

use App\Models\Touch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TouchController extends Controller
{
    public function __construct(Touch $touch)
    {
        $this->middleware(['permission:touch-list|touch-create|touch-edit|touch-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:touch-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:touch-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:touch-delete'], ['only' => ['destroy']]);
        $this->touch = $touch;
    }

    protected function gettouch($request)
    {
        $query = $this->touch;
        if (isset($request->status)) {
            $query = $this->touch->where('publish_status', $request->status);
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', "%{$keyword}%");
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->gettouch($request);
    //    dd($data);
        return view('admin/touchs/list', compact('data'));
    }

    public function create(Request $request)
    {
        // $touch_info = null;
        // $title = 'Add User';
        // return view('admin/touchs/form', compact('touch_info', 'title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->touchValidate($request));
        try {
            $data = $this->maptouchData($request);
            $this->touch->fill($data)->save();
            $request->session()->flash('success', 'User created successfully.');


            cache()->forget('app_touchs');
     //       return redirect()->route('singleservice');
            return back()->session()->flash('success', 'User created successfully.');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function touchValidate($request)
    {
        $data = [
            'name' => 'required|string|min:3|max:190',
            'email' => 'required|email',
            'message' => 'required',
        ];

        return $data;
    }

    protected function maptouchData($request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
        return $data;
    }

    public function edit(Request $request, $id)
    {
        // $touch_info = $this->touch->find($id);
        // if (!$touch_info) {
        //     abort(404);
        // }
        // $title = 'Update User';
        // return view('admin/touchs/form', compact('touch_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        // $touch_info = $this->touch->find($id);
        // if (!$touch_info) {
        //     abort(404);
        // }
        // $this->validate($request, $this->touchValidate($request));
        // try {
        //     $data = $this->maptouchData($request);
        //     $touch_info->fill($data)->save();
        //     $request->session()->flash('success', 'User updated successfully.');
        //     return redirect()->route('touch.index');
        // } catch (\Exception $error) {
        //     $request->session()->flash('error', $error->getMessage());
        //     return redirect()->back();
        // }
    }

    public function destroy(Request $request, $id)
    {
        $touch_info = $this->touch->find($id);
        if (!$touch_info) {
            abort(404);
        }
        try {
            // $touch_info->updated_by = Auth::touch()->id;
            // $touch_info->save();
         //   dd($touch_info);
            $touch_info->delete();
            $request->session()->flash('success', 'User deleted successfully.');
            cache()->forget('app_touchs');
            return redirect()->route('touch.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }


}
