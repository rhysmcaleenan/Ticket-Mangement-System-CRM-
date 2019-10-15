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
                <h3 class="box-title">Article View</h3>
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
                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm pull-right">
                    Edit Article
                </a>
                <div class="box-title">Article Title</div>
                <h5 style="color:#929090;">{{ $article->title }}</h5>

                <div class="box-title">Created By</div>
                <div class="box-comment">
                    <h5 style="color:#929090;">{{ $article->user->name }}</h5>
                </div>

                <div class="box-title">Issue Description</div>
                <p class="box-comment">
                    <h5 style="color:#929090;">{{ $article->issue }}</h5>
                </p>

                <div class="box-title">Solution</div>
                <p class="box-comment">
                    <h5 style="color:#929090;">{{ $article->solution }}</h5>
                </p>

                @if($article->file)
                <div class="box-title">Image</div>
                <div class="pb-5">
                    <img align="center" src="{{ asset('public/storage/'. $article->file ) }}" alt=""
                        class="img-responsive">
                </div>
                @endif

                <div class="mt-5 pull-right">
                    <!--
                        <a onclick="validate();"
                           href="{{ route('articles.destroy', $article->id) }}" class="btn btn-danger">Delete</a>
                    -->
                    <script>
                        function validate() {
                                event.preventDefault();

                                if(confirm('Are you sure you want to delete this article?')) {
                                    alert('The article has been successfully deleted');
                                    document.getElementById('delete-form').submit();
                                }
                            }
                    </script>

                    <form id="delete-form" action="{{ route('articles.destroy', $article->id) }}" method="POST"
                        style="display: none;">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

</section>
@endsection