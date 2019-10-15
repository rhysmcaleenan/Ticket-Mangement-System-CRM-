@extends('layouts.main')

@section('content')
<section class="content-header">
    <h1>
        Knowledge Base
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>Control Panel</li>
        <li class="active">Knowledge Base</li>
        <li class="active">Category View</li>
        <a class="btn btn-danger" style="margin-left: 5px; " href="{{ route('dashboard.index') }}">Back</a>
    </ol>
</section>


<section style="margin-top:30px;">
    <div class="col-sm-4">
        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Category</h3>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->

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

                {!! Form::model($category, ['method' => 'PATCH','route' => ['categories.update', $category->id]]) !!}
                <div class="form-group">
                    {!! Form::color('color', null, array('class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                    {!! Form::text('title', null, array('placeholder' => 'Event title','class' => 'form-control')) !!}
                </div>

                <button type="submit" class="btn btn-success pull-left">Submit</button>
                {!! Form::close() !!}

                {!! Form::open(array('route' => ['categories.destroy', $category->id], 'method' => 'DELETE', 'id' => 'categories-delete'))
                !!}
                <button type="submit" class="btn btn-danger pull-right">Delete</button>
                {!! Form::close() !!}

                <script>
                    $('#categories-delete').on('submit', function(event) {
                        var r = confirm("Are you sure ?");

                        if (r != true) {
                        event.preventDefault();
                        }
                    });
                </script>

                <div class="clearfix"></div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!--
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categories</h3>

                    </div>

                    <div class="box-body">
                        @forelse($categories as $cat)
                            @if ($cat->id !== $category->id)
                            <a href="{{ route('categories.edit', $cat->id) }}">
                                <strong class="badge"
                                        style="text-align: left; width: 100%; padding: 0.8rem; border-radius: 5px; font-size:1em; font-weight: 500; margin-bottom: 5px; background-color: {{ $cat->color }}">
                                    {{ $cat->title }}
                                    <span class="pull-right">{{ $cat->articles()->count() }}</span>
                                </strong>
                            </a>
                            @endif
                        @empty
                            <p>No Category exist</p>
                        @endforelse
                    </div>
                </div>-->
    </div>

    <div class="col-sm-8">
        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">{{$category->title}} Articles</h3>
            </div>

            <div class="box-body">
                @forelse($category->articles as $article)
                <div style="padding-bottom:55px; border-bottom: #ccc solid 1px">
                    <span class="col-lg-1 col-md-2 col-sm-3"><img src="{{ asset('public/storage/'. $article->file ) }}"
                            alt="" class="img-responsive" style="width:64px;max-width:unset;min-width: 100%;"></span>

                    <span class="col-lg-11 col-md-9 col-sm-3" style="padding-left:42px;">
                        <div><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></div>
                        <div style="color: #ccc;font-size:13px;">{{ $article->issue }}</div>
                    </span>
                    <!--
                                <span class="col-lg-2 col-md-2 col-sm-2 text-center"
                                      style="background-color:#ccc;color:#000;font-size:11px;border-radius:5px;">Created By: {{ $article->user->name }}</span>-->
                </div>
                @empty
                <p class="text-center">No articles currently exist</p>
                @endforelse
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</section>
@endsection