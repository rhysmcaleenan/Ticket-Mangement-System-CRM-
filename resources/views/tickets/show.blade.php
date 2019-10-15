@extends('layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ticket View / Update
        <small>{{ $ticket->client['client'] }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Control Panel</li>
        <li class="active">Tickets</li>
        <li class="active">View / Update</li>
        <a class="btn btn-danger" style="margin-left: 5px; " href="{{ route('tickets.index') }}">Back</a>
    </ol>
</section>

<section class="content" style="margin-top:10px;">
    <!-- Default box -->
    <div class="box">
        <div class="box-body">

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('tickets.update', $ticket->id) }}" method="post">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for='client'>Client <span style="color: red;">*</span></label>
                        <select type="select" class="form-control" id='client' name='client_id'>
                            @foreach($clients as $client)
                            <option value="{{$client->id}}"
                                {{ $ticket->client['id'] === $client->id ? 'selected' : '' }}>{{ $client->client }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for='callername'>Caller Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('callername') ? 'is-invalid' : ''}}"
                            id='callername' name='callername' placeholder="Caller name"
                            value=" {{old('callername', $ticket->callername)}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}"
                            placeholder="Add title of issue..." value=" {{old('title', $ticket->title)}}" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type" placeholder="Type">
                            <option value="--" {{$ticket->type == "--" ? "selected" : ""}}>--</option>
                            <option value="Question" {{$ticket->type == "Question" ? "selected" : ""}}>Question</option>
                            <option value="Incident" {{$ticket->type == "Incident" ? "selected" : ""}}>Incident</option>
                            <option value="Problem" {{$ticket->type == "Problem" ? "selected" : ""}}>Problem</option>
                            <option value="Request" {{$ticket->type == "Request" ? "selected" : ""}}>Request</option>
                            <option value="Other" {{$ticket->type == "Other" ? "selected" : ""}}>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="status">Status <span style="color: red;">*</span></label>
                        <select class="form-control" id="status" name="status" placeholder="Status">
                            <option value="Open" {{$ticket->status == "Open" ? "selected" : ""}}>Open</option>
                            <option value="Unresolved" {{$ticket->status == "Unresolved" ? "selected" : ""}}>Unresolved
                            </option>
                            <option value="Waiting on Customer"
                                {{$ticket->status == "Waiting on Customer" ? "selected" : ""}}>Waiting on Customer
                            </option>
                            <option value="In Progress" {{$ticket->status == "In Progress" ? "selected" : ""}}>In
                                Progress
                            </option>
                            <option value="Complete" {{$ticket->status == "Complete" ? "selected" : ""}}>Complete
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">Description <span style="color: red;">*</span></label>
                        <textarea type="text" id="issue" name="description"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}" rows="5"
                            placeholder="Add full description on clients issue..."
                            value=" {{old('description', $ticket->description)}}">{{old('description', $ticket->description)}}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="solution">Solution </label>
                        <textarea type="text" id="solution" name="solution"
                            class="form-control {{ $errors->has('solution') ? 'is-invalid' : ''}}" rows="5"
                            placeholder="Add full description on clients issue..."
                            value=" {{old('solution', $ticket->solution)}}">{{old('solution', $ticket->solution)}}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for='timelength'>Length of Time <span style="color: red;">*</span></label>
                        <select class="form-control" id="timelength" name="timelength" placeholder="timelength">
                            <option value="5" {{$ticket->timelength == "5" ? "selected" : ""}}>0 - 5 min</option>
                            <option value="15" {{$ticket->timelength == "15" ? "selected" : ""}}>15 min</option>
                            <option value="30" {{$ticket->timelength == "30" ? "selected" : ""}}>30 min</option>
                            <option value="60" {{$ticket->timelength == "60" ? "selected" : ""}}>60 min</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for='chargeable'>Chargeable <span style="color: red;">*</span></label>
                        <select class="form-control" id="chargeable" name="chargeable" placeholder="chargeable">
                            <option value="No" {{$ticket->chargeable == "No" ? "selected" : ""}}>No</option>
                            <option value="Yes" {{$ticket->chargeable == "Yes" ? "selected" : ""}}>Yes</option>

                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for='createdby'>Created By</label>
                            <input type="text" id='createdby' name='createdby'
                                class="form-control {{ $errors->has('createdby') ? 'is-invalid' : ''}}"
                                placeholder="Username" value=" {{old('createdby', $ticket->createdby)}}" />
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>

            </form>
        </div>
    </div>
</section>
@endsection

@push('script')
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>

<!--- Script for the menut to minimise down to a smaller size of just icons on sidebar if user wants to do so --->
<script type="text/javascript">
    $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('issue');
    CKEDITOR.replace('solution');
  })
</script>
@endpush