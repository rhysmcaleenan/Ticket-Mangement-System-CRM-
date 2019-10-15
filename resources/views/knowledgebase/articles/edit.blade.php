@extends('layouts.main')

@section('content')
<style>
    .box-body .box-title {
        font-size: 18px;
        font-weight: 500;

    }

    .box-body .box-comment {
        font-size: 14px;
        font-weight: 300;
    }

    .img-responsive {
        text-align: center;
        display: block !important;
        min-width: 100% !important;
        text-align: center;
        height: auto !important;
        margin-top: 25px !important;
        margin-bottom: 25px !important;


    }
</style>


<section class="content-header">
    <h1>
        Knowledge Base
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>Control Panel</li>
        <li class="active">Knowledge Base</li>
        <li class="active">Article View</li>
        <a class="btn btn-danger" style="margin-left: 5px; " href="{{ route('knowledgebase.index') }}">Back</a>
    </ol>
</section>

<section style="margin-top:30px;">

    <div class="col-sm-4">
        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Categories</h3>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                @forelse($article->categories as $category)
                <a href="{{ route('categories.edit', $category->id) }}">
                    <strong class="badge"
                        style="text-align: left; width: 100%; padding: 0.8rem; border-radius: 5px; font-size:1em; font-weight: 500; margin-bottom: 5px; background-color: {{ $category->color }}">
                        {{ $category->title }}
                    </strong>
                </a>
                @empty
                <p>No Category exist</p>
                @endforelse
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>






    <div class="col-sm-8">
        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Article</h3>
                <div class="box-tools pull-right">
                    <a onclick="validate();" href="{{ route('articles.destroy', $article->id) }}"
                        class="btn btn-danger btn-sm pull-right">
                        <i class="fa fa fa-trash-o"></i>
                        Delete Article
                    </a>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body" style="min-height: 750px; overflow: scroll;">
                {!! Form::model($article, ['route' => ['articles.update', $article->id], 'method' => 'patch']) !!}
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
                    'form-control', 'id' => 'issue')) !!}
                </div>

                <div class="form-group">
                    <label for="">Solution Description</label>

                    {!! Form::textarea('solution', null, array('placeholder' => 'Solution Description','class' =>
                    'form-control', 'id' => 'solution')) !!}
                </div>

                @if($article->file)
                <div class="form-group">
                    <div class="box-title">Image</div>
                    <div class="pb-5">
                        <img align="center" src="{{ asset('public/storage/'. $article->file ) }}" alt=""
                            class="img-responsive">
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label for="">Image/File Upload</label>

                    {!! Form::file('file', null, array('class' => 'form-control')) !!}
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
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