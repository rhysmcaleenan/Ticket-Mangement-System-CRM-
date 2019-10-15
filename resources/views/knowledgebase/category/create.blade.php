@extends('layouts.main')

@section('content')
    <main role="main" class="col-md-offset-1 col-md-10">
        <div class="">
            <h1 class="pull-left">Add New Category</h1>

            <div class="btn-toolbar pull-right">
                <a class="btn btn-danger" style="margin-top: 20px;" href="{{ route('knowledgebase.index') }}">Back</a>
            </div>
            <div class="clearfix"></div>
        </div>

        <hr>

        <div class="w-75 p-3">
            <form action="" method="post">
                {{ csrf_field() }}

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for='client'>Category Name</label>
                        <input type="text" class="form-control"
                               id='category' name='category' placeholder="Category name">
                    </div> 
						
					 <div class="float-right">
                    <button type="submit" class="btn btn-success">Add</button>
                	</div>

                </div>

               

            </form>
        </div>

        </div>

    </main>


@endsection

