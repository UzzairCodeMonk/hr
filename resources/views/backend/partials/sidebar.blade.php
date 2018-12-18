<!-- Sidebar -->
<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
    <header class="sidebar-header">
        <a class="logo-icon" href="#">
            <h4><i class="ti ti-user"></i></h4>
        </a>
        <span class="logo">
            <a href="#"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
        </span>
        <span class="sidebar-toggle-fold"></span>
    </header>
    <nav class="sidebar-navigation">
        <ul class="menu">
            <li class="menu-category">Dashboard</li>

            <li class="menu-item">
                <a class="menu-link" href="../dashboard/general.html">
                    <span class="icon ti ti-dashboard"></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="menu-category">Modules</li>
            @include('leave::menu.sidebar-menu')
        </ul>
    </nav>
</aside>
<!-- END Sidebar -->
