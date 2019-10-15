@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Support Tickets
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Control Panel</li>
        <li class="active">Support Tickets</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box box-danger box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">All Tickets</h3>

            <div class="box-tools pull-right">
                <a class="btn btn-success btn-sm" href="{{ route('tickets.create') }}">Add New</a>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="">
                <h1 class="h3  col-md-8">Latest Support Tickets</h1>

                <div class="btn-toolbar">
                    <div class="pull-right">
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

                                .search-wrapper .input-holder .search-icon span::before,
                                .search-wrapper .input-holder .search-icon span::after {
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

                                .search-wrapper .close::before,
                                .search-wrapper .close::after {
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
                                    <input type="search" name="search" id="search" class="search-input"
                                        placeholder="Type to search" autocomplete="off">
                                    <button class="search-icon"
                                        onclick="searchToggle(this, event);"><span></span></button>
                                </div>
                                <span class="close" onclick="searchToggle(this, event);"></span>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <hr>

                @include('layouts.partials._alerts')

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_all" data-toggle="tab">All</a></li>
                        <li><a href="#tab_complete" data-toggle="tab">Complete</a></li>
                        <li><a href="#tab_in_progress" data-toggle="tab">In Progress</a></li>
                        <li><a href="#tab_unresolved" data-toggle="tab">Unresolved</a></li>
                        <li><a href="#tab_waiting" data-toggle="tab">Waiting on Customer</a></li>
                        <li><a href="#tab_open" data-toggle="tab">Open</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_all">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" id="table_all">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Caller Name</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>View</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->client['client'] }}</td>
                                            <td>{{ $ticket->callername}}</td>

                                            <td>
                                                @if(strlen($ticket->title) > 70)
                                                {{ substr($ticket->title, 0, 70) }}...
                                                @else
                                                {{ $ticket->title }}
                                                @endif
                                            </td>

                                            <!-- styling for what to colour to display if status is different (changes colour code) -->
                                            <?php
                                            $style = 'color: #fff; font-size:0.8em; background-color: #';
                                            if ($ticket->status === 'Complete') {
                                                $style .= '00a65a';
                                            } elseif ($ticket->status === 'In Progress') {
                                                $style .= 'f39c12';
                                            } elseif ($ticket->status === 'Waiting on Customer') {
                                                $style .= '3c8dbc';
                                            } elseif ($ticket->status === 'Unresolved') {
                                                $style .= 'dd4b39';
                                            } elseif ($ticket->status === 'Open') {
                                                $style .= 'a09e9e';
                                            }
                                            $style .= ';';
                                            ?>
                                            <!----- end of styling --->
                                            <td><span class="label" style="{{ $style }}"> {{ $ticket->status }}</span>
                                            </td>
                                            <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                                            <td><a href="{{ route('tickets.show', $ticket->id) }}"
                                                    class="btn btn-primary btn-sm">View</a></td>
                                            <td><a href="{{ route('tickets.delete', $ticket->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {!! $tickets->render() !!}
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_complete">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Caller Name</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>View</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                        @if($ticket->status === 'Complete')
                                        <tr>
                                            <td>{{ $ticket->client['client'] }}</td>
                                            <td>{{ $ticket->callername}}</td>

                                            <td>
                                                @if(strlen($ticket->title) > 70)
                                                {{ substr($ticket->title, 0, 70) }}...
                                                @else
                                                {{ $ticket->title }}
                                                @endif
                                            </td>

                                            <td><span class="label"
                                                    style="color:#fff; font-size:0.8em; background-color: #00a65a">
                                                    {{ $ticket->status }}</span></td>
                                            <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                                            <td><a href="{{ route('tickets.show', $ticket->id) }}"
                                                    class="btn btn-primary btn-sm">View</a></td>
                                            <td><a href="{{ route('tickets.delete', $ticket->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_in_progress">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Caller Name</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>View</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                        @if($ticket->status === 'In Progress')
                                        <tr>
                                            <td>{{ $ticket->client['client'] }}</td>
                                            <td>{{ $ticket->callername}}</td>

                                            <td>
                                                @if(strlen($ticket->title) > 70)
                                                {{ substr($ticket->title, 0, 70) }}...
                                                @else
                                                {{ $ticket->title }}
                                                @endif
                                            </td>

                                            <td><span class="label"
                                                    style="color:#fff; font-size:0.8em; background-color: #f39c12">
                                                    {{ $ticket->status }}</span></td>
                                            <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                                            <td><a href="{{ route('tickets.show', $ticket->id) }}"
                                                    class="btn btn-primary btn-sm">View</a></td>
                                            <td><a href="{{ route('tickets.delete', $ticket->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_unresolved">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" id="table_unresolved">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Caller Name</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>View</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                        @if($ticket->status === 'Unresolved')
                                        <tr>
                                            <td>{{ $ticket->client['client'] }}</td>
                                            <td>{{ $ticket->callername}}</td>

                                            <td>
                                                @if(strlen($ticket->title) > 70)
                                                {{ substr($ticket->title, 0, 70) }}...
                                                @else
                                                {{ $ticket->title }}
                                                @endif
                                            </td>

                                            <td><span class="label"
                                                    style="color:#fff; font-size:0.8em; background-color: #dd4b39">
                                                    {{ $ticket->status }}</span></td>
                                            <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                                            <td><a href="{{ route('tickets.show', $ticket->id) }}"
                                                    class="btn btn-primary btn-sm">View</a></td>
                                            <td><a href="{{ route('tickets.delete', $ticket->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_waiting">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Caller Name</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>View</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                        @if($ticket->status === 'Waiting on Customer')
                                        <tr>
                                            <td>{{ $ticket->client['client'] }}</td>
                                            <td>{{ $ticket->callername}}</td>

                                            <td>
                                                @if(strlen($ticket->title) > 70)
                                                {{ substr($ticket->title, 0, 70) }}...
                                                @else
                                                {{ $ticket->title }}
                                                @endif
                                            </td>

                                            <td><span class="label"
                                                    style="color:#fff; font-size:0.8em; background-color: #3c8dbc">
                                                    {{ $ticket->status }}</span></td>
                                            <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                                            <td><a href="{{ route('tickets.show', $ticket->id) }}"
                                                    class="btn btn-primary btn-sm">View</a></td>
                                            <td><a href="{{ route('tickets.delete', $ticket->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_open">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Caller Name</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>View</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                        @if($ticket->status === 'Open')
                                        <tr>
                                            <td>{{ $ticket->client['client'] }}</td>
                                            <td>{{ $ticket->callername}}</td>

                                            <td>
                                                @if(strlen($ticket->title) > 70)
                                                {{ substr($ticket->title, 0, 70) }}...
                                                @else
                                                {{ $ticket->title }}
                                                @endif
                                            </td>

                                            <td><span class="label"
                                                    style="color:#fff; font-size:0.8em; background-color: #a09e9e">
                                                    {{ $ticket->status }}</span></td>
                                            <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                                            <td><a href="{{ route('tickets.show', $ticket->id) }}"
                                                    class="btn btn-primary btn-sm">View</a></td>
                                            <td><a href="{{ route('tickets.delete', $ticket->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">

        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
