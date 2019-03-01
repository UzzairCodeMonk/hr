<li class="menu-item">
        <a class="menu-link" href="#">
            <span class="icon ti-files"></span>
            <span class="title">Leave</span>
            <span class="arrow"></span>
        </a>
    
        <ul class="menu-submenu">
            <li class="menu-item">
                <a class="menu-link" href="{{route('leave.apply')}}">
                    <span class="dot"></span>
                    <span class="title">Apply Leave</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{route('leave.index',['status' => 'submitted'])}}">
                    <span class="dot"></span>
                    <span class="title">My Leave Applications</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-item">
        <a class="menu-link" href="#">
            <span class="icon ti-money"></span>
            <span class="title">Wage</span>
            <span class="arrow"></span>
        </a>
    
        <ul class="menu-submenu">
            <li class="menu-item">
                <a class="menu-link" href="{{URL::signedRoute('payslip.personal-payslips')}}">
                    <span class="dot"></span>
                    <span class="title">My Payslips</span>
                </a>
            </li>
        </ul>
    </li>
    
    <li class="menu-item">
        <a class="menu-link" href="#">
            <span class="icon ti-files"></span>
            <span class="title">Claim</span>
            <span class="arrow"></span>
        </a>
    
        <ul class="menu-submenu">
            <li class="menu-item">
                <a class="menu-link" href="{{route('claim.submit')}}">
                    <span class="dot"></span>
                    <span class="title">Create Claim</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{route('claim.my-claims')}}">
                    <span class="dot"></span>
                    <span class="title">My Claims Record</span>
                </a>
            </li>
        </ul>
    </li>
    