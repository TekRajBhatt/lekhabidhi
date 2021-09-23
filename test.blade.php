<section class="pfe-details mb">
    <div class="pf-details-banner">
        <x-shared-image newsimage="{{ create_image_url($news_detail->img_url, 'banner') }}"
            title="{{ @get_title(@$news_detail->title) }}" />
    </div>
    <div class="container">
        <div class="pf-details-wrap">
            <h1>{{ @get_title($news_detail) }}</h1>
            @if (isset($breadcrumb_advertise) && !empty($breadcrumb_advertise))
                @foreach ($breadcrumb_advertise as $key => $advertise)
                    @include('layouts.advertise-section')
                @endforeach
            @endif
            <div class="details-share">
                <div class="details-share-left">
                    <ul>
                        <li>
                            {{-- <a href="{{ route('index') }}">
                            <img class="img-fluid rounded-circle " style="padding:10px;width:70px;height:70px;border-radius:100%;" src="{{ @$sitesetting->logo_url }}" alt="images" />{{ @$sitesetting->name }}

                            </a> --}}
                            <a href="{{ route('index') }}">
                                <x-shared-image newsimage="{{ create_image_url($sitesetting->favicon, 'pp_image') }}"
                                    title="logo" />
                            </a>

                        </li>
                        <li>
                            @if (isset($news_detail->news_reporters))
                                @foreach ($news_detail->news_reporters as $key => $reporter)
                                    <a href="{{ route('getReporter', @$reporter->slug) }}">
                                        {{ get_reporter($reporter) }}
                                    </a>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </li>
                        <li>
                            <i class="far fa-clock"></i>
                            {{ published_date($news_detail->created_at) }} मा प्रकाशित
                        </li>

                    </ul>
                </div>
                <div class="details-share-right">
                    <div class="details-share-right1">

                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <ul>
                            <li class="addthis_inline_share_toolbox">
                            </li>
                        </ul>
                    </div>
                    <div class="details-share-right2">
                        <ul>
                            {{-- <li><a href="#">5 प्रतिक्रिया</a></li>
                            <li><b>1089</b> Shares</li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="pf-details-list">
                {!! $content !!}
            </div>

            <div class="comment-section">
                <div class="comment-title">
                    <h3>प्रतिक्रिया</h3>
                    <a href="#">3</a>
                </div>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0"></script>

                <div class="fb-comments" data-href="{{ URL::current() }}" style="width:100%!important;">
                </div>
            </div>
        </div>
</section>
