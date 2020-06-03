@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/">Home</a></li>
                    <li class="breadcrumb-item "><a href="#">Admin User</a></li>
                    <li class="breadcrumb-item active">Admintrator</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width:5%">#</th>
                    <th style="width:10%">Tên Đăng Nhập</th>
                    <th style="width:15%">Địa Chỉ Email</th>
                    <th style="width:15%">Họ Tên</th>
                    <th style="width:10%">Password</th>
                    <th style="width:25%">Image</th>
                    <th style="width:10%">Activated</th>
                    <th style="width:5%" class="noSort">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($list_use) > 0)
                    @foreach($list_use as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->login}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->first_name}} {{$value->last_name}}</td>
                            <td>**********</td>
                            <td>{{$value->image_url}}</td>
                            <td>{{$value->activated}}</td>
                            <td class="text-center">
                                @if($user_id_sign_in == 1 || $user_id_sign_in == 6)
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Action</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="{{route('admin_list_update_user',['id'=> $value->id])}}" data-remote="false"
                                           data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>
                                        <a href="" data-remote="false" data-toggle="modal" data-target="#modal-pool-action-member" class="btn dropdown-item">
                                            <i class="fas fa-users"> Delete</i>
                                        </a>
                                    </div>

                                </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="8" style="text-align: center">
                        <h3>Empty Pool Action</h3>
                    </td>
                @endif

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    {{-- modal --}}
    <div class="modal fade" id="modal-admin-action-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Action</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('admin_list_update_post_user')}}" method="post">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>

        $("#modal-admin-action-update").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-member-project").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-content").load(link.attr("href"));
        });

    </script>
@stop
