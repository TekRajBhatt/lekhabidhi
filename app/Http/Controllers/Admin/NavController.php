<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use App\Models\NavCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NavController extends Controller
{
    protected $nav;
    public function __construct(Nav $nav)
    {
        $this->nav = $nav;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nav_items = Nav::orderBy('position', 'asc')->paginate(10);
        return view('backend.nav.index', compact('nav_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nav_categories = NavCategory::latest()->get();
        $parent_navs = Nav::where('parent_id', null)->get();
        return view('backend.nav.create', compact('nav_categories', 'parent_navs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nav_count = Nav::all()->count();

        $this->validate($request, [
            'name'    => 'required|array',
            'name.*'  => 'required|string',
            'nav_category' => 'required',
            'main_child' => 'required',
            'parent_id' => '',
            'show_in' => ''
        ]);

        $parent_id = NULL;
        $show_in = 1;
        if($request['main_child'] == 1)
        {
            $parent_id = $request['parent_id'];
        }
        else if($request['main_child'] == 0)
        {
            $show_in = $request['show_in'];
        }

        $new_nav = Nav::create([
            'name' => $request['name'],
            'slug' => Str::slug($request->name['en']),
            'position' => $nav_count + 1,
            'category_slug' => $request['nav_category'],
            'main_child' => $request['main_child'],
            'parent_id' => $parent_id,
            'header_footer' => $show_in
        ]);

        $new_nav->save();
        return redirect()->route('nav.index')->with('success', 'nav information is saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function show(Nav $nav)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nav = Nav::findorFail($id);
        $nav_categories = NavCategory::latest()->get();
        $parent_navs = Nav::where('parent_id', null)->get();
        return view('backend.nav.edit', compact('nav', 'nav_categories', 'parent_navs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nav = Nav::findorFail($id);
        $this->validate($request, [
            'name'    => 'required|array',
            'name.*'  => 'required|string',
            'nav_category' => 'required',
            'main_child' => 'required',
            'parent_id' => '',
            'show_in' => ''
        ]);

        $parent_id = NULL;
        $show_in = 1;
        if($request['main_child'] == 1)
        {
            $parent_id = $request['parent_id'];
        }
        else if($request['main_child'] == 0)
        {
            $show_in = $request['show_in'];
        }

        $nav->update([
            'name' => $request['name'],
            'slug' => Str::slug($request->name['en']),
            'category_slug' => $request['nav_category'],
            'main_child' => $request['main_child'],
            'parent_id' => $parent_id,
            'header_footer' => $show_in
        ]);

        return redirect()->route('nav.index')->with('success', 'nav information is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $nav = Nav::findorFail($id);
        $child_navs = Nav::where('parent_id', $nav->id)->get();
        if(count($child_navs) > 0)
        {
            return redirect()->back()->with('error', 'This nav contains child navs.');
        }
        $nav->delete();
        return redirect()->route('nav.index')->with('success', 'nav information is deleted successfully.');
    }

    public function updateNavOrder(Request $request)
    {
        parse_str($request->sort, $arr);
        $order = 1;
        if (isset($arr['navItem'])) {
            foreach ($arr['navItem'] as $key => $value) {  //id //parent_id
                $this->nav->where('id', $key)
                    ->update([
                        'position' => $order,
                        'parent_id' => ($value == "null") ? NULL : $value,
                        'main_child' => ($value == "null") ? 0 : 1,
                    ]);
                $order++;
            }
        }

        return true;
    }

    private function update_child($id)
    {
        $navs = Nav::where('parent_id', $id)->get();
        if ($navs->count() > 1) {
            foreach ($navs as $child) {
                Nav::where('id', $child->id)->update(['parent_id' => $child->id]);
                $this->update_child($child->id);
            }
            // $this->forgetnavCache();
        }
    }
}
