@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/website.js') }}"></script>
        {{-- <script>
            $('#lfm').filemanager('image');
            $('#vid').filemanager('video');
        </script> --}}

        <script>
            $('#MainImage').filemanager('image');

        </script>
        <script>
            $(document).ready(function() {
                $('#image').change(function() {
                    $('#thumbnail').removeClass('d-none');
                })
            })

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

                            <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                                {{ Form::label('email', 'Email :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('email', @$website_info->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter Email', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('email')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                {{ Form::label('phone_number', 'Phone Number :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::number('phone_number', @$website_info->phone_number, ['class' => 'form-control', 'id' => 'phone_number', 'placeholder' => 'Enter Phone Number', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('phone_number')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('address') ? 'has-error' : '' }}">
                                {{ Form::label('address', 'Address :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('address', @$website_info->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Enter Address', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('address')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="form-group row {{ $errors->has('first_img') ? 'has-error' : '' }}">
                                {{ Form::label('first_img', 'First Testimonial Image:*', ['class' => 'col-sm-3']) }}
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
                                    @if (isset($website_info->first_img) )
                                        Old Image: &nbsp; <img src="{{ @$website_info->first_img }}" alt="Couldn't load first image"
                                            class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('first_img')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('second_img') ? 'has-error' : '' }}">
                                {{ Form::label('second_img', 'Testimonial Second Image:*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="vid" data-input="video" data-preview="holder" class="btn btn-primary">
                                                Choose
                                            </a>
                                        </span>
                                        <input id="video" height="100px" class="form-control" type="text" name="video">
                                    </div>
                                    <div id="holder" style="border-radius: 4px;
                                    padding: 5px;
                                    width: 150px;
                                    margin-top:15px;"></div>
                                    @if (isset($website_info->second_img) )
                                        Old Video: &nbsp; <img src="{{ @$website_info->second_img }}" alt="Couldn't load second image"
                                            class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('second_img')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                {{ Form::label('filepath', 'Image', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="MainImage" data-input="thumbnail" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="filepath"
                                            value="{{ @$website_info->image }}">
                                    </div>
                                    <div id="holder" style="border-radius: 4px;
                                            padding: 5px;
                                            width: 150px;
                                            margin-top:15px;"></div>
                                    <img src="{{ @$website_info->image }}" alt="" style="max-width: 100px">
                                </div>
                            </div>

                            {{-- <div class="form-group row {{ $errors->has('video') ? 'has-error' : '' }}">
                                {{ Form::label('video', 'Video Image:*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="vid" data-input="video" data-preview="holder" class="btn btn-primary">
                                                Choose
                                            </a>
                                        </span>
                                        <input id="video" height="100px" class="form-control" type="text" name="video">
                                    </div>
                                    <div id="holder" style="border-radius: 4px;
                                    padding: 5px;
                                    width: 150px;
                                    margin-top:15px;"></div>
                                    @if (isset($website_info->video) )
                                        Old Video: &nbsp; <img src="{{ $website_info->video }}" alt="Couldn't load video"
                                            class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('image')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}



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
                                    {{ Form::button("<i class='fa fa-paper-websitee'></i> Submit", ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
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
