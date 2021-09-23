@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Menu Info <a href="{{ route('menu.index') }}" class="btn btn-primary">View Menu List</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Menu Lists</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="col-sm-12">
                            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="col-sm-12">
                            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Menu Name: </label>
                                                    <input type="text" class="form-control" name="name[en]" placeholder="Feature name" value="{{ $menu->name['en'] }}" required>
                                                    <p class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Menu Name: </label>
                                                    <input type="text" class="form-control" name="name[np]" placeholder="Feature name" value="{{ $menu->name['np'] }}" required>
                                                    <p class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="menu_category">Menu Category: </label>
                                                    <select name="menu_category" class="form-control">
                                                        <option value="">--Select a category--</option>
                                                        @foreach ($menu_categories as $category)
                                                            <option value="{{ $category->slug }}"{{ $category->slug == $menu->category_slug ? 'selected' : '' }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('menu_category') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Main Child">Main or Child Menu:</label>
                                                    <select name="main_child" class="form-control main_child" id="main_child">
                                                        <option value="">--Choose as main or child--</option>
                                                        <option value="0"{{ $menu->main_child == 0 ? 'selected' :'' }}>Main Menu</option>
                                                        <option value="1"{{ $menu->main_child == 1 ? 'selected' :'' }}>Chlid Menu</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('main_child') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6" id="parent" style="display: none;">
                                                <div class="form-group">
                                                    <label for="parent id">Under Main Menu:</label>
                                                    <select name="parent_id" class="form-control">
                                                        <option value="">--Select a Parent Menu--</option>
                                                        @foreach ($parent_menus as $parent_menu)
                                                            <option value="{{ $parent_menu->id }}"{{ $menu->parent_id == $parent_menu->id ? 'selected': '' }}>{{ $parent_menu->name['en'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('parent_id') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6" id="header_footer" style="display: none;">
                                                <div class="form-group">
                                                    <label for="show in">Show In:</label>
                                                    <select name="show_in" class="form-control">
                                                        <option value="">--Select where to show--</option>
                                                        <option value="1"{{ $menu->header_footer == 1 ? 'selected' :'' }}>Header</option>
                                                        <option value="2"{{ $menu->header_footer == 2 ? 'selected' :'' }}>Footer</option>
                                                        <option value="3"{{ $menu->header_footer == 3 ? 'selected' :'' }}>Header and Footer</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('show_in') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-4">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')

<script type="text/javascript">
    window.onload = function() {
        var main_child = document.getElementById('main_child').value;
        if (main_child == 0) {
            document.getElementById("header_footer").style.display = "block";
        }else if(main_child == 1)
        {
            document.getElementById("parent").style.display = "block";
        }
    };
</script>
<script>
    $(function() {
        $('.main_child').change(function() {
            var main_child = $(this).children("option:selected").val();
            if (main_child == 1)
            {
                document.getElementById("parent").style.display = "block";
                document.getElementById("header_footer").style.display = "none";
            }
            else if(main_child == 0)
            {
                document.getElementById("parent").style.display = "none";
                document.getElementById("header_footer").style.display = "block";
            }
        })
    });
</script>
@endpush
