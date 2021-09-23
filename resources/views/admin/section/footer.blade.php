</div>
{{-- <script src="{{ asset('/assets/front/js/jquery.min.js') }}" type="text/javascript"></script> --}}
<script src="{{ asset('js/manifest.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/vendor.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/admin.js') }}" type="text/javascript"></script>
{{-- <script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script> --}}

<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script>
 @livewireScripts
@stack('scripts')
</body>
</html>
