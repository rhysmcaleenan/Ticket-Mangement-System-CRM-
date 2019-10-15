@extends('layouts.main')

@section('content')

<main role="main" class="col-md-offset-1 col-md-10">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="pull-left">Delete Ticket - {{ $ticket->client->client  }} </h1>
           
                  <div class="btn-toolbar pull-right" style="margin-top: 20px;">
                <div class="btn-group">
                    <a class="btn btn-danger" href="/project2/public/tickets">Back</a>
                </div>
            </div>
              

            <div class="clearfix"></div>
        </div>
        
        <hr>

         
         <div class="w-50 p-3">
         <form action="" method="post">
          {{ csrf_field() }}

         <div class="form-row">
            
            <div class="form-group col-md-6">
              <label for="client">Client</label>
              <input type="text" id="client" name="client" class="form-control" placeholder="Client name" value=" {{$ticket->client['client']}}" disabled />
            </div>

            <div class="form-group col-md-6">
              <label for="status">Status</label>
              <input type="text" id="status" name="status" class="form-control" placeholder="Status" value="{{$ticket->status}}" disabled />
            </div>
          

          <div class="form-group col-md-12">

              <label for="title">Title</label>
              <input type="text" id="title" name="title" class="form-control" placeholder="Add title of issue..." value="{{$ticket->title}}" disabled/>

          </div>

          <div class="form-group col-md-12">

              <label for="description">Description</label>
              
              <input type="text" id="description" name="description" class="form-control" rows="5" placeholder="Add full description on clients issue..." value="{{$ticket->description}}" disabled/>


          </div>
          
 
          

<div class="pull-right">
                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                </div>

                </div>
          

        </form>
        </div>




        </main>


@endsection