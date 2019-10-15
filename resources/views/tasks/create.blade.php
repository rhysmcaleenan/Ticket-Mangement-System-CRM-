@extends('layouts.main')

@push('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
@endpush

@push('script')
    <!-- bootstrap datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function () {
            //Date picker
            $('#due_date').datepicker({
                autoclose: true
            })
        });
    </script>
@endpush

@section('content')

        <section class="content-header">
            <h1>
                Add New Task  
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i>Control Panel</li>
                <li class="active">To Do List</li>
                <li class="active">Add New Task</li>
                <a class="btn btn-danger" style="margin-left: 5px; " href="{{ route('dashboard.index') }}">Back</a>
            </ol>
        </section>

         <section class="content" style="margin-top:10px;">
            <!-- Default box -->
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('tasks.store') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for='task'>Task <span style="color: red;">*</span></label>

                                <input type="text" class="form-control {{ $errors->has('task') ? 'is-invalid' : ''}}" id='task' name='task' placeholder="Task" required/>

                                @if($errors->has('task'))
                                    <div class="invalid-feedback">{{ $errors->first('task')  }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for='assigned'>Assigned <span style="color: red;">*</span></label>

                                <input type="text" class="form-control {{ $errors->has('assigned') ? 'is-invalid' : ''}}" id='assigned' name='assigned' placeholder="Assigned" required/>

                                @if($errors->has('assigned'))
                                    <div class="invalid-feedback">{{ $errors->first('assigned')  }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for='due_date'>Due date <span style="color: red;">*</span></label>

                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>

                                    <input type="text" id='due_date' name='due_date' class="form-control pull-right {{ $errors->has('due_date') ? 'is-invalid' : ''}}" placeholder="Due date" required/>
                                </div>

                                @if($errors->has('due_date'))
                                    <div class="invalid-feedback">{{ $errors->first('due_date')  }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="status">Status <span style="color: red;">*</span></label>

                                <select class="form-control" id="status" name="status" required>
                                    <option value="Open">Open</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Complete">Stuck</option>
                                </select>

                                @if($errors->has('status'))
                                    <div class="invalid-feedback">{{ $errors->first('status')  }}</div>
                                @endif
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
