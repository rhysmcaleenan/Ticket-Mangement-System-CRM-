@extends('layouts.main')

@section('content')
  
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add New Support Client
                <small> Clients</small>
            </h1>
            <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Control Panel</li>
            <li class="active">Clients</li>
            <li class="active">Add New</li>
            <a class="btn btn-danger" style="margin-left: 5px; " href="{{ route('clients.index') }}">Back</a>
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

                    <form action="" method="post">
                    {{ csrf_field() }}

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for='client'>Client Name <span style="color: red;">*</span></label>
                    <input type="text" class="form-control {{ $errors->has('client') ? 'is-invalid' : ''}}" value="{{ old('client') }}"
                               id='client' name='client' placeholder="Client Name">
                </div>

                <div class="form-group col-md-6">
                    <label for="supporttype">Support Type <span style="color: red;">*</span></label>
                        <select class="form-control" id="supporttype" name="supporttype" placeholder="supporttype">
                            <option value="Priority">Priority</option>
                            <option value="Essential">Essential</option>
                            <option value="None">None</option>
                        </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for='email'>Email Address <span style="color: red;">*</span></label>
                    <input type="text" id='email' name='email'
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" value="{{ old('email') }}"
                               placeholder="Email Address"/>
                </div>

                <div class="form-group col-md-6">
                    <label for='telephone'>Telephone <span style="color: red;">*</span></label>
                    <input type="text" id='telephone' name='telephone'
                               class="form-control {{ $errors->has('telephone') ? 'is-invalid' : ''}}" value="{{ old('telephone') }}"
                               placeholder="Telephone"/>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for='address'>Address <span style="color: red;">*</span></label>
                    <input type="text" id='address' name='address'
                               class="form-control {{ $errors->has('address') ? 'is-invalid' : ''}}" value="{{ old('address') }}"
                               placeholder="Addresss"/>
                </div>

                <div class="form-group col-md-3">
                    <label for='city'>City/Town <span style="color: red;">*</span></label>
                    <input type="text" id='city' name='city'
                               class="form-control {{ $errors->has('city') ? 'is-invalid' : ''}}"
                               value="{{ old('city') }}"
                               placeholder="City/Town"/>
                </div>

                <div class="form-group col-md-3">
                    <label for='postcode'>Postcode <span style="color: red;">*</span></label>
                    <input type="text" id='postcode' name='postcode'
                               class="form-control {{ $errors->has('postcode') ? 'is-invalid' : ''}}" value="{{ old('postcode') }}"
                               placeholder="Postcode"/>
                </div>
            </div>

            <div class="form-row">
                <h4>Business Audit </h4>
                    <hr>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for='servers'>Servers <span style="color: red;">*</span></label>
                    <input type="text" id='servers' name='servers'
                               class="form-control {{ $errors->has('servers') ? 'is-invalid' : ''}}" value="{{ old('servers') }}"
                               placeholder="No. of Servers"/>
                </div>

                <div class="form-group col-md-4">
                    <label for='workstations'>Workstations <span style="color: red;">*</span></label>
                    <input type="text" id='workstations' name='workstations'
                               class="form-control {{ $errors->has('workstations') ? 'is-invalid' : ''}}" value="{{ old('workstations') }}"
                               placeholder="No. of Workstations"/>
                </div>

                <div class="form-group col-md-4">
                    <label for='printers'>Printers <span style="color: red;">*</span></label>
                    <input type="text" id='printers' name='printers'
                               class="form-control {{ $errors->has('printers') ? 'is-invalid' : ''}}" value="{{ old('printers') }}"
                               placeholder="No. of Printers"/>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="notes">Notes</label>
                    <textarea id='notes' name='notes'
                                  class="form-control {{ $errors->has('notes') ? 'is-invalid' : ''}}" rows="3"
                                  id='notes' placeholder="Add notes on clients issue..."></textarea>
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
