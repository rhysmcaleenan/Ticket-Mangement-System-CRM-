@extends('layouts.main')

@section('content')
         <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $client-> client }} Profile
                <small> Clients</small>
            </h1>
            <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Control Panel</li>
            <li class="active">Clients</li>
            <li class="active">{{ $client-> client }}  </li>
            <a class="btn btn-danger" style="margin-left: 5px; " href="{{ route('clients.index') }}">Back</a>
            </ol>
        </section>


        <section class="content" style="margin-top:10px;">
            <!-- Default box -->
            <div class="box">
                <div class="box-body">
                    <div class="col-md-7">
                        <div class="box box-danger box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Client Details</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                        <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="w-75 p-3">
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

                                    <form action="" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md-7">
                                                <label for='client'>Client Name <span style="color: red;">*</span></label>
                                                <input type="text" class="form-control {{ $errors->has('client') ? 'is-invalid' : ''}}"
                                                       id='client' name='client' placeholder="Client name"
                                                       value=" {{old('client', $client->client)}}"/>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="supporttype">Support Type <span style="color: red;">*</span></label>
                                                <select class="form-control" id="supporttype" name="supporttype" placeholder="supporttype">
                                                    <option value="Priority">Priority</option>
                                                    <option value="Essential">Essential</option>
                                                    <option value="None">None</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-7">
                                                <label for='email'>Email Address <span style="color: red;">*</span></label>
                                                <input type="text" id='email' name='email'
                                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}"
                                                       placeholder="Email Addresss" value=" {{old('email', $client->email)}}">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for='telephone'>Telephone <span style="color: red;">*</span></label>
                                                <input type="text" id='telephone' name='telephone'
                                                       class="form-control {{ $errors->has('telephone') ? 'is-invalid' : ''}}"
                                                       placeholder="Telephone here" value=" {{old('telephone', $client->telephone)}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for='address'>Address <span style="color: red;">*</span></label>
                                                <input type="text" id='address' name='address'
                                                       class="form-control {{ $errors->has('address') ? 'is-invalid' : ''}}"
                                                       placeholder="Addresss here" value=" {{old('address', $client->address)}}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for='city'>City/Town <span style="color: red;">*</span></label>
                                                <input type="text" id='city' name='city'
                                                       class="form-control {{ $errors->has('city') ? 'is-invalid' : ''}}"
                                                       placeholder="City or town here" value=" {{old('city', $client->city)}}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for='postcode'>Postcode <span style="color: red;">*</span></label>
                                                <input type="text" id='postcode' name='postcode'
                                                       class="form-control {{ $errors->has('postcode') ? 'is-invalid' : ''}}"
                                                       placeholder="Postcode here" value=" {{old('postcode', $client->postcode)}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <h5 class="h4">Business Audit</h5>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for='servers'>Servers <span style="color: red;">*</span></label>
                                                <input type="text" id='servers' name='servers'
                                                       class="form-control {{ $errors->has('servers') ? 'is-invalid' : ''}}"
                                                       placeholder="No. of servers" value=" {{old('servers', $client->servers)}}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for='workstations'>Workstations <span style="color: red;">*</span></label>
                                                <input type="text" id='workstations' name='workstations'
                                                       class="form-control {{ $errors->has('workstations') ? 'is-invalid' : ''}}"
                                                       placeholder="No. of workstations here"
                                                       value=" {{old('workstations', $client->workstations)}}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for='printers'>Printers <span style="color: red;">*</span></label>
                                                <input type="text" id='printers' name='printers'
                                                       class="form-control {{ $errors->has('printers') ? 'is-invalid' : ''}}"
                                                       placeholder="No. of printers here" value=" {{old('printers', $client->printers)}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="notes">Notes</label>
                                                <textarea type="text" id="notes" name="notes"
                                                       class="form-control {{ $errors->has('notes') ? 'is-invalid' : ''}}" rows="5"
                                                       placeholder="Add notes on clients issue..." value=" {{old('notes', $client->notes)}}">{{old('notes', $client->notes)}}</textarea>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>  
                                   </form>     
                                </div> 
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                   

        <div class="col-md-5">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Related Support Tickets</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="mt-5 mb-5">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Delete</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($client->tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td><a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                    <td><a href="{{ route('tickets.delete', $ticket->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>

    

</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection
