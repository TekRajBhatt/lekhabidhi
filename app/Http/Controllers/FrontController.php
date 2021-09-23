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

class FrontController extends Controller
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


    public function pageSlug($slug)
    {
        if ($slug == "home") {
            return redirect()->route('index');
        }
        // else if($slug == "about-us")
        // {
        //     $setting = Setting::first();
        //     $mission_vision = MissionMessages::first();
        //     $member_benefit = MembershipBenefits::first();
        //     return view('frontend.aboutus', compact('setting', 'member_benefit', 'mission_vision'));
        // }
        // else if($slug == "softwares")
        // {
        //     $softwares = Software::first();
        //     return view('website.software', compact('softwares'));
        // }
        // else if($slug == "services")
        // {
        //     $services = Detail::first();
        //     return view('website.detail', compact('services'));
        // }
        else if($slug == "team")
        {
            $teams = Team::latest()->get();
            return view('website.team', compact('teams'));
        }
        else if($slug == "contact")
        {
            $contacts = Contact::latest()->get();
            return view('website.contact', compact('contacts'));
        }

        else
        {

                return redirect()->route('index');

        }
    }

    public function subMenu($slug, $id)
    {
        if ($slug == "members") {
            $member_commitee = Menu::findorFail($id);
            $members = Members::latest()->where('member_id', $id)->get();
            return view('frontend.team_members', compact('members', 'member_commitee'));
        }
        else if($slug == "committee")
        {
            $member_commitee = Menu::findorFail($id);
            $commities = Members::latest()->where('commitee_id', $id)->get();
            return view('frontend.committee_members', compact('commities', 'member_commitee'));
        }
    }

    public function aboutus()
    {
        $setting = Setting::first();
        $mission_vision = MissionMessages::first();
        $member_benefit = MembershipBenefits::first();
        return view('frontend.aboutus', compact('setting', 'member_benefit', 'mission_vision'));
    }

    public function contact()
    {
        $setting = Setting::first();
        return view('frontend.contact', compact('setting'));
    }

    public function newsPage()
    {
        $news = News::latest()->where('news_blogs', 0)->paginate(4);
        $features = Bullets::latest()->take(4)->get();
        return view('frontend.news', compact('news', 'features'));
    }

    public function blogsPage()
    {
        $blogs = News::latest()->where('news_blogs', 1)->paginate(6);
        return view('frontend.blogs', compact('blogs'));
    }

    public function gallery()
    {
        $albums = Album::latest()->get();
        return view('frontend.gallery', compact('albums'));
    }

    public function gallery_details($slug)
    {
        $album = Album::where('title_slug', $slug)->first();
        $album_images = AlbumImages::latest()->where('album_id', $album->id)->get();
        return view('frontend.gallery_details', compact('album', 'album_images'));
    }

    public function news_details($slug)
    {
        $news = News::where('slug', $slug)->first();
        $new_view = $news->view_count + 1;
        $news->update([
            'view_count' => $new_view
        ]);
        return view('frontend.news_details', compact('news'));
    }

    public function blogs_details($slug)
    {
        $news = News::where('slug', $slug)->first();
        $new_view = $news->view_count + 1;
        $news->update([
            'view_count' => $new_view
        ]);
        return view('frontend.news_details', compact('news'));
    }

    public function members($id)
    {
        $member_commitee = Membercategory::findorFail($id);
        $members = Members::latest()->where('member_id', $id)->get();
        return view('frontend.team_members', compact('members', 'member_commitee'));
    }

    public function committee($id)
    {
        $member_commitee = Membercategory::findorFail($id);
        $commities = Members::latest()->where('commitee_id', $id)->get();
        return view('frontend.committee_members', compact('commities', 'member_commitee'));
    }
}
