<meta name="title" content="{{ @$meta['meta_title'] }}">
<meta name="description" content="{{strip_tags(@$meta['meta_description']) }}">
<meta name="keywords" content="{{ @$meta['meta_keyword'] }}">
<meta property="og:title" content="{{ @$meta['meta_title'] }}">
<meta property="og:image" content="{{ @$meta['og_image'] }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="675">
<meta property="og:image:alt" content="{{ @$meta['meta_title'] }}">
<meta property="og:description" content="{{ strip_tags(@$meta['meta_description']) }}">
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="{{ @$sitesetting->name }}" />
<meta property="og:locale" content="ne_NP" />
<meta name="twitter:card" content="{{  @$meta['og_image'] }}">
<meta name="twitter:site" content="{{ @$meta['twitter'] }}" />
<meta name="allow-search" content="yes" />
<meta name="author" content="Nectar Digit" />
<meta name="copyright" content="{{ date('Y') }} Nectar Digit " />
<meta name="coverage" content="Worldwide" />
<meta name="identifier" content="{{ route('index') }}" />
<meta name="language" content="{{ app()->getLocale() }}" />
<meta name="Robots" content="INDEX,FOLLOW" />
<link rel="canonical" href="{{ route('index') }}" />
<meta name="Googlebot" content="index, follow" />
<link rel="next" href="{{ route('index') }}" />
<meta property="fb:admins" content="" />
<meta property="fb:page_id" content="1009044339262777" />
<meta property="fb:pages" content="1009044339262777" />
<meta property="og:type" content="article" />
<meta property="ia:markup_url" content="{{ url()->current() }}">
<meta property="ia:rules_url" content="{{ url()->current() }}">
<meta property="fb:app_id" content="296672421803651" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="{{ route('index') }}" />
<meta name="twitter:title" content= "{{ substr(@$meta['meta_title'] ,70)}}" />
<meta name="twitter:description" content="{{ substr(strip_tags(@$meta['meta_description']), 120) }}" />
<meta name="twitter:image" content=" {{ @$meta['og_image'] }}" />
