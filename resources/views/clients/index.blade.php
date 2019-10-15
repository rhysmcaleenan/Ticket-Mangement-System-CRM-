@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clients
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Control Panel</li>
            <li class="active">Clients</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">All Clients</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-success btn-sm" href="{{ route('clients.create') }}">Add New</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="btn-toolbar">
                    <div class="w-25">
                        <h4> Total Clients : <span id="total_records">{{ $clients->total() }}</span></h4>
                    </div>

                    <div class="w-75">
                        <form class="form-inline" id="search-form">
                            {{--                                <input type="search" name="search" id="search" class="form-control mr-sm-6"--}}
                            {{--                                       placeholder="Search Tickets" autocomplete="off">--}}

                            <style>
                                .search-wrapper {
                                    position: absolute;
                                    z-index: 1;
                                    top: 40px;
                                    right: 20px;
                                }

                                .search-wrapper.active {
                                    right: 75px;
                                    top: 50px;
                                }

                                .search-wrapper .input-holder {
                                    height: 50px;
                                    /*width: 70px;*/
                                    overflow: hidden;
                                    background: rgba(255, 255, 255, 0);
                                    border-radius: 6px;
                                    position: relative;
                                    transition: all 0.3s ease-in-out;
                                }

                                .search-wrapper.active .input-holder {
                                    width: 350px;
                                    border-radius: 50px;
                                    border: 1px solid;
                                    /*background: rgba(0, 0, 0, 0.5);*/
                                    transition: all .5s cubic-bezier(0.000, 0.105, 0.035, 1.570);
                                }

                                .search-wrapper .input-holder .search-input {
                                    width: 100%;
                                    height: 30px;
                                    padding: 0px 70px 0 20px;
                                    opacity: 0;
                                    position: absolute;
                                    top: 0px;
                                    left: 0px;
                                    background: transparent;
                                    box-sizing: border-box;
                                    border: none;
                                    outline: none;
                                    font-family: "Open Sans", Arial, Verdana;
                                    font-size: 16px;
                                    font-weight: 400;
                                    line-height: 20px;
                                    color: #FFF;
                                    transform: translate(0, 60px);
                                    transition: all .3s cubic-bezier(0.000, 0.105, 0.035, 1.570);
                                    transition-delay: 0.3s;
                                }

                                .search-wrapper.active .input-holder .search-input {
                                    opacity: 1;
                                    transform: translate(0, 10px);
                                    color: #000;
                                }

                                .search-wrapper .input-holder .search-icon {
                                    width: 70px;
                                    height: 70px;
                                    border: none;
                                    border-radius: 6px;
                                    background: #FFF;
                                    padding: 0px;
                                    outline: none;
                                    position: relative;
                                    z-index: 2;
                                    float: right;
                                    cursor: pointer;
                                    transition: all 0.3s ease-in-out;
                                }

                                .search-wrapper.active .input-holder .search-icon {
                                    width: 50px;
                                    height: 30px;
                                    margin: 10px;
                                    border-radius: 30px;
                                }

                                .search-wrapper .input-holder .search-icon span {
                                    width: 22px;
                                    height: 22px;
                                    display: inline-block;
                                    vertical-align: middle;
                                    position: relative;
                                    transform: rotate(45deg);
                                    transition: all .4s cubic-bezier(0.650, -0.600, 0.240, 1.650);
                                }

                                .search-wrapper.active .input-holder .search-icon span {
                                    transform: rotate(-45deg);
                                }

                                .search-wrapper .input-holder .search-icon span::before, .search-wrapper .input-holder .search-icon span::after {
                                    position: absolute;
                                    content: '';
                                }

                                .search-wrapper .input-holder .search-icon span::before {
                                    width: 4px;
                                    height: 11px;
                                    left: 9px;
                                    top: 18px;
                                    border-radius: 2px;
                                    background: #FE5F55;
                                }

                                .search-wrapper .input-holder .search-icon span::after {
                                    width: 14px;
                                    height: 14px;
                                    left: 0px;
                                    top: 0px;
                                    border-radius: 16px;
                                    border: 4px solid #FE5F55;
                                }

                                .search-wrapper .close {
                                    position: absolute;
                                    z-index: 1;
                                    top: 15px;
                                    right: 20px;
                                    width: 25px;
                                    height: 25px;
                                    cursor: pointer;
                                    transform: rotate(-180deg);
                                    transition: all .3s cubic-bezier(0.285, -0.450, 0.935, 0.110);
                                    transition-delay: 0.2s;
                                }

                                .search-wrapper.active .close {
                                    right: -50px;
                                    transform: rotate(45deg);
                                    transition: all .6s cubic-bezier(0.000, 0.105, 0.035, 1.570);
                                    transition-delay: 0.5s;
                                }

                                .search-wrapper .close::before, .search-wrapper .close::after {
                                    position: absolute;
                                    content: '';
                                    background: #FE5F55;
                                    border-radius: 2px;
                                }

                                .search-wrapper .close::before {
                                    width: 5px;
                                    height: 25px;
                                    left: 10px;
                                    top: 0px;
                                }

                                .search-wrapper .close::after {
                                    width: 25px;
                                    height: 5px;
                                    left: 0px;
                                    top: 10px;
                                }
                            </style>

                            <div class="search-wrapper">
                                <div class="input-holder">
                                    <input type="search" name="search" id="search" class="search-input" placeholder="Type to search" autocomplete="off">
                                    <button class="search-icon" onclick="searchToggle(this, event);"><span></span></button>
                                </div>
                                <span class="close" onclick="searchToggle(this, event);"></span>
                            </div>
                        </form>
                    </div>
                </div>

                <hr>

                @include('layouts.partials._alerts')

                <div class="table-responsive">

                    <table class="table table-striped table-sm" id="table">
                        <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Support Type</th>
                            <th>Profile</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->client }}</td>
                                <td>{{ $client->telephone}}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->supporttype }}</td>
                                <td><a href="{{ route('clients.show', ['id' => $client->id]) }}" class="btn btn-primary btn-sm">View</a></td>
                                <td><a href="{{ route('clients.delete', ['id' => $client->id]) }}" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                {!! $clients->render() !!}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>

    <script type="text/javascript">
        function searchToggle(obj, evt) {
            var container = $(obj).closest('.search-wrapper');
            if (!container.hasClass('active')) {
                container.addClass('active');
                evt.preventDefault();
            } else if (container.hasClass('active') && $(obj).closest('.input-holder').length == 0) {
                container.removeClass('active');
                // clear input
                container.find('.search-input').val('');
            }
        }

        function fetch_client_data(value) {
            var rows = '';
            $.getJSON('{{ route('clients.index') }}',
                {query: value})
                .done(function (data) {
                    if (data.clients.length > 0) {
                        var editURL = "{{ route('clients.show', ['id' => ':id']) }}";
                        var deleteURL = "{{ route('clients.show', ['id' => ':id']) }}";

                        $.each(data.clients, function (i, row) {
                            rows += '<tr>' +
                                '<td>' + row.client + '</td>' +
                                '<td>' + row.telephone + '</td>' +
                                '<td>' + row.email + '</td>' +
                                '<td>' + row.supporttype + '</td>' +
                                '<td><a href="' + editURL.replace(':id', row.id) + '" class="btn btn-primary btn-sm">View</a></td>' +
                                '<td><a href="' + deleteURL.replace(':id', row.id) + '" class="btn btn-danger btn-sm">Delete</a></td>' +
                                '</tr>';
                        });
                    } else {
                        rows += '<td align= "center" colspan="7" > No Clients Found </td>'
                    }

                    $('#table tbody').html(rows);
                    $('#total_records').text(data.total);
                    $('.pagination').html(data.pagination);
                })
                .fail(function (error) {
                    console.log('error');
                    console.log(error);
                });
        }

        $('#search-form').on('submit', function (event) {
            event.preventDefault();
        });

        $('#search').keyup(function (event) {
            event.preventDefault();

            var query = $(this).val();
            fetch_client_data(query);
        });
    </script>

@endsection