</section>
@endsection

@push('script')
<script>
    // Javascript to enable link to tab
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    } 

    // Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    })

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
            var table_all = '';
            var table_complete = '';
            var table_in_progress = '';
            var table_waiting = '';
            var table_open = '';
            var table_unresolved = '';
            $.getJSON('{{ route('tickets.index') }}',
                {query: value})
                .done(function (data) {
                    if (data.tickets.length > 0) {
                        $.each(data.tickets, function (i, row) {
                            var style = 'color: #fff; font-size:0.8em; background-color: #';
                            if (row.status === 'Complete') {
                                style += '00a65a';
                            } else if (row.status === 'In Progress') {
                                style += 'f39c12';
                            } else if (row.status === 'Waiting on Customer') {
                                style += '3c8dbc';
                            } else if (row.status === 'Unresolved') {
                                style += 'dd4b39';
                            } else {
                                style += 'a09e9e';
                            }
                            style += ';';

                            table_all += '<tr>' +
                                '<td>' + row.client + '</td>' +
                                '<td>' + row.callername + '</td>' +
                                '<td>' + row.title + '</td>' +
                                '<td><span class="label" style="' + style + '">' + row.status + '</span></td>' +
                                '<td>' + row.created_at + '</td>' +
                                '<td><a href="tickets/' + row.id + '" class="btn btn-primary btn-sm">View</a></td>' +
                                '<td><a href="tickets/delete/' + row.id + '" class="btn btn-danger btn-sm">Delete</a></td>' +
                                '</tr>';

                            if (row.status === 'Complete') {
                                table_complete += '<tr>' +
                                    '<td>' + row.client + '</td>' +
                                    '<td>' + row.callername + '</td>' +
                                    '<td>' + row.title + '</td>' +
                                    '<td><span class="label" style="' + style + '">' + row.status + '</span></td>' +
                                    '<td>' + row.created_at + '</td>' +
                                    '<td><a href="tickets/' + row.id + '" class="btn btn-primary btn-sm">View</a></td>' +
                                    '<td><a href="tickets/delete/' + row.id + '" class="btn btn-danger btn-sm">Delete</a></td>' +
                                    '</tr>';
                            } else if (row.status === 'In Progress') {
                                table_in_progress += '<tr>' +
                                    '<td>' + row.client + '</td>' +
                                    '<td>' + row.callername + '</td>' +
                                    '<td>' + row.title + '</td>' +
                                    '<td><span class="label" style="' + style + '">' + row.status + '</span></td>' +
                                    '<td>' + row.created_at + '</td>' +
                                    '<td><a href="tickets/' + row.id + '" class="btn btn-primary btn-sm">View</a></td>' +
                                    '<td><a href="tickets/delete/' + row.id + '" class="btn btn-danger btn-sm">Delete</a></td>' +
                                    '</tr>';
                            } else if (row.status === 'Waiting on Customer') {
                                table_waiting += '<tr>' +
                                    '<td>' + row.client + '</td>' +
                                    '<td>' + row.callername + '</td>' +
                                    '<td>' + row.title + '</td>' +
                                    '<td><span class="label" style="' + style + '">' + row.status + '</span></td>' +
                                    '<td>' + row.created_at + '</td>' +
                                    '<td><a href="tickets/' + row.id + '" class="btn btn-primary btn-sm">View</a></td>' +
                                    '<td><a href="tickets/delete/' + row.id + '" class="btn btn-danger btn-sm">Delete</a></td>' +
                                    '</tr>';
                            } else if (row.status === 'Open') {
                                table_open += '<tr>' +
                                    '<td>' + row.client + '</td>' +
                                    '<td>' + row.callername + '</td>' +
                                    '<td>' + row.title + '</td>' +
                                    '<td><span class="label" style="' + style + '">' + row.status + '</span></td>' +
                                    '<td>' + row.created_at + '</td>' +
                                    '<td><a href="tickets/' + row.id + '" class="btn btn-primary btn-sm">View</a></td>' +
                                    '<td><a href="tickets/delete/' + row.id + '" class="btn btn-danger btn-sm">Delete</a></td>' +
                                    '</tr>';
                            } else if (row.status === 'Unresolved') {
                                table_unresolved += '<tr>' +
                                    '<td>' + row.client + '</td>' +
                                    '<td>' + row.callername + '</td>' +
                                    '<td>' + row.title + '</td>' +
                                    '<td><span class="label" style="' + style + '">' + row.status + '</span></td>' +
                                    '<td>' + row.created_at + '</td>' +
                                    '<td><a href="tickets/' + row.id + '" class="btn btn-primary btn-sm">View</a></td>' +
                                    '<td><a href="tickets/delete/' + row.id + '" class="btn btn-danger btn-sm">Delete</a></td>' +
                                    '</tr>';
                            }
                        });
                    } else {
                        table_all = '<td align= "center" colspan="7" > No Tickets Found </td>';
                        table_complete = '<td align= "center" colspan="7" > No Tickets Found </td>';
                        table_in_progress = '<td align= "center" colspan="7" > No Tickets Found </td>';
                        table_waiting = '<td align= "center" colspan="7" > No Tickets Found </td>';
                        table_open = '<td align= "center" colspan="7" > No Tickets Found </td>';
                        table_unresolved = '<td align= "center" colspan="7" > No Tickets Found </td>';
                    }

                    $('#table_all tbody').html(table_all);
                    $('#table_complete tbody').html(table_complete);
                    $('#table_in_progress tbody').html(table_in_progress);
                    $('#table_waiting tbody').html(table_waiting);
                    $('#table_open tbody').html(table_open);
                    $('#table_unresolved tbody').html(table_unresolved);
                    $('#total_records').text(data.total);
                    $('#tab_all .pagination').html(data.pagination);
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
@endpush