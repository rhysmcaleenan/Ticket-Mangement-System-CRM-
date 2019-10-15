@extends('layouts.main')

@section('content')

<section class="content-header">
    <h1>
        Knowledge Base
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>Control Panel</li>
        <li class="active">Knowledge Base</li>
        <a class="btn btn-danger" style="margin-left: 5px; " href="{{ route('dashboard.index') }}">Back</a>
    </ol>
</section>




<!--<div class="content-header">
            <div class="col-sm-12 mx-auto" style="margin-bottom: 15px;">
                <h2 align="middle">Knowledgebase Search</h2>

                <p align="middle">
                    Welcome to the knowledgebase. You can use the search bar below to find help, or browse the categories.
                </p>

                <div class="input-group ">
                    <input type="text" class="form-control">

                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>-->



<section style="margin-top:30px;">
    <!-- Default box -->

    <div class="col-sm-4">
        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Categories</h3>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                @forelse($categories as $category)
                <a href="{{ route('categories.edit', $category->id) }}">
                    <p class="badge"
                        style="text-align: left; width: 100%; padding: 0.8rem; border-radius: 5px; font-size:1em; font-weight: 500; margin-bottom: 5px; background-color: {{ $category->color }}">
                        {{ $category->title }}

                        <span class="pull-right">{{ $category->articles()->count() }}</span>
                    </p>
                </a>
                @empty
                <p>No Category exist</p>
                @endforelse
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Create Category</h3>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->

            <div class="box-body" style="">
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

                {!! Form::open(array('route' => 'categories.store', 'method'=>'POST')) !!}

                <div class="form-group">
                    {!! Form::color('color', null, array('class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                    {!! Form::text('title', null, array('placeholder' => 'Category title','class' => 'form-control'))
                    !!}
                </div>

                <button type="submit" class="btn btn-success pull-right">Submit</button>

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>


    <div class="col-sm-8">
        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Recently Added Articles</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal"
                        data-target="#modal-default">
                        Add New Article
                    </button>
                </div>
            </div>


            <!-- /.box-header -->

            <div class="box-body">
                @forelse($articles as $article)
                <div style="padding-bottom:55px; border-bottom: #ccc solid 1px">
                    <span class="col-lg-1 col-md-2 col-sm-3 pull-right">
                        <img src="{{ asset('public/storage/'. $article->file ) }}" alt="" class="img-responsive"
                            style="height:42px;width:64px;max-width:unset;min-width:100%;">
                    </span>

                    <span class="col-lg-11 col-md-10 col-sm-5" style="padding-left:42px;">
                        <div><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></div>

                        <div style="color: #ccc;font-size:13px;">{{ $article->issue }}</div>
                    </span>

                    {{--                                <span class="col-lg-1 col-md-2 col-sm-2 text-center">--}}
                    {{--                                    Created By: {{ $article->user->name }}--}}

                    {{--                                </span>--}}
                </div>
                @empty
                <p class="text-center">No articles currently exist</p>
                @endforelse
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    </div>
    </main>

    <div class="modal fade in" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(array('route' => 'articles.store', 'method' => 'POST', 'files' => true)) !!}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>

                    <h4 class="modal-title">Create Article</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Select Category</label>

                        {!! Form::select('category_id', $cats, [], array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        <label for="">Article Title</label>

                        {!! Form::text('title', null, array('placeholder' => 'Category title','class' =>
                        'form-control')) !!}
                    </div>

                    <div class="form-group">
                        <label for="">Issue Description</label>

                        {!! Form::textarea('issue', null, array('placeholder' => 'Issue Description','class' =>
                        'form-control')) !!}
                    </div>

                    <div class="form-group">
                        <label for="">Solution Description</label>

                        {!! Form::textarea('solution', null, array('placeholder' => 'Solution Description','class' =>
                        'form-control')) !!}
                    </div>

                    <div class="form-group">
                        <label for="">Image/File Upload</label>

                        {!! Form::file('file', null, array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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