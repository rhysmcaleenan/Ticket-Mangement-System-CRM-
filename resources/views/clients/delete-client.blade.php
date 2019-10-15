@extends('layouts.main')

@section('content')

   <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Delete Client - {{ $client-> client }} ?
                <small> Clients</small>
            </h1>
            <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Control Panel</li>
            <li class="active">Clients</li>
            <li class="active">{{ $client-> client }}  </li>
            <a class="btn btn-danger" style="margin-left: 5px; " href="{{ route('clients.index') }}">Back</a>
            </ol>
        </section>


        <section class="content">

            <!-- Default box -->
            <div class="box" style="margin-top:10px;">
               <div class="box-body" style="margin-bottom:0px;">
              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i>Warning!</h4> 
                You will delete all related tickets for the client too. Do you want to proceed?
              </div>
            </div>
                <div class="box-body">
                  <form action="" method="post">
                  {{ csrf_field() }}
                   <div class="form-row">
                      <div class="form-group col-md-7">
                          <label for='client'>Client Name</label>
                          <input type="text" id="client" name="client" class="form-control" placeholder="Client name" value=" {{$client->client}}" disabled />
                      </div>
                       <div class="form-group col-md-5">
                          <label for="supporttype">Support Type</label>
                          <input type="text" id="supporttype" name="supporttype" class="form-control" placeholder="Support type" value=" {{$client->supporttype}}" disabled />
                      </div>
                  </div>
                  <div class="form-row">
                       <div class="form-group col-md-7">
                          <label for='email'>Email Address</label>
                          <input type="text" id='email' name='email' class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" placeholder="Email Addresss" value=" {{$client->email}}" disabled />
                      </div>
                      <div class="form-group col-md-5">
                        <label for='telephone'>Telephone</label>
                        <input type="text" id='telephone' name='telephone' class="form-control {{ $errors->has('telephone') ? 'is-invalid' : ''}}" placeholder="Telephone here"value=" {{$client->telphone}}" disabled />
                      </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for='address'>Address</label>
                        <input type="text" id='address' name='address' class="form-control {{ $errors->has('address') ? 'is-invalid' : ''}}" placeholder="Addresss here" value=" {{$client->address}}" disabled />
                    </div>
                    <div class="form-group col-md-3">
                        <label for='city'>City/Town</label>
                        <input type="text" id='city' name='city' class="form-control {{ $errors->has('city') ? 'is-invalid' : ''}}" placeholder="City or town here" value=" {{$client->city}}" disabled />
                    </div>
                    <div class="form-group col-md-3">
                        <label for='postcode'>Postcode</label>
                        <input type="text" id='postcode' name='postcode' class="form-control {{ $errors->has('postcode') ? 'is-invalid' : ''}}" placeholder="Postcode here" value=" {{$client->postcode}}" disabled />
                    </div>
                </div>
                <div class="form-row">
          			     <div class="form-group col-md-12">
                        <h5 class="h4">Business Audit</h4>
             			  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for='servers'>Servers</label>
                        <input type="text" id='servers' name='servers' class="form-control {{ $errors->has('servers') ? 'is-invalid' : ''}}" placeholder="No. of servers" value=" {{$client->servers}}" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for='workstations'>Workstations</label>
                        <input type="text" id='workstations' name='workstations' class="form-control {{ $errors->has('workstations') ? 'is-invalid' : ''}}" placeholder="No. of workstations here" value=" {{$client->workstations}}" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for='printers'>Printers</label>
                        <input type="text" id='printers' name='printers' class="form-control {{ $errors->has('printers') ? 'is-invalid' : ''}}" placeholder="No. of printers here" value=" {{$client->printers}}" disabled />
                    </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="notes">Notes</label>
                        <input type="text" id="notes" name="notes" class="form-control" rows="5" placeholder="Add notes on clients issue..." value="{{$client->notes}}" disabled/>
                    </div>
                </div>
          			<div class="pull-right">
                      <button type="submit" class="btn btn-success">Confirm Delete</button>
                </div>
           </form>
        </div>
      </div>
  </section>

@endsection
