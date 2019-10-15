<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboard.index') }}" class="logo" style="padding:0;">
        <!-- mini logo for sidebar mini screen -->
        <span class="logo-mini"><b>E2</b>CS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="width:240px;"><b>E2</b> Computer Solutions</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle hamburger button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <?php $notes = \App\Note::where('owner_id', auth()->id())->get(); ?>
            <ul class="nav navbar-nav">
                <li class="btn-group dropdown">

                    <a type="button" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a style="color:#777;" href="{{ route('tickets.create') }}">Create a Ticket</a></li>

                        <li><a style="color:#777;" href="{{ route('clients.create') }}">Create a Client</a></li>

                        <li><a style="color:#777;" href="{{ route('knowledgebase.index') }}">Create an Article</a></li>
                    </ul>
                </li>

                <li class="dropdown notifications-menu">

                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">{{ $notes->count() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{ $notes->count() }} notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach($notes as $note)
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="{{ $note->user->avatar() }}" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                {{ $note->user->name }}
                                                <small><i class="fa fa-clock-o"></i>  {{ $note->created_at->format('l j F') }} </small>
                                            </h4>
                                            {{-- <a href="{{ route('notes.show', $note->id) }}"> --}}
                                            @if(strlen($note->message) > 35)
                                                {{ substr($note->message, 0, 35) }}...
                                            @else
                                                {{ $note->message }}
                                            @endif
                                            {{-- </a> --}}
                                        </a>
                                    </li>
                                @endforeach

                        
                            </ul>
                        </li>
                        <li class="footer"><a href="{{ route('users.profile.index') }}">See All Notifications</a></li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!----- getting the image related to the user logged in ----->
                        <img src="{{ auth()->user()->avatar() }}" class="user-image" alt="User Image">
                        <!----- getting the name of the user that is loged in through laravel auth ------->
                        <span class="hidden-xs">{{ Auth::user()->name }} </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <!----- getting the image related to the user logged in ----->
                            <img src="{{ auth()->user()->avatar() }}" class="img-circle" alt="User Image">
                            <p>
                                <!----- getting the image related to the user logged in ----->
                            {{ Auth::user()->name }}
                            <!----- getting the image related to the user logged in ----->
                                <small>{{ Auth::user()->email }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <!------ route to the logged in users profile page ----->
                                <a href="{{ route('users.profile.index') }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <!---- using laravel auth this will log user out of their session -->
                                <a class="btn btn-default btn-flat"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>
                                <!--- this form is completed when the user clicks the button below to confirm they want to log out -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>