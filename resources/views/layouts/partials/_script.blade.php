<!-- Bootstrap core JavaScript
   ================================================== -->
<!------------------ Placed at the end of the document so the pages load faster ------------->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
<!------------------------------- Icons ------------------------------------------------------>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

<!--------------------------------- AdminLTE Theme JS Link ----------------------------------->
<script src="{{ asset('js/adminlte.min.js')}}"></script>

<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>

<!--- Script for the menut to minimise down to a smaller size of just icons on sidebar if user wants to do so --->
<script type="text/javascript">
    $(document).ready(function () {
        $('.sidebar-menu').tree();
        feather.replace();
    });

    $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('ckeditor');
  })
</script>

@stack('script')