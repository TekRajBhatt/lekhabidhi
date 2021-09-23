@extends('backend.layouts.app')
@push('styles')
    <style>
        ol {
            list-style-type: none;
        }

        .menu-handle {
            display: block;
            margin-bottom: 5px;
            padding: 6px 4px 6px 12px;
            color: #333;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            cursor: move;
        }

        .menu-handle:hover {
            background: #fff;
        }

        .placeholder {
            margin-bottom: 10px;
            background: #D7F8FD
        }

    </style>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Menu List <a href="{{ route('menu.create') }}" class="btn btn-primary">Add New Menu</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Menu List</li>
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
                                <div class="card-header">
                                    <h2 class="card-title">Manage Menu</h2>
                                    <div class="card-tools">
                                        <a href="{{ route('menu.index') }}" type="button" class="btn btn-tool"></a>
                                    </div>
                                </div>
                                <div class="card-body card-format">
                                    @if ($menu_items->count() > 0)
                                        <ol class="sortable">
                                            @foreach ($menu_items as $item)
                                                @if ($item->parent_id == null)
                                                    <li id="menuItem_{{ $item->id }}">
                                                        <div class="menu-handle d-flex justify-content-between">
                                                            <span>
                                                                {{ $item->name['en'] }}
                                                            </span>
                                                            @php
                                                                $child_menus = \App\Models\Menu::orderBy('position', 'asc')->where('parent_id', $item->id)->get();
                                                            @endphp

                                                            <div class="menu-options btn-group">
                                                                <a href="{{ route('menu.edit', $item->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $item->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                <!-- Modal -->
                                                                    <div class="modal fade text-left" id="deletionservice{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                                </div>
                                                                                <div class="modal-body text-center">
                                                                                    <form action="{{ route('menu.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                                                                        @csrf
                                                                                        @method("POST")
                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    ";
                                                                    </div>
                                                            </div>
                                                        </div>

                                                        <ol class="sortable">
                                                            @foreach ($child_menus as $menu)
                                                                    <li id="menuItem_{{ $menu->id }}">
                                                                        <div class="menu-handle d-flex justify-content-between">
                                                                            <span>
                                                                                {{ $menu->name['en'] }}
                                                                            </span>

                                                                            <div class="menu-options btn-group">
                                                                                <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $menu->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                                <!-- Modal -->
                                                                                    <div class="modal fade text-left" id="deletionservice{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                                </div>
                                                                                                <div class="modal-body text-center">
                                                                                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline-block;">
                                                                                                        @csrf
                                                                                                        @method("POST")
                                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    ";
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                            @endforeach
                                                        </ol>
                                                        {{-- {{ get_nested_menu($item->id) }} --}}
                                                        {{-- @include('admin.menu.nested',['data'=>$item->child_menu]) --}}
                                                    </li>
                                                @endif
                                            @endforeach
                                            <div class="form-group mt-4">
                                                <button type="button" class="btn btn-success btn-sm btn-flat" id="serialize"><i
                                                        class="fa fa-save"></i>
                                                    Update Menu
                                                </button>
                                            </div>
                                        </ol>
                                    @else
                                        <p class="text-center">Menu Not Found in Database</p>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="card">
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Menu Name</th>
                                                <th>Main / Child Menu</th>
                                                <th>Menu Category</th>
                                                <th>Parent Menu</th>
                                                <th>Show In</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (count($menu_items) == 0)
                                                <tr>
                                                    <td colspan="6">
                                                        <p class="text-center">
                                                            No any records.
                                                        </p>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($menu_items as $menu_item)
                                                    <tr>
                                                        <td>
                                                            {{ $menu_item->name }}
                                                        </td>

                                                        <td>
                                                            @if ($menu_item->main_child == 0)
                                                                Main Menu
                                                            @else
                                                                Child Menu
                                                            @endif
                                                        </td>

                                                        <td>
                                                            {{ $menu_item->category->name }}
                                                        </td>

                                                        <td>
                                                            @if ($menu_item->parent_id == null)
                                                                -
                                                            @else
                                                                @php
                                                                    $parent_menu = \App\Models\Menu::where('id', $menu_item->parent_id)->first();
                                                                @endphp
                                                                {{ $parent_menu->name }}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($menu_item->header_footer == 1)
                                                                Header
                                                            @elseif($menu_item->header_footer == 2)
                                                                Footer
                                                            @elseif($menu_item->header_footer == 3)
                                                                Header and Footer
                                                            @else
                                                                -
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('menu.edit', $menu_item->id) }}" class="btn btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletionservice{{ $menu_item->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                            <!-- Modal -->
                                                                <div class="modal fade text-left" id="deletionservice{{ $menu_item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <form action="{{ route('menu.destroy', $menu_item->id) }}" method="POST" style="display:inline-block;">
                                                                                    @csrf
                                                                                    @method("POST")
                                                                                    <label for="reason">Are you sure you want to delete??</label><br>
                                                                                    <input type="hidden" name="_method" value="DELETE" />
                                                                                    <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                ";
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="text-sm">
                                                    Showing <strong>{{ $menu_items->firstItem() }}</strong> to
                                                    <strong>{{ $menu_items->lastItem() }} </strong> of <strong>
                                                        {{ $menu_items->total() }}</strong>
                                                    entries
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="pagination-sm m-0 float-right">{{ $menu_items->links() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection
@push('scripts')
    <script src="{{ asset('backend/plugins/sortablejs/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/sortablejs/jquery.mjs.nestedSortable.js') }}"></script>
    <script src="{{ asset('backend/plugins/toastrjs/toastr.min.js') }}"></script>
    <script>

        $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            placeholder: 'placeholder',
            handle: 'div.menu-handle',
            helper: 'clone',
            items: 'li',
            opacity: .6,
            maxLevels: 1,
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
        });

        $("#serialize").click(function(e) {
            e.preventDefault();
            $(this).prop("disabled", true);
            $(this).html(
                    `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...`
                );
            var serialized = $('ol.sortable').nestedSortable('serialize');
            // console.log(serialized);
            $.ajax({
                url: "{{ route('updateMenuOrder') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    sort: serialized
                },
                success: function(res) {
                    toastr.options.closeButton = true
                    toastr.success('Menu Order Successfuly', "Success !");
                    $('#serialize').prop("disabled", false);
                    $('#serialize').html(`<i class="fa fa-save"></i> Update Menu`);
                }
            });
        });

        function show_alert() {
            if (!confirm("Do you really want to do this?")) {
                return false;
            }
            this.form.submit();
        }
    </script>
@endpush
