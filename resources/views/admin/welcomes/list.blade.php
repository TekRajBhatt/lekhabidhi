@extends('layouts.admin')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">subscribe subscribe List</h3>
                    <div class="card-tools">
                        <a href="{{ route('subscribe.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="btn-group col-lg-2">
                            <a href="{{ route('subscribe.index') }}" class="btn btn-primary btn-flat btn-sm">
                                <i class="fas fa-sync-alt fa-sm"></i> Refresh
                            </a>
                        </div>
                        <div class="col-lg-6">
                        </div>

                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body card-format">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Email</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscribes as $key => $subscribe)
                            <tr>
                              <td>{{ $key+1 }}.</td>
                              <td>{{ $subscribe->email }}</td>
                              <td>
                                {{Form::open(['method' => 'DELETE','route' => ['subscribe.destroy', $subscribe->id],'style'=>'display:inline','onsubmit'=>'return confirm("Are you sure you want to delete this subscriber?")']) }}
                                {{Form::button('<i class="fas fa-trash-alt"></i>',['class'=>'btn btn-danger btn-sm btn-flat','type'=>'submit','title'=>'Delete subscriber'])}}
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

@endpush


