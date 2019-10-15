<!doctype html>
<html lang="en">
<!---- including the css links etc at top of each page through blade system ------> 
@include ('layouts.partials._header')

<body class="hold-transition skin-red sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	<!------ including the header nav html from partials folder to constuct the page ------>
    @include ('layouts.partials._navigation')

	<!----- including the sidebar on all pages from partials folder via laravel blade system ------> 
    @include ('layouts.partials._sidebar')

    <div class="content-wrapper">

        <!-- Main content - any info on each individual blade for example : tickets blade it will be output within these tags by using the yield function -->
        <section class="content">
            
                    @yield('content')
               
        </section>
    </div>
</div>

<!--- using laravels blade system to include the scripts file at the end of every page on the project ---->
@include ('layouts.partials._script')
</body>
</html>
