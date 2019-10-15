@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Control Panel
        <small> Dashboard</small>
    </h1>
    <!--- breadcrumbs to show user where they are on the system --->
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Control Panel</li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <a href="{{ route('clients.index') }}">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <!--- listing total number of clients which is got from dashboard controller -->
                        <h3>{{$clients}}</h3>

                        <p>Total Clients</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                        <i class="ion-md-heart"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <a href="{{ route('tickets.index') }}#tab_unresolved">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <!--- getting result from open tickets counter on dashboard controller-->
                        <h3>{{ $tickets_open }}</h3>

                        <p>Tickets Unresolved</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-close"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <a href="{{ route('tickets.index') }}#tab_in_progress">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <!--- getting result from in progress tickets counter on dashboard controller-->
                        <h3>{{ $tickets_progress }}</h3>

                        <p>Tickets In Progress</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-albums"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <a href="{{ route('tickets.index') }}#tab_complete">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <!--- getting result from completed tickets counter on dashboard controller-->
                        <h3>{{ $tickets_completed }}</h3>

                        <p>Completed Tickets</p>
                    </div>
                    <div class="icon">
                        <i class="ion  ion-checkmark-round"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Project Management - To Do List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!------ to do list table starts here ------->
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Task</th>
                                    <th>Due Date</th>
                                    <th>Assigned</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!----- loop to output each bit of information in a row thats stored in the database --->
                                @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $task->task }}</td>
                                    <!--- formatted to show only date and not time -->
                                    <td>{{ $task->due_date->format('d/m/y') }}</td>
                                    <td>{{ $task->assigned }}</td>
                                    <!-- styling for what to colour to display if status is different (changes colour code) -->
                                    <?php
                                            $style = 'color: #fff;background-color: #';
                                            if ($task->status === 'Complete') {
                                                $style .= '00a65a';
                                            } elseif ($task->status === 'In Progress') {
                                                $style .= 'f39c12';
                                            } elseif ($task->status === 'Stuck') {
                                                $style .= 'dd4b39';
                                            } else {
                                                $style .= 'ccc';
                                            }
                                            $style .= ';';
                                            ?>
                                    <!----- end of styling --->
                                    <td class="text-center" style="{{ $style }}">{{ $task->status }}</td>
                                    <!---- edit and delete action button routes -->
                                    <td>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm"><i
                                                class="fa fa-pencil"></i></a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['tasks.destroy',
                                        $task->id],'style'=>'display:inline']) !!}
                                        {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger'] )  }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                                <!---- end of loop for each row --->
                            </tbody>
                        </table>

                        <div>
                            <!---- pagination for the tasks on to do list ---->
                            <span class="pull-left">{{ $tasks->links() }}</span>
                            <!---- route to the form to create a new task ---->
                            <span class="pull-right"><a href="{{ route('tasks.create') }}" class="btn btn-success">Add
                                    Task</a></span>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
@endsection