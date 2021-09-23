@extends('layouts.admin')
@section('title', 'testimonials')

@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">testimonials List</h3>
                    <div class="card-tools">
                        <a href="{{ route('testimonial.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="btn-group col-lg-1">
                            <a href="{{ route('testimonial.index') }}" class="btn btn-primary btn-flat btn-sm">
                                <i class="fas fa-sync-alt fa-sm"></i> Refresh
                            </a>
                        </div>
                        <div class="col-lg-7">
                            <form action="{{route('testimonial.index')}}" method="get">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::select('status', ['1'=> 'Published', '0'=>'Unpublished'], @request()->status, ['class' => 'form-control form-control-sm', 'placeholder' => 'Select Publish Status']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <button class="btn btn-sm btn-primary btn-flat"><i class="fa fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-tools float-right">
                                @can('testimonial-create')
                                    <a href="{{ route('testimonial.create') }}" class="btn btn-success btn-sm btn-flat mr-2">
                                        <i class="fa fa-plus"></i> New testimonial</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body card-format">
                    <table class="table table-striped table-hover"> {{-- table-bordered --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Job Title</th>
                                <th>First Description</th>
                                <th>Second Description</th>
                                <th>Status</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ @$value->name }}</td>
                                    <td>{{ @$value->designation }}</td>
                                    <td>{{ @$value->first_description }}</td>
                                    <td>{{ @$value->second_description }}</td>

                                    <td>
                                        <label class="toggel_switch">
                                            <input class="publish_status" data-id="{{@$value->id}}" type="checkbox" @if($value->publish_status == '1') checked @endif >
                                            <span class="slider round"></span>
                                          </label>
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            @can('testimonial-edit')
                                                <a href="{{ route('testimonial.edit', $value->id) }}" title="Edit testimonial"
                                                    class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('testimonial-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['testimonial.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this testimonial?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete testimonial ']) }}
                                                {{ Form::close() }}
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-sm">
                                    Showing <strong>{{ $data->firstItem() }}</strong> to
                                    <strong>{{ $data->lastItem() }} </strong> of <strong> {{ $data->total() }}</strong>
                                    entries
                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{ $data->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script>
    $(function() {
      $('.publish_status').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0;
          var testimonial_id = $(this).data('id');
          var data = {
                        _token: "{{ csrf_token() }}",
                        status: status,
                        testimonial_id: testimonial_id,
                    };
          $.ajax({
              type: "POST",
              url: "{{route('testimonial.changeStatus')}}",
              data: data,
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
      $('.display_home').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0;
          var id = $(this).data('id');
          var data = {
                        _token: "{{ csrf_token() }}",
                        status: status,
                        id: id,
                    };
                    // console.log(data);
          $.ajax({
              type: "POST",
              url: "{{route('testimonial.changedisplayhome')}}",
              data: data,
              success: function(data){
                // console.log(data.success)
              }
          });

    })
  </script>
@endpush
