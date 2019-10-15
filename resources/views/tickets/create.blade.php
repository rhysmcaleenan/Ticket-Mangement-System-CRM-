@extends('layouts.main')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add New Support Ticket
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Control Panel</li>
        <li class="active">Tickets</li>
        <li class="active">Add New</li>
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
            <form action="{{ route('tickets.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for='client'>Client <span style="color: red;">*</span></label>
                        <select type="select" class="form-control" id='client' name='client_id'>
                            @foreach($clients as $client)
                            <option value="{{$client->id}}">{{ $client->client }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for='clientname'>Caller Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('callername') ? 'is-invalid' : ''}}"
                            value="{{ old('callername') }}" id='callername' name='callername' placeholder="Caller name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for='title'>Title <span style="color: red;">*</span></label>
                        <input type="text" id='title' name='title' value="{{ old('title') }}"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}"
                            placeholder="Add title of issue..." />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="--" {{ old('type') === '--' ? 'selected' : '' }}>--</option>
                            <option value="Question" {{ old('type') === 'Question' ? 'selected' : '' }}>Question
                            </option>
                            <option value="Incident" {{ old('type') === 'Incident' ? 'selected' : '' }}>Incident
                            </option>
                            <option value="Problem" {{ old('type') === 'Problem' ? 'selected' : '' }}>Problem </option>
                            <option value="Request" {{ old('type') === 'Request' ? 'selected' : '' }}>Request</option>
                            <option value="Other" {{ old('type') === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="status">Status <span style="color: red;">*</span></label>
                        <select class="form-control" id="status" name="status">
                            <option value="Open" {{ old('status') === 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="Unresolved" {{ old('status') === 'Unresolved' ? 'selected' : '' }}>Unresolved
                            </option>
                            <option value="Waiting on Customer"
                                {{ old('status') === 'Waiting on Customer' ? 'selected' : '' }}>​Waiting on Customer
                            </option>
                            <option value="In Progress" {{ old('status') === 'In Progress' ? 'selected' : '' }}>In
                                Progress</option>
                            <option value="Complete" {{ old('status') === 'Complete' ? 'selected' : '' }}>Complete
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">Description <span style="color: red;">*</span></label>
                        <textarea id='issue' name='description'
                            placeholder="Add full description on clients issue..."
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}"
                            rows="5">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="solution">Solution</label>
                        <textarea id='solution' name='solution' placeholder="Add full description on clients issue..."
                            class="form-control {{ $errors->has('solution') ? 'is-invalid' : ''}}"
                            rows="5">{{ old('solution') }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for='timelength'>Length of Time <span style="color: red;">*</span></label>
                        <select class="form-control" id="timelength" name="timelength">
                            <option value="5" {{ old('timelength') === '5' ? 'selected' : '' }}>0 - 5 minutes</option>
                            <option value="15" {{ old('timelength') === '15' ? 'selected' : '' }}>15 minutes</option>
                            <option value="30" {{ old('timelength') === '30' ? 'selected' : '' }}>30 minutes</option>
                            <option value="60" {{ old('timelength') === '60' ? 'selected' : '' }}>60 minutes</option>
                            <option value="90" {{ old('timelength') === '90' ? 'selected' : '' }}>90 minutes</option>
                            <option value="Other" {{ old('timelength') === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for='chargeable'>Chargeable <span style="color: red;">*</span></label>
                        <select class="form-control" id="chargeable" name="chargeable">
                            <option value="No" {{ old('chargeable') === 'No' ? 'selected' : '' }}>No</option>
                            <option value="Yes" {{ old('chargeable') === 'Yes' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for='createdby'>Created By</label>
                        <input type="text" id='createdby' name='createdby' value="{{ auth()->user()->name }}" readonly
                            class="form-control {{ $errors->has('createdby') ? 'is-invalid' : ''}}" />
                    </div>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-success">Add</button>
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