@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
        <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/shape.js') }}"></script>
        <script>
            $('#lfm').filemanager('image');
            $('#vid').filemanager('video');

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
                        <a href="{{ route('shape.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($shape_info))
                        {{ Form::open(['url' => route('shape.update', $shape_info->id), 'files' => true, 'class' => 'form', 'name' => 'shape_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('shape.store'), 'files' => true, 'class' => 'form', 'name' => 'shape_form']) }}
                    @endif
                    <div class="row">
                        <div class="col-sm-10 offset-lg-1">
                            <div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
                                {{ Form::label('title', 'Title:*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('title', @$shape_info->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('title')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}">
                                {{ Form::label('description', 'Description:*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('description', @$shape_info->description, ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('description')
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
                                    @if (isset($shape_info->image) )
                                        Old Image: &nbsp; <img src="{{ $shape_info->image }}" alt="Couldn't load image"
                                            class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('image')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('video') ? 'has-error' : '' }}">
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
                                    @if (isset($shape_info->video) )
                                        Old Video: &nbsp; <img src="{{ $shape_info->video }}" alt="Couldn't load video"
                                            class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('image')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('publish_status') ? 'has-error' : '' }}">
                                {{ Form::label('publish_status', 'Publish Status :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('publish_status', [1 => 'Yes', 0 => 'No'], @$shape_info->publish_status, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('publish_status')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('', '', ['class' => 'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
                            {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'btn btn-danger btn-flat', 'type' => 'reset']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
