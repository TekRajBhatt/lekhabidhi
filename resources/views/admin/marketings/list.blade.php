@extends('layouts.admin')
@section('title', 'Services')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">nav Service List</h3>
                    <div class="card-tools">
                        <a href="{{ route('nav.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="btn-group col-lg-1">
                            <a href="{{ route('nav.index') }}" class="btn btn-primary btn-flat btn-sm">
                                <i class="fas fa-sync-alt fa-sm"></i> Refresh
                            </a>
                        </div>
                        <div class="col-lg-7">
                            <form action="{{route('nav.index')}}" class="" method="get">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' =>
                                        'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <button class="btn btn-sm btn-primary btn-flat"><i class="fa fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-tools float-right">
                                @can('nav-create')
                                <a href="{{ route('nav.create') }}" class="btn btn-success btn-sm btn-flat mr-2">
                                    <i class="fa fa-plus"></i> Add New nav Service</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body card-format">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Title</th>
                                <th>Position Number</th>
                                <th>Image </th>
                                <th>View Count </th>
                                <th>Display Home </th>
                                <th>Status</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$value)
                            <tr>
                              <td>{{$key+1}}.</td>
                              <td>{!! $value->title !!}</td>
                              <td>
                                @if(@$value->position==null)
                                <span class="badge badge-warning">0</span>
                                @else
                                <span class="badge badge-warning">{{@$value->position}}</span>

                                @endif
                            </td>

                              <td>
                                <img src="{{ @$value->image }}" alt="{{ @$value->title}}" class="img img-thumbail" style="width:60px">
                            </td>
                            <td>{{@$value->view_count}}</td>

                              <td>
                                <label class="toggel_switch">
                                    <input class="display_home" data-id="{{@$value->id}}" type="checkbox" @if($value->display_home == '1') checked @endif >
                                    <span class="slider round"></span>
                                  </label>
                              </td>
                              <td>
                                <label class="toggel_switch">
                                    <input class="publish_status" data-id="{{@$value->id}}" type="checkbox" @if($value->publish_status == '1') checked @endif >
                                    <span class="slider round"></span>
                                  </label>
                              </td>

                              <td>
                                <div class="btn-group">
                                  @can('nav-edit')
                                  <a href="{{route('nav.edit',$value->id)}}" title="Edit nav" class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></a>
                                  @endcan
                                  @can('nav-delete')
                                  {{Form::open(['method' => 'DELETE','route' => ['nav.destroy', $value->id],'style'=>'display:inline','onsubmit'=>'return confirm("Are you sure you want to delete this nav?")']) }}
                                  {{Form::button('<i class="fas fa-trash-alt"></i>',['class'=>'btn btn-danger btn-sm btn-flat','type'=>'submit','title'=>'Delete nav '])}}
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
                                  Showing <strong>{{ $data->firstItem() }}</strong>  to <strong>{{ $data->lastItem() }} </strong>  of <strong> {{$data->total()}}</strong> entries
                                  <span> | Takes <b>{{ round((microtime(true) - LARAVEL_START),2) }}</b> seconds to render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{$data->links()}}</span>
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
          var id = $(this).data('id');
          var data = {
                        _token: "{{ csrf_token() }}",
                        status: status,
                        id: id,
                    };
          $.ajax({
              type: "POST",
              url: "{{route('service.changeStatus')}}",
              data: data,
              success: function(data){
                console.log(data.success)
              }
          });
      })
      $('.display_home').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0;
          var id = $(this).data('id');
          var data = {
                        _token: "{{ csrf_token() }}",
                        status: status,
                        id: id,
                    };
          $.ajax({
              type: "POST",
              url: "{{route('service.changedisplayhome')}}",
              data: data,
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script>
@endpush
