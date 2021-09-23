@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/team.js') }}"></script>
        <script>
            $('#lfm').filemanager('image');
            $(document).ready(function() {
                $(document).off('click', '#add').on('click', '#add', function(e) {
                    $('#dynamic_field').append(
                        `<div class="col-md-9">
                                    <div class="row float-right">
                                        <input type="text" class="form-control col-sm-9" name="features[]">
                                        <br><br>
                                        <button type="button" class="btn btn_remove" style="margin-top: -10px;">
                                            <i class="fas fa-trash nav-icon"></i>
                                            </button>
                                            </div>
                                            </div>`
                    );
                });
                $(document).on('click', '.btn_remove', function() {
                    $(this).closest('div').remove();
                });
            });

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
                        <a href="{{ route('team.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($team_info))
                        {{ Form::open(['url' => route('team.update', $team_info->id), 'files' => true, 'class' => 'form', 'name' => 'team_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('team.store'), 'files' => true, 'class' => 'form', 'name' => 'team_form']) }}
                    @endif
                    <div class="row">
                        <div class="col-lg-8 ">

                            <div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
                                {{ Form::label('title', 'Name :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('title', @$team_info->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter Name', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('title')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('job_title') ? 'has-error' : '' }}">
                                {{ Form::label('job_title', 'Job Title :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('job_title', @$team_info->job_title, ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'placeholder' => 'Job Title', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('job_title')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                                {{ Form::label('email', 'Email :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('email', @$team_info->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'email', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('email')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                {{ Form::label('phone_number', 'Phone Number :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::number('phone_number', @$team_info->phone_number, ['class' => 'form-control', 'id' => 'phone_number', 'placeholder' => 'phone_number', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('phone_number')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('address') ? 'has-error' : '' }}">
                                {{ Form::label('address', 'Address :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('address', @$team_info->address, ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'placeholder' => 'address', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('address')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                               <div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}">
                                {{ Form::label('description', 'Description :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('description', @$information_info->description, ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'placeholder' => 'Description', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('description')
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
                                            {{ Form::textarea('meta_title', @$team_info->meta_title, ['class' => 'form-control  ', 'id' => 'meta_title', 'rows' => 3, 'placeholder' => 'Meta Title', 'required' => true, 'style' => 'width:80%; resize:none']) }}
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
                                            {{ Form::textarea('meta_description', @$team_info->meta_description, ['class' => 'form-control  ', 'id' => 'meta_description', 'rows' => 3, 'placeholder' => 'Meta Description', 'required' => true, 'style' => 'width:80%; resize:none']) }}
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
                                            {{ Form::textarea('meta_keyword', @$team_info->meta_keyword, ['class' => 'form-control  ', 'id' => 'meta_keyword', 'rows' => 3, 'placeholder' => 'Meta Keyword', 'required' => true, 'style' => 'width:80%; resize:none']) }}
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
                                            {{ Form::textarea('meta_keyphrase', @$team_info->meta_keyphrase, ['class' => 'form-control  ', 'id' => 'meta_keyphrase', 'rows' => 3, 'placeholder' => 'Meta Keyphrase', 'required' => true, 'style' => 'width:80%; resize:none']) }}
                                            @error('meta_keyphrase')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">

                            <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                                {{ Form::label('email', 'Email :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('email', @$team_info->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'email', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('email')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('faceboook') ? 'has-error' : '' }}">
                                {{ Form::label('faceboook', 'Faceboook URL :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('faceboook', @$team_info->faceboook, ['class' => 'form-control', 'id' => 'faceboook', 'placeholder' => 'Faceboook URL', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('faceboook')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('whatsapp') ? 'has-error' : '' }}">
                                {{ Form::label('whatsapp', 'Whatsapp URL :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('whatsapp', @$team_info->whatsapp, ['class' => 'form-control', 'id' => 'whatsapp', 'placeholder' => 'Whatsapp URL', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('whatsapp')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('twitter') ? 'has-error' : '' }}">
                                {{ Form::label('twitter', 'Twitter URL :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('twitter', @$team_info->twitter, ['class' => 'form-control', 'id' => 'twitter', 'placeholder' => 'Twitter URL', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('twitter')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('youtube') ? 'has-error' : '' }}">
                                {{ Form::label('youtube', 'Youtube URL :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('youtube', @$team_info->youtube, ['class' => 'form-control', 'id' => 'youtube', 'placeholder' => 'Youtube URL', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('youtube')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('linkedin') ? 'has-error' : '' }}">
                                {{ Form::label('linkedin', 'LinkedIn URL :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('linkedin', @$team_info->linkedin, ['class' => 'form-control', 'id' => 'linkedin', 'placeholder' => 'LinkedIn URL', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('linkedin')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('image') ? 'has-error' : '' }}">
                                {{ Form::label('image', 'Image:*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                                                Choose
                                            </a>
                                        </span>
                                        <input id="image" height="100px" class="form-control" type="text" name="image">
                                    </div>
                                    <div id="holder" style="border-radius: 4px;
                                                      padding: 5px;
                                                      width: 150px;
                                                      margin-top:15px;"></div>
                                    @if (isset($team_info->image))
                                        Old Image: &nbsp; <img src="{{ $team_info->image }}" alt="Couldn't load image"
                                            class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('image')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('display_home') ? 'has-error' : '' }}">
                                {{ Form::label('display_home', 'Display Home :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('display_home', [1 => 'Yes', 0 => 'No'], @$team_info->display_home, ['id' => 'display_home', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('display_home')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('publish_status') ? 'has-error' : '' }}">
                                {{ Form::label('publish_status', 'Publish Status :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('publish_status', [1 => 'Yes', 0 => 'No'], @$team_info->publish_status, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
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
