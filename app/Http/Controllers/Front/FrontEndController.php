<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\AppSetting;
use App\Models\Benefit;
use App\Models\Blog;
use App\Models\Business;
use App\Models\Career;
use App\Models\Category;
use App\Models\Client;
use App\Models\Commit;
use App\Models\Contact;
use App\Models\Container;
use App\Models\Counter;
use App\Models\Detail;
use App\Models\Faq;
use App\Models\FrontNews;
use App\Models\Gallery;
use App\Models\Information;
use App\Models\Marketing;
use App\Models\Menu;
use App\Models\Nav;
use App\Models\Notice;
use App\Models\Plan;
use App\Models\Satisfy;
use App\Models\Slider;
use App\Models\Step;
use App\Models\Tag;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Website;
use App\Models\Video;
use App\Models\Work;
use App\Traits\BannerNewsTrait;
use App\Traits\SharedTrait;
use Aws\Api\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Laravelium\Feed\Feed;

class FrontEndController extends Controller
{
    use SharedTrait;
    use BannerNewsTrait;


    public function home()
    {

        // ----------------------------- Website Data ----------------------------------------------

        $websites = Website::where('publish_status', '1')->first();

        // ----------------------------- Menu Dropdown Data ----------------------------------------------

        $services = Detail::where('publish_status', '1')->get();

        // ----------------------------- Slider Data ----------------------------------------------

        $sliders = Slider::select('title', 'sub_title', 'image', 'description')->where('publish_status', '1')->orderBy('position', 'ASC')->get();

        // ----------------------------- Trending Software Data ----------------------------------------------

        $trends = Information::where('publish_status', '1')->where('display_home', '1')->orderBy('position', 'ASC')->get();

        // ----------------------------- Build Your Business Data ----------------------------------------------

        $businesses = Business::where('publish_status', '1')->first();

        // ----------------------------- Marketing Service Data ----------------------------------------------

        $marketings = Marketing::where('publish_status', '1')->where('display_home', '1')->orderBy('position', 'ASC')->get();

        // ----------------------------- Committed To Change Data ----------------------------------------------

        $commits = Commit::where('publish_status', '1')->where('display_home', '1')->orderBy('position', 'ASC')->get();

        // ----------------------------- Satisfied Clients Data ----------------------------------------------

        $satifies = Satisfy::where('publish_status', '1')->where('display_home', '1')->get();

        // ----------------------------- Testimonial Data ----------------------------------------------

        $testimonials = Testimonial::where('publish_status', '1')->get();

        // ----------------------------- Steps To Grow Business Data ----------------------------------------------

        $steps = Step::where('publish_status', '1')->where('display_home', '1')->get();

        // ----------------------------- Work Together Data ----------------------------------------------

        $works = Work::where('publish_status', '1')->where('display_home', '1')->get();

        // ----------------------------- Pricing Plan Data ----------------------------------------------

        $plans = Plan::where('publish_status', '1')->where('display_home', '1')->get();

        // ----------------------------- Trusted Partners Data ----------------------------------------------

        $clients = Client::where('publish_status', '1')->where('display_home', '1')->orderBy('position', 'ASC')->get();




        $data = [

            'websites' => $websites ?? null,
            'services' => $services ?? null,
            'sliders' => $sliders ?? null,
            'trends' => $trends ?? null,
            'businesses' => $businesses ?? null,
            'marketings' => $marketings ?? null,
            'commits' => $commits ?? null,
            'satifies' => $satifies ?? null,
            'testimonials' => $testimonials ?? null,
            'steps' => $steps ?? null,
            'works' => $works ?? null,
            'clients' => $clients ?? null,
            'plans' => $plans ?? null,


        ];
        // dd($data);
        return view('website.index', $data);
    }

    // ----------------------------- Services Detail Page Data ----------------------------------------------

    public function singleservice($slug){

        $details = Detail::where('slug', $slug)->first();
        $services = Detail::where('publish_status', '1')->get();
        $websites = Website::where('publish_status', '1')->first();

        $data = [

            'details' => $details ?? null,
            'services' => $services ?? null,
            'websites' => $websites ?? null,

        ];

        return view('website.detail', $data);

    }

    public function teampage(){

            $teams = Team::where('publish_status', '1')->get();
            $websites = Website::where('publish_status', '1')->first();
            $services = Detail::where('publish_status', '1')->get();

            $data = [

                'teams' => $teams ?? null,
                'websites' => $websites ?? null,
                'services' => $services ?? null,

            ];

            return view('website.team', $data);

        }



}
