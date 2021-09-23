@component('mail::message')
# Thank you for subscribing Lekha Bidhi. We will get in touch with you.

<div>
    {{-- <img src="https://www.nectardigit.com//uploads/photos/logo/site-logo.png" style="height:50px; display:block; margin:10px auto;" alt="Nectar Digit Pvt. Ltd."> --}}
    <img src="{{ asset('img/logo.png')}}" style="height:50px; display:block; margin:10px auto;" alt="Lekha Bidhi">
    {{-- <h1 style="margin:15px auto;line-height:normal;color:#155724;background:#d4edda;border:1px solid #c3e6cb;padding:10px 15px;font-size: 18px;font-weight: 600;line-height: 26px;border-radius:3px;text-align:center;"> --}}
Thank you for your subscription. Click <a href="{{env('APP_URL') ?? 'https://www.lekhabidhi.com/'}}" title="{{env('APP_NAME') ?? 'Lekha Bidhi'}}"> Here </a>for more about us.</h1>

</div>

@component('mail::button', ['url' => 'https://www.lekhabidhi.com'])
    Visit Us
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
