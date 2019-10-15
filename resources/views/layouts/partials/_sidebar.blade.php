<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!------- outputting the image of the user that is logged into the system ------->
                <img src="{{ auth()->user()->avatar() }}" class="img-circle" style="max-height:45px;" alt="{{ auth()->user()->name }}">
            </div>
            <div class="pull-left info">
                <!---- outputting the name of the user that's logged in to the system ----------->
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
            </div>
        </div>

        <!----------------- sidebar menu: : style can be found in sidebar.less ------------------>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>

            <li><a href="{{ route('clients.index') }}"><i class="fa fa fa-address-book"></i><span>Clients</span></a></li>

            <li><a href="{{ route('tickets.index') }}"><i class="fa fa-ticket"></i><span>Tickets</span></a></li>

            <li><a href="{{ route('knowledgebase.index') }}"><i class="fa fa-server"></i><span>Knowledge Base</span></a></li>

            <li><a href="{{ route('report.index') }}"><i class="fa fa-pie-chart"></i></i><span>Reports</span></a></li>

            <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span>Users</span></a></li>

            <!--- using laravel auth plugin with roles and permissions, stating if the user has a ROLE of admin then to show this part of the sidebar too ---->
            @role('admin')
            <li class="header">ADMIN PANEL <i class="fa fa-plus-circle"></i></li>

            <li><a href="{{ route('users.create') }}"><i class="fa fa-user"></i> <span>Add New User</span></a></li>

            <li><a href="{{ route('report.export.clients') }}"><i class="fa fa-table"></i> <span>Export Clients Table</span></a></li>

            <li class="treeview menu-open">
                <a href="#"><i class="fa fa-table"></i> <span>Export Tickets Table</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span></a>

                <ul class="treeview-menu" style="display: block;">
                    <!---- on click of this button to go to the following route  and run the function from report controller????? -------------------->
                    <li><a href="{{ route('report.export.tickets', ['period' => 'week']) }}"><i class="fa fa-download"></i> Export Last Week Report</a></li>
                    <li><a href="{{ route('report.export.tickets', ['period' => 'month']) }}"><i class="fa fa-download"></i> Export Last Month Report</a></li>
                    <li><a href="{{ route('report.export.tickets', ['period' => 'year']) }}"><i class="fa fa-download"></i> Export Last Year Report</a></li>
                </ul>
            </li>
            @endrole
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
