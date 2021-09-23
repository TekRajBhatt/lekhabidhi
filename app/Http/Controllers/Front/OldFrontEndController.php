<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\AppSetting;
use App\Models\Benefit;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Category;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Container;
use App\Models\Counter;
use App\Models\Faq;
use App\Models\FrontNews;
use App\Models\Gallery;
use App\Models\Information;
use App\Models\Marketing;
use App\Models\Menu;
use App\Models\Notice;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\Team;
use App\Models\Video;
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

    public function __construct(FrontNews $news, Menu $category, Advertisement $advertisement)
    {
        $this->news = $news;
        $this->category = $category;
        $this->advertisement = $advertisement;
        $this->get_web();
    }

    public function home()
    {
        // ----------------------------- Slider Data ----------------------------------------------
        $sliders = Slider::select('title', 'sub_title', 'image', 'description')->where('publish_status', '1')->orderBy('position', 'ASC')->get();

        // ----------------------------- Client Data ----------------------------------------------
        $client_raw = Client::where('publish_status', '1')->where('display_home', '1')->orderBy('position', 'ASC')->get();
        // dd(isset($client_raw));
        if (isset($client_raw)) {
            foreach ($client_raw as $key => $value) {
                $client[] = [
                    'title' => $value->title,
                    'logo' => $value->logo,
                    'url' => $value->url,
                    'slug' => $value->slug,
                ];
            }
        }
        // ----------------------------- Services Data ----------------------------------------------
        $service_raw = Information::where('publish_status', '1')->where('display_home', '1')->orderBy('position', 'ASC')->get();
        // dd(isset($service_raw));
        if (isset($service_raw)) {
            foreach ($service_raw as $key => $value) {
                $service[] = [
                    'title' => $value->title,
                    'description' => $value->description,
                    'image' => $value->image,
                    'slug' => $value->slug,
                ];
            }
        }
        // ----------------------------- Benefit Data ----------------------------------------------
        $benefit_raw = Container::where('publish_status', '1')->where('type', 'benefits')->orderBy('position', 'ASC')->get();
        // dd($benefit_raw);
        if (isset($benefit_raw)) {
            foreach ($benefit_raw as $key => $value) {
                $benefit[] = [
                    'title' => $value->title,
                    'icon' => $value->icon,
                ];
            }
        }
        $blog = Blog::with(['publisher'])->where('publish_status', '1')->where('display_home', '1')->select('title', 'description', 'featured_image', 'slug', 'created_by', 'created_at')->orderby('id', 'DESC')->take(3)->get();
        // dd($blog);
        $counter = Counter::where('publish_status', '1')->first();
        // dd($counter);
        $faq = Faq::where('publish_status', '1')->where('display_home', '1')->orderby('position', 'ASC')->get();

        $videos = Video::where('publish_status', '1')->where('display_home', '1')->orderby('position', 'ASC')->first();
        $notice = Notice::where('publish_status', '1')->orderby('position', 'ASC')->first();

        $data = [
            'meta' => $this->getMetaData(),
            'sliders' => $sliders ?? null,
            'client' => $client ?? null,
            'service' => $service ?? null,
            'benefit' => $benefit ?? null,
            'blog' => $blog ?? null,
            'counter' => $counter ?? null,
            'faq' => $faq ?? null,
            'videos' => $videos ?? null,
            'notice' => $notice ?? null,
        ];
        // dd($data);
        return view('website.index', $data);
    }

    public function page($data = null)
    {

        // dd($data);

        $pagedata = Menu::where('slug', $data)->first();

        // dd($pagedata);

        if ($data != null) {

            $pagevalue = @$pagedata->content_type;
            // dd($pagevalue);
            switch ($pagevalue) {

                case 'about':
                    $meta = $this->getMetaData($pagedata);
                    $mission = Container::where('publish_status', '1')->where('type', 'mission_vision')->orderby('position', 'ASC')->select('title', 'icon', 'description')->get();
                    $customer_satisfy = Container::where('publish_status', '1')->where('type', 'customer_satisfy')->orderby('position', 'ASC')->select('title', 'icon', 'description','image')->get();
                    //  dd($mission);
                    return view('website.about', compact('pagedata', 'meta', 'mission', 'customer_satisfy'));
                    break;

                case 'services':
                    if ($pagedata->parent_id == null) {
                        $service = Information::where('publish_status', '1')->paginate(20);
                        $meta = $this->getMetaData($pagedata);
                        return view('website.all-services', compact('pagedata', 'meta', 'service'));
                    } else {
                        $servicedata = new Information();
                        $service = $servicedata->where('slug', $data)->where('publish_status', '1')->first();

                        $view_count = $service->view_count + 1;
                        $service->view_count = $view_count;
                        $service->save();

                        $related_services = $servicedata->where('slug', '!=', $data)->where('publish_status', '1')->limit(5)->orderby('id', 'DESC')->pluck('title', 'slug');
                        $meta = $this->getMetaData($service);
                        $faq = Faq::where('publish_status', '1')->orderby('position', 'ASC')->get();
                        $contact_data = AppSetting::select('address', 'phone', 'email')->first();
                        $data = [
                            'service' => $service,
                            'meta' => $meta,
                            'faq' => $faq,
                            'related_services' => $related_services,
                            'contact_data' => $contact_data,
                        ];

                        return view('website.singleservice')->with($data);
                    }

                    break;

                case 'marketing':
                    if ($pagedata->parent_id == null) {
                        $marketing = Marketing::where('publish_status', '1')->paginate(20);
                        $meta = $this->getMetaData($pagedata);
                        return view('website.all-marketings', compact('pagedata', 'meta', 'marketing'));
                    } else {
                        $marketingdata = new Marketing();
                        $marketing = $marketingdata->where('slug', $data)->where('publish_status', '1')->first();

                        $view_count = $marketing->view_count + 1;
                        $marketing->view_count = $view_count;
                        $marketing->save();

                        $related_marketings= $marketingdata->where('slug', '!=', $data)->where('publish_status', '1')->limit(5)->orderby('id', 'DESC')->pluck('title', 'slug');
                        $meta = $this->getMetaData($marketing);
                        $faq = Faq::where('publish_status', '1')->orderby('position', 'ASC')->get();
                        $contact_data = AppSetting::select('address', 'phone', 'email')->first();
                        $data = [
                            'marketing' => $marketing,
                            'meta' => $meta,
                            'faq' => $faq,
                            'related_services' => $related_services,
                            'contact_data' => $contact_data,
                        ];

                        return view('website.singlemarketing')->with($data);
                    }

                    break;

                    case 'commit':
                        if ($pagedata->parent_id == null) {
                            $commit = Commit::where('publish_status', '1')->paginate(20);
                            $meta = $this->getMetaData($pagedata);
                            return view('website.all-marketings', compact('pagedata', 'meta', 'commit'));
                        } else {
                            $commitdata = new Commit();
                            $commit = $commitdata->where('slug', $data)->where('publish_status', '1')->first();

                            $view_count = $commit->view_count + 1;
                            $commit->view_count = $view_count;
                            $commit->save();

                            $related_commits= $commitdata->where('slug', '!=', $data)->where('publish_status', '1')->limit(5)->orderby('id', 'DESC')->pluck('title', 'slug');
                            $meta = $this->getMetaData($commit);
                            $faq = Faq::where('publish_status', '1')->orderby('position', 'ASC')->get();
                            $contact_data = AppSetting::select('address', 'phone', 'email')->first();
                            $data = [
                                'commit' => $commit,
                                'meta' => $meta,
                                'faq' => $faq,
                                'related_services' => $related_services,
                                'contact_data' => $contact_data,
                            ];

                            return view('website.singlecommit')->with($data);
                        }

                        break;

                case 'contact':
                    $setting = AppSetting::orderBy('created_at', 'desc')->select('address', 'email', 'phone', 'map_url')->first();
                    $meta = $this->getMetaData($pagedata);
                    return view('website.contact', compact('setting', 'pagedata', 'meta'));
                    break;

                case 'gallery':
                    $gallery = Gallery::where('publish_status', '1')->orderby('id', 'DESC')->select('id', 'title', 'cover_image', 'slug')->get();
                    // dd($gallery);
                    $meta = $this->getMetaData($pagedata);
                    return view('website.gallery', compact('gallery', 'pagedata', 'meta'));
                    break;

                case 'blog':
                    if ($pagedata->parent_id == null) {
                        $blog_data = new Blog();

                        if (request()->category) {
                            $blog = $blog_data->join('blog_categories', 'blog_categories.blog_id', 'blogs.id')
                                ->where('blog_categories.category_id', request()->category)
                                ->where('blogs.publish_status', '1')
                                ->select('blogs.*')
                                ->paginate(6);
                        } else {
                            $blog = $blog_data->with(['publisher'])
                                ->where('publish_status', '1')
                                ->when(request()->keyword, function ($q) {
                                    return $q->where('title', 'like', "%" . request()->keyword . "%");
                                })
                                ->select('title', 'description', 'featured_image', 'slug', 'created_by', 'created_at')
                                ->orderby('id', 'DESC')
                                ->paginate(6);
                        }
                        $meta = $this->getMetaData($pagedata);
                        return view('website.blog-page', compact('pagedata', 'meta', 'blog'));
                    } else {
                        //  $banner_img = Menu::where('slug', 'blog')->first();
                        //  dd($banner_img);

                        $blogs = new Blog();
                        $blogdata = $blogs->with(['publisher'])->where('publish_status', '1')->where('slug', $data)->first();
                        $view_count = $blogdata->view_count + 1;
                        $blogdata->view_count = $view_count;
                        $blogdata->save();

                        $meta = $this->getMetaData($blogdata);

                        $blogtags = DB::table('blog_tag')->where('blog_id', $blogdata->id)->pluck('tag_id');
                        $relatedblog_id = DB::table('blog_tag')->whereIn('tag_id', $blogtags)->pluck('blog_id');
                        // dd($relatedblog_id);
                        $related_blog = $blogs->with(['publisher'])->where('publish_status', '1')->where('slug', '!=', $data)->whereIn('id', $relatedblog_id)->select('title', 'featured_image', 'slug', 'created_by', 'created_at')->orderby('id', 'DESC')->take(9)->get();
                        // dd($related_blog);
                        $popularblog = $blogs->where('publish_status', '1')->where('slug', '!=', $data)->orderby('view_count', 'DESC')->select('title', 'featured_image', 'slug', 'created_at')->take(6)->get();
                        $data = [
                            'blogdata' => $blogdata,
                            'meta' => $meta,
                            // 'tags'=>$tags,
                            'related_blog' => $related_blog,
                            'popularblog' => $popularblog,
                        ];
                        return view('website.blogdetail')->with($data);
                        // dd($meta);
                    }
                    break;
                case 'portfolio':
                    if ($pagedata->parent_id == null) {

                        $portfolio = Client::where('publish_status', '1')->orderby('position','ASC')->select('title', 'image', 'url', 'slug','logo')->paginate(40);;
                        $meta = $this->getMetaData($pagedata);
                        // dd($portfolio);
                        return view('website.portfolio', compact('portfolio', 'pagedata', 'meta'));
                    } else {
                        $portfolio = Client::where('publish_status', '1')->where('slug', $data)->first();
                        $meta = $this->getMetaData($portfolio);
                        return view('website.singleportfolio', compact('portfolio', 'meta'));
                    }
                case 'team':
                    $meta = $this->getMetaData($pagedata);
                    $team = Team::select(
                        'teams.*',
                        // "designations.title"
                    )
                        ->leftJoin('designations', 'designations.id', 'teams.designation_id')
                        ->with('designation:id,title,position')
                        ->orderBy('designations.position', 'ASC')
                        ->where('teams.publish_status', '1')
                        ->get();
                    // dd($team[0]->designation->title);


                    return view('website.team', compact('pagedata', 'meta', 'team'));
                    break;
                case 'career':
                    $meta = $this->getMetaData($pagedata);
                    $careers = Career::where('publish_status','1')->where('deadline','>=',now())->get();
                    // dd($careers);
                    return view('website.career', compact('meta', 'pagedata','careers'));
                    break;

                case 'basicpage':
                    $meta = $this->getMetaData($pagedata);
                    // dd($pagedata);
                    return view('website.basicpage', compact('pagedata', 'meta'));
                    break;
                    // case 'video':
                    //     $videos = Video::where('publish_status', '1')->orderBy('created_at','desc')->paginate(7);
                    //     $meta = AppSetting::orderBy('created_at', 'desc')->first();
                    //     if ($meta != null) {
                    //         $meta->meta_title = @$pagedata->meta_title;
                    //         $meta->meta_keyword = @$pagedata->meta_keyword;
                    //         $meta->meta_description = @$pagedata->meta_description;
                    //     }
                    //     return view('website.video', compact('pagedata', 'meta','video'));
                    //     break;
                default:
                    return redirect()->route('index');
                    break;
            }
        } else {
            return redirect()->route('index');
        }
    }

    public function contactStore(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            //    'name'=>'required|min:3|max:191',
            //    'email'=>'required',
            //    'message'=>'required|min:3|max:191',
        ]);
        // dd($request->all());
        $secret = env('GOOGLE_SECRET_KEY');
        $captcha = $request->input('g-recaptcha-response');
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
        // dd($response);
        if ($response['success']) {
            try {
                // dd($request->all());
                $contact = new Contact();
                $contact->name = $request->name;
                $contact->email = $request->email;
                $contact->subject = $request->subject;
                $contact->phone = $request->phone;
                $contact->message = $request->message;
                $contact->save();

                $request->session()->flash('success', 'Submitted Successfully!.');
                return back();
            } catch (\Exception $e) {
                $error = $e;

                $request->session()->flash('error', $error);
                return back();
            }
        } else {
            $request->session()->flash('error', 'Google Recapture Error!.');
            return back();
        }
        $error = null;
    }
    protected function getMetaData($data = null)
    {
        // dd($data);
        $website = AppSetting::select('*')->orderBy('created_at', 'desc')->first();
        // dd($website);
        $image = null;
        if (isset($data->image) && validate_url($data->image)) {
            // dd('ss');
            $image = $data->image;
        }
        if (isset($data->featured_image) && validate_url($data->featured_image)) {
            $image = $data->featured_image;
        }
        if (isset($data->featured_img)) {
            $image = env('APP_URL') . '/uploads/' . $data->featured_img_path . $data->featured_img;
        }

        $meta = [
            'meta_title' => @$data->meta_title ?? $website->meta_title ?? 'nectar-digit',
            'meta_keyword' =>  @$data->meta_keyword ?? $website->meta_keyword ?? 'nectar-keyword',
            'meta_description' =>  @$data->meta_description ?? $website->meta_description ?? 'nectar-description',
            'meta_keyphrase' => @$data->meta->keyphrase ?? $website->meta_keyphrase ?? 'nectar-keyphrase',
            'og_image' => create_image_url($image, 'same') ?? create_image_url($website->og_image, 'banner') ?? env('APP_URL') . '/images/logo.png',
            'og_url' => route('index'),
            'og_site_name' => $website->name,
        ];
        // dd($website);
        return $meta;
    }


    // public function redirectAdvertise(Request $request)
    // {
    //     // dd($request->all());

    //     try {
    //         $advertise = Advertisement::find($request->path);
    //         // dd($advertise);
    //         abort_if(!$advertise, 404);
    //         DB::beginTransaction();
    //         $advertise->view_count = $advertise->view_count + 1;
    //         $advertise->save();
    //         DB::commit();
    //         return redirect()->to($request->r);
    //     } catch (\Exception $error) {
    //         // dd($error);
    //         DB::rollback();
    //         return redirect()->route('index');
    //     }
    // }

    // public function singleservice($singleservice = null)
    // {
    //     // dd($singleservice);
    //     $servicedata = new Information();
    //     $service = $servicedata->where('slug', $singleservice)->where('publish_status', '1')->first();

    //     $related_services = $servicedata->where('slug', '!=', $singleservice)->where('publish_status', '1')->limit(5)->orderby('id', 'DESC')->pluck('title', 'slug');
    //     $meta = $this->getMetaData($service);
    //     $faq = Faq::where('publish_status', '1')->orderby('position', 'ASC')->get();
    //     $contact_data = AppSetting::select('address', 'phone', 'email')->first();
    //     $data = [
    //         'service' => $service,
    //         'meta' => $meta,
    //         'faq' => $faq,
    //         'related_services' => $related_services,
    //         'contact_data' => $contact_data,
    //     ];

    //     return view('website.singleservice')->with($data);
    //     // dd($service);
    // }

    // public function blogdetail($slug = null)
    // {
    //     // dd($slug);
    //     $blogs = new Blog();
    //     $blogdata = $blogs->with(['publisher'])->where('publish_status', '1')->where('slug', $slug)->first();
    //     $view_count = $blogdata->view_count + 1;
    //     $blogdata->view_count = $view_count;
    //     $blogdata->save();

    //     $meta = $this->getMetaData($blogdata);

    //     // $tags = Tag::where('publish_status', '1')->orderBy('id', 'DESC')->get();
    //     // $tags = Tag::pluck('title', 'id');

    //     $blogtags = DB::table('blog_tag')->where('blog_id', $blogdata->id)->pluck('tag_id');
    //     $relatedblog_id = DB::table('blog_tag')->whereIn('tag_id', $blogtags)->pluck('blog_id');
    //     // dd($relatedblog_id);
    //     $related_blog = $blogs->with(['publisher'])->where('publish_status', '1')->where('slug', '!=', $slug)->whereIn('id', $relatedblog_id)->select('title', 'featured_image', 'slug', 'created_by', 'created_at')->orderby('id', 'DESC')->take(6)->get();
    //     // dd($related_blog);
    //     $popularblog = $blogs->where('publish_status', '1')->where('slug', '!=', $slug)->orderby('view_count', 'DESC')->select('title', 'featured_image', 'slug', 'created_at')->take(6)->get();
    //     $data = [
    //         'blogdata' => $blogdata,
    //         'meta' => $meta,
    //         // 'tags'=>$tags,
    //         'related_blog' => $related_blog,
    //         'popularblog' => $popularblog,
    //     ];
    //     return view('website.blogdetail')->with($data);
    //     // dd($meta);

    // }

    // public function singleportfolio($slug)
    // {
    //     $portfolio = Client::where('publish_status', '1')->where('slug', $slug)->first();
    //     $meta = $this->getMetaData($portfolio);
    //     return view('website.singleportfolio', compact('portfolio', 'meta'));
    // }

    // public function searchblog(Request $request){
    //     dd($request->keyword);
    //     $blog = Blog::with(['publisher'])->where('publish_status', '1')->where('title','like', "%{$request->keyword}%")->select('title', 'description', 'featured_image', 'slug', 'created_by', 'created_at')->orderby('id', 'DESC')->get();
    //     $meta = $this->getMetaData(null);
    //     // dd($blog);
    //     return view('website.search-blog', compact('meta', 'blog'));
    // }

    // public function featch_data(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $pagedata = Menu::where('slug', 'blog')->first();
    //         $blog = Blog::with(['publisher'])
    //             ->where('publish_status', '1')
    //             ->when(request()->keyword, function ($q) {
    //                 return $q->where('title', 'like', "%" . request()->keyword . "%");
    //             })
    //             ->select('title', 'description', 'featured_image', 'slug', 'created_by', 'created_at')
    //             ->orderby('id', 'DESC')
    //             ->paginate(6);
    //         $meta = $this->getMetaData($pagedata);

    //         return view('website.Blog_Pagination_data.blod-page-data', compact('pagedata', 'meta', 'blog'))->render();
    //         // dd($html);
    //         // return response()->json([
    //         //     'status' => true,
    //         //     'html' => $html,
    //         //     'tab_data' => $request->tab_data,
    //         // ]);
    //     }
    // }

    public function sitemap()
    {
        // create new sitemap object
        $sitemap = App::make("sitemap");
        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), date(now()), 'Home');


        $blogs = DB::table('blogs')->orderBy('created_at', 'desc')->get();
        foreach ($blogs as $value) {
            $title = str_replace('-', ' ', $value->slug);
            $sitemap->add(URL::to($value->slug), $value->created_at, $title);
        }
        $service = DB::table('information')->orderBy('created_at', 'desc')->get();
        foreach ($service as $value) {
            $title = str_replace('-', ' ', $value->slug);
            $sitemap->add(URL::to($value->slug), $value->created_at, $title);
        }
        $service = DB::table('information')->orderBy('created_at', 'desc')->get();
        foreach ($service as $value) {
            $title = str_replace('-', ' ', $value->slug);
            $sitemap->add(URL::to($value->slug), $value->created_at, $title);
        }
        $marketing = DB::table('marketings')->orderBy('created_at', 'desc')->get();
        foreach ($marketing as $value) {
            $title = str_replace('-', ' ', $value->slug);
            $sitemap->add(URL::to($value->slug), $value->created_at, $title);
        }
        $clients = DB::table('clients')->orderBy('created_at', 'desc')->get();
        foreach ($clients as $value) {
            $title = str_replace('-', ' ', $value->slug);
            $sitemap->add(URL::to($value->slug), $value->created_at, $title);
        }
        $team = DB::table('teams')->orderBy('created_at', 'desc')->get();
        foreach ($team as $value) {
            $title = str_replace('-', ' ', $value->slug);
            $sitemap->add(URL::to($value->slug), $value->created_at, $title);
        }
        $Menus = DB::table('menus')->orderBy('created_at', 'desc')->get();
        foreach ($Menus as $value) {
            $title = str_replace('-', ' ', $value->slug);
            $sitemap->add(URL::to($value->slug), $value->created_at, $title);
        }


        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
        $sitemapUrl = env('APP_URL') . 'sitemap.xml';


        // //Submite to Google
        $url = "https://www.google.com/ping?sitemap=" . $sitemapUrl;
        $this->Submit_SiteMap($url);

        // //Bing / MSN
        $url = "http://www.bing.com/ping?sitemap=" . $sitemapUrl;
        $this->Submit_SiteMap($url);
        // Live
        $url = "http://webmaster.live.com/ping.aspx?siteMap=" . $sitemapUrl;
        $this->Submit_SiteMap($url);

        return redirect(url('sitemap.xml'));
    }

    public function Submit_SiteMap($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpCode;
    }

    public function feed()
    {
        $appSetting =  AppSetting::select('*')->orderBy('id', 'desc')->first(1);
        $blog = Blog::orderBy('id', 'desc')->where('publish_status', '1')->get();
        $service = Information::orderBy('id', 'desc')->where('publish_status', '1')->get();
        return response()
            ->view('feed', compact('blog', 'service', 'appSetting'))
            ->header('Content-Type', 'application/xml');
    }
}
