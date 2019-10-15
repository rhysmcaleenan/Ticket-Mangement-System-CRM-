@extends('layouts.main')

@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Profile
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Control Panel</li>
            <li class="active">User</li>
            <li class="active">{{ $user->name }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @if ($message = Session::get('success'))
                @include('layouts.partials._alerts')
            @endif
        </div>

        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-danger">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" style="max-height: 100px; " src="{{ $user->avatar() }}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <p class="text-muted text-center">{{ $user->job }}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                            </li>
                            <!--
                            <li class="list-group-item">
                                <b>Completed Tickets</b> <a class="pull-right">0</a>
                            </li>
                        -->
                            <li class="list-group-item">
                                <b>Articles Added</b> <a class="pull-right">{{ $user->articles->count() }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nav-danger">
                        <li class="active"><a href="#notes" data-toggle="tab">Notes</a></li>
                        @if($user->id == auth()->id())
                        <li><a href="#settings" data-toggle="tab">Settings</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="notes">
                            <div class="row">
                                {!! Form::open(array('route' => ['notes.store', 'id' => $user->id],'method'=>'POST')) !!}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Note:</strong>
                                        {!! Form::text('message', null, array('placeholder' => 'Note', 'class' => 'form-control')) !!}
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>

                            <div class="row" style="margin: 0 2vw 0 2vw;">
                                <!-- The timeline -->
                                <ul class="timeline timeline-inverse">
                                    @foreach($user->notes as $note)
                                        <!-- timeline time label -->
                                        <li class="time-label"><span class="bg-red">{{ $note->created_at->format('l j F') }} at {{ $note->created_at->format('h:i A') }}</span></li>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-sticky-note-o bg-gray"></i>
                                            <div class="timeline-item">
                                                @if($user->id == auth()->id())
                                                    <span class="pull-right">
                                                        {{--<a href="{{ route('notes.destroy', $note->id) }}" onclick="">--}}

                                                        {!! Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirm(\'Are you sure you want to delete this note?\')',
                                                        'route' => ['notes.destroy', $note->id], 'style'=>'display:inline']) !!}
                                                        {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                                                        {!! Form::close() !!}
                                                    </span>
                                                @endif

                                                <h3 class="timeline-header"><a href="{{ route('users.profile.show', $note->user->id) }}">{{ $note->user->name
                                                }}</a></h3>

                                                <div class="timeline-body">
                                                    {{ $note->message }}
                                                </div>
                                            </div>
                                        </li>
                                    <!-- END timeline item -->
                                    @endforeach

                                    <li>
                                        <i class="fa fa-clock-o bg-gray"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        @if($user->id == auth()->id())
                        <div class="tab-pane" id="settings" style="margin: 0 1.5vw 0 1.5vw;">
                            {!! Form::model($user, ['class' => 'form-horizontal', 'method' => 'PATCH', 'route' => ['users.profile.update', $user->id],
                            'files' => true]) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Job Role:</strong>
                                        {!! Form::text('job', null, array('placeholder' => 'Job Role', 'class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Image:</strong>
                                        {!! Form::file('file', array('class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Password:</strong>
                                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Confirm Password:</strong>
                                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.tab-pane -->
                        @endif
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection