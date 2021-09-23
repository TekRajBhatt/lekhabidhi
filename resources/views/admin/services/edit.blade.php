@extends('layouts.admin')
    @push('scripts')
        <script type="text/javascript">
            $('#summernote').summernote({
                height: 400
            });
        </script>
    @endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">service Page</h3>
                    <div class="card-tools">
                        <a href="{{ route('service.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body">

                    <h3>Update services Content</h3>

                    <form action="{{ route('service.update', $service->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $service->title }}" class="form-control"/>
                            <p class="text-danger">
                                {{$errors->first('title')}}
                            </p>
                        </div>
                        <div class="form-group">
                            <label><strong>Description :</strong></label>
                            <textarea class="summernote form-control" name="description" id="summernote" value="{{ $service->description }}"></textarea>
                            <p class="text-danger">
                                {{$errors->first('description')}}
                            </p>

                        </div>

                        <button type=”submit” class="btn btn-danger btn-block">Save</button>
                    </form>


                </div>
            </div>
        </div>
    </section>
@endsection

