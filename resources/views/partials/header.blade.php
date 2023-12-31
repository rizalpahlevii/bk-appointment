<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


        <li class="nav-item">
            @if(session('user')->type == 'admin')
                <a class="nav-link" role="button">
                    <i class="fas fa-user"></i>
                    {{session('user')->data->nama}}
                </a>
            @elseif(session('user')->type == 'pasien')
                <a class="nav-link" role="button">
                    <i class="fas fa-user"></i>
                    {{session('user')->data->nama}}
                </a>
            @elseif(session('user')->type == 'dokter')

                <a class="nav-link" role="button">
                    <i class="fas fa-user"></i>
                    {{session('user')?->data?->nama}}
                </a>
            @endif
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}" role="button">
                Logout
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>
