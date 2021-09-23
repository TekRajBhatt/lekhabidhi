<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Room;
use App\Models\Roomactivities;
use App\Models\Roomcategory;
use App\Models\roomimage;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{

    public function home(){

        $sliders = Slider::select('title', 'sub_title', 'image', 'description')->where('publish_status', '1')->orderBy('position', 'ASC')->get();



    //    $slider = Slider::where('publish_status','1')->latest()->get();
        // $services = Service::where('publish_status','1')->latest()->get();
        // $room = Room::where('publish_status','1')->latest()->take(3)->get();
        // $why_choose = Content::where('publish_status', '1')->where('category_id', '6')->take(4)->get();
        // $popular_artical_one = Content::where('publish_status', '1')->where('category_id', '1')->orderBy('view_count', 'DESC')->take(1)->get();
        // $popular_artical_one_off = Content::where('publish_status', '1')->where('category_id', '1')->orderBy('view_count', 'DESC')->take(4)->offset(1)->get();
        // // dd($popular_artical_one_off);
        // return view('frontend.index', compact('slider','services','room','why_choose','popular_artical_one','popular_artical_one_off'));
       // return view('frontend.index', compact('slider'));

    }
}


    // public function ContentDetail($slug){

    //     $content = Content::where('slug', $slug)->first();
    //     $id = $content->id;
    //     $category_id = $content->category_id;
    //     $testimonial = Testimonial::where('publish_status', '1')->get();
    //     $popular = Content::where('publish_status', '1')->where('category_id', $category_id)->where('id', '!=', $id)->orderBy('view_count', 'DESC')->get();
    //     // dd($popular);
    //     return view('frontend/content/page', compact('content','testimonial','popular'));
    // }

    // public function serviceDetails($slug){
    //     $services = Service::where('slug', $slug)->first();
    //     $id = $services->id;
    //     $all_service = Service::where('publish_status', '1')->where('id', '!=', $id)->latest()->get();
    //     return view('frontend/content/servicedetail', compact('services','all_service'));
    // }

    // public function roomDetail($slug){
    //     $roomdetails = Room::where('slug', $slug)->first();
    //     $room_id = $roomdetails->id;
    //     $roomimage = roomimage::where('room_id', $room_id)->get();
    //     $room_cat = $roomdetails->category_id;
    //     $cat_room = Room::Where('category_id', $room_cat)->where('id', '!=', $room_id)->latest()->get();
    //     // dd($cat_room);
    //     return view('frontend/room/detail', compact('roomdetails','roomimage', 'cat_room'));
    // }

    // public function rooms(){
    //     $rooms = Room::where('publish_status', '1')->latest()->paginate(9);
    //     $title = 'All Rooms';
    //     return view('frontend/room/list', compact('rooms','title'));

    // }

    // public function roomCategory($slug){

    //     $cat_details = Roomcategory::where('slug', $slug)->first();
    //     $cat_id = $cat_details->id;
    //     $title = $cat_details->title;
    //     $rooms = Room::where('publish_status', '1')->where('category_id',$cat_id)->latest()->paginate(9);
    //     return view('frontend.room.list', compact('rooms', 'title'));
    // }

    // public function search(Request $request){
    //     $search_term =$request['search'];
    //     // dd($search_term);
    //     // query();
    //     if ($request['search']) {
    //         $content = Content::where('content_title', 'Like', '%' . $request['search'] . '%')->orderBy('id', 'DESC')->paginate(10);
    //         // dd($content);
    //     }

    //     return view('frontend.content.search', compact('content', 'search_term'));
    // }

