@extends('layouts.main')

@section('content')
         <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users 
            </h1>
            <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Control Panel</li>
            <li class="active">Users</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Users Management</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                </div>
            </div>
            <div class="box-body">
                @if ($message = Session::get('success'))
                    @include('layouts.partials._alerts')
                @endif

                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th width="280px">Action</th>
                    </tr>

                    @foreach ($users as $user)
                        @if($user->id != auth()->id())
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-default" href="{{ route('users.profile.show', $user->id) }}"><i class="fa fa-user"></i></a>
                                @role('admin')
                                    <a class="btn btn-xs btn-info" href="{{ route('users.show',$user->id) }}"><i class="fa fa-eye" style="color:white;"></i></a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-pencil"></i></a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endrole
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                {!! $users->render() !!}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
  
@endsection
