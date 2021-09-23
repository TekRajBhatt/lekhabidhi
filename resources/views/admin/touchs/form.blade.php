{{-- @extends('layouts.admin')
@section('title', $title)
    @push('scripts')
        @include('admin.section.ckeditor')
        <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/touch.js') }}"></script>
        <script>
            $('#lfm').filemanager('image');
        </script>
        @include('admin.section.ckeditor')

    @endpush
@section('content')

    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }} List</h3>
                    <div class="card-tools">
                        <a href="{{ route('touch.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">

                        {{ Form::open(['url' => route('touch.store'), 'files' => true, 'class' => 'form', 'name' => 'touch_form']) }}

                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 ">
                            <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                                {{ Form::label('name', 'Name:*', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::text('name', @$touch_info->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Name', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('name')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                                {{ Form::label('email', 'Email:*', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::text('email', @$touch_info->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter Email', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('email')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('message') ? 'has-error' : '' }}">
                                {{ Form::label('message', 'Enter Message :*', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::textarea('message', @$touch_info->message, ['class' => 'form-control ckeditor', 'id' => 'message', 'placeholder' => 'Enter message', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('message')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12  ">

                            <div class="form-group row">
                                {{ Form::label('', '', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
                                    {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'btn btn-danger btn-flat', 'type' => 'reset']) }}
                                </div>
                            </div>

                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection --}}
