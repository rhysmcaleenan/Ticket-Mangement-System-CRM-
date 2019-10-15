@if(session()->has('success'))
    <!---- this is the styling of success alert if something completes properly/ 
    this is included on the page where needed and with a custom success message -----> 
    <div class="alert alert-success alert-dismissible" role="alert">
        <!-- the custom success message -->
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

 <!---- this is the styling of error alert if something fails/ 
    this is included on the page where needed and with a custom error message -----> 
@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <!-- the custom error message -->
        {{	session ('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
