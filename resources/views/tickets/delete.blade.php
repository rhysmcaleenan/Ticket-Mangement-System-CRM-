@extends('layouts.main')

@section('content')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Delete Ticket - {{ $ticket->client['client'] }} ?
                <small>Tickets</small>
            </h1>
            <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Control Panel</li>
            <li class="active">Tickets</li>
            <li class="active">Delete</li>
            <a class="btn btn-danger" style="margin-left: 5px; " href="{{ route('tickets.index') }}">Back</a>
            </ol>
        </section>

        <section class="content" style="margin-top:10px;">
            <!-- Default box -->
            <div class="box">
                <div class="box-body">

                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="client">Client</label>
                                <input type="text" id="client" name="client" class="form-control" placeholder="Client name" value=" {{ $ticket->client['client'] }}"
                                       disabled/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <input type="text" id="status" name="status" class="form-control" placeholder="Status" value="{{ $ticket->status }}" disabled/>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Add title of issue..." value="{{ $ticket->title }}"
                                       disabled/>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <input type="text" id="description" name="description" class="form-control"
                                       placeholder="Add full description on clients issue..." value="{{ $ticket->description }}" disabled/>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="solution">Solution</label>
                                <input type="text" id="solution" name="solution" class="form-control"
                                       placeholder="Add full solution on clients issue..." value="{{ $ticket->solution }}" disabled/>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success">Confirm Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
  
@endsection
