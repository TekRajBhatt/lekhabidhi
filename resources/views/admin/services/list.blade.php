@extends('layouts.admin')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">service Service List</h3>
                    <div class="card-tools">
                        <a href="{{ route('service.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="btn-group col-lg-2">
                            <a href="{{ route('service.index') }}" class="btn btn-primary btn-flat btn-sm">
                                <i class="fas fa-sync-alt fa-sm"></i> Refresh
                            </a>
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-4">
                            <div class="card-tools float-right">
                                <a href="{{ route('service.create') }}" class="btn btn-success btn-sm btn-flat mr-2">
                                    <i class="fa fa-plus"></i> Add New service Content</a>
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
                                <th>Status</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service as $key => $service)
                            <tr>
                              <td>{{ $key+1 }}.</td>
                              <td>{{ $service->title }}</td>
                              <td>
                                <label class="toggel_switch">
                                    <input class="publish_status" data-id="{{$service->id}}" type="checkbox" @if($service->publish_status == '1') checked @endif >
                                    <span class="slider round"></span>
                                </label>
                              </td>
                              <td>
                                <a href="{{route('service.edit',$service->id)}}" title="Edit services" class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></a>

                                {{Form::open(['method' => 'DELETE','route' => ['service.destroy', $service->id],'style'=>'display:inline','onsubmit'=>'return confirm("Are you sure you want to delete this services page?")']) }}
                                {{Form::button('<i class="fas fa-trash-alt"></i>',['class'=>'btn btn-danger btn-sm btn-flat','type'=>'submit','title'=>'Delete services '])}}
                                {{ Form::close() }}
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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
    })
  </script>
@endpush


