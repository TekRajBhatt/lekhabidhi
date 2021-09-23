@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/website.js') }}"></script>
        <script>
            $('#lfm').filemanager('logo');
        </script>
    @endpush
@section('content')
    @include('admin.shared.image_upload')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('website.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($website_info))
                        {{ Form::open(['url' => route('website.update', $website_info->id), 'files' => true, 'class' => 'form', 'name' => 'website_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('website.store'), 'files' => true, 'class' => 'form', 'name' => 'website_form']) }}
                    @endif
                    <div class="row">
                        <div class="col-lg-8 ">

                            <div class="form-group row {{ $errors->has('website_name') ? 'has-error' : '' }}">
                                {{ Form::label('website_name', 'Website Name :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('website_name', @$website_info->website_name, ['class' => 'form-control', 'id' => 'website_name', 'placeholder' => 'Website Name', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('website_name')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                                {{ Form::label('email', 'Email :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('email', @$website_info->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('email')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                {{ Form::label('phone_number', 'Phone Number :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('phone_number', @$website_info->phone_number, ['class' => 'form-control', 'id' => 'phone_number', 'placeholder' => 'Phone Number', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('phone_number')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('address') ? 'has-error' : '' }}">
                                {{ Form::label('address', 'Address :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('address', @$website_info->address, ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'placeholder' => 'Address', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('address')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('logo') ? 'has-error' : '' }}">
                                {{ Form::label('logo', 'Logo:*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="logo" data-preview="holder" class="btn btn-primary">
                                                Choose
                                            </a>
                                        </span>
                                        <input id="logo" height="100px" class="form-control" type="text" name="logo">
                                    </div>
                                    <div id="holder" style="border-radius: 4px;
                                                      padding: 5px;
                                                      width: 150px;
                                                      margin-top:15px;"></div>
                                    @if (isset($website_info->logo))
                                        Old Logo: &nbsp; <img src="{{ $website_info->logo }}" alt="Couldn't load logo"
                                            class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('logo')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('footer_desc') ? 'has-error' : '' }}">
                                {{ Form::label('footer_desc', 'Footer Description :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('footer_desc', @$website_info->footer_desc, ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'placeholder' => 'Footer Description', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('footer_desc')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('copyright') ? 'has-error' : '' }}">
                                {{ Form::label('copyright', 'Copyright :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('copyright', @$website_info->copyright, ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'placeholder' => 'Copyright', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('copyright')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <h3><strong>SEO Tools</strong></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group row {{ $errors->has('meta_title') ? 'has-error' : '' }}">
                                        {{ Form::label('meta_title', 'Meta Title :', ['class' => 'col-sm-12']) }}
                                        <div class="col-sm-12">
                                            {{ Form::textarea('meta_title', @$step_info->meta_title, ['class' => 'form-control  ', 'id' => 'meta_title', 'rows' => 3, 'placeholder' => 'Meta Title', 'required' => true, 'style' => 'width:80%; resize:none']) }}
                                            @error('meta_title')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div
                                        class="form-group row {{ $errors->has('meta_description') ? 'has-error' : '' }}">
                                        {{ Form::label('meta_description', 'Meta Description :', ['class' => 'col-sm-12']) }}
                                        <div class="col-sm-12">
                                            {{ Form::textarea('meta_description', @$step_info->meta_description, ['class' => 'form-control  ', 'id' => 'meta_description', 'rows' => 3, 'placeholder' => 'Meta Description', 'required' => true, 'style' => 'width:80%; resize:none']) }}
                                            @error('meta_description')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group row {{ $errors->has('meta_keyword') ? 'has-error' : '' }}">
                                        {{ Form::label('meta_keyword', 'Meta Keyword :', ['class' => 'col-sm-12']) }}
                                        <div class="col-sm-12">
                                            {{ Form::textarea('meta_keyword', @$step_info->meta_keyword, ['class' => 'form-control  ', 'id' => 'meta_keyword', 'rows' => 3, 'placeholder' => 'Meta Keyword', 'required' => true, 'style' => 'width:80%; resize:none']) }}
                                            @error('meta_keyword')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group row {{ $errors->has('meta_keyphrase') ? 'has-error' : '' }}">
                                        {{ Form::label('meta_keyphrase', 'Meta Keyphrase :', ['class' => 'col-sm-12']) }}
                                        <div class="col-sm-12">
                                            {{ Form::textarea('meta_keyphrase', @$step_info->meta_keyphrase, ['class' => 'form-control  ', 'id' => 'meta_keyphrase', 'rows' => 3, 'placeholder' => 'Meta Keyphrase', 'required' => true, 'style' => 'width:80%; resize:none']) }}
                                            @error('meta_keyphrase')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">



                            <div class="form-group row {{ $errors->has('display_home') ? 'has-error' : '' }}">
                                {{ Form::label('display_home', 'Display Home :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('display_home', [1 => 'Yes', 0 => 'No'], @$website_info->display_home, ['id' => 'display_home', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('display_home')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('publish_status') ? 'has-error' : '' }}">
                                {{ Form::label('publish_status', 'Publish Status :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('publish_status', [1 => 'Yes', 0 => 'No'], @$website_info->publish_status, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('publish_status')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('', '', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
                                    {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'btn btn-danger btn-flat', 'type' => 'reset']) }}
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
