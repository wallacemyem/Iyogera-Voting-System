<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-light">

        <div class="slimscroll-menu">

            <!-- LOGO -->
            <a href="#" class="logo text-center">
                <span class="logo-lg">
                <img src="{{asset('backend/images/logo-dark.png')}}" alt="" height="50">
                </span>
                <span class="logo-sm">
                <img src="{{asset('backend/images/logo-dark.png')}}" alt="" height="16">
                </span>
            </a>
            <!--- Sidemenu -->
            <ul class="metismenu side-nav side-nav-light">
                <li class="side-nav-title side-nav-item">Navigation</li>
                <li class="side-nav-item">
                    <a href="{{ route('dashboard') }}" class="side-nav-link">
                        <i class="em em-abacus" aria-role="presentation" aria-label="ABACUS"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('user.index') }}" class="side-nav-link">
                        <i class="em em-man-boy-boy" aria-role="presentation" aria-label=""></i>
                        <span> Users </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('position.index') }}" class="side-nav-link">
                        <i class="em em-clipboard" aria-role="presentation" aria-label="CLIPBOARD"></i>
                        <span> Position </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('vote.result') }}" class="side-nav-link">
                        <i class="em em-writing_hand" aria-role="presentation" aria-label=""></i>
                        <span> Results </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('nominee.index') }}" class="side-nav-link">
                        <i class="em em-recycle" aria-role="presentation" aria-label="BLACK UNIVERSAL RECYCLING SYMBOL"></i>
                        <span> Nomination </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('election.index') }}" class="side-nav-link">
                        <i class="em em-date" aria-role="presentation" aria-label="CALENDAR"></i>
                        <span> Election </span>
                    </a>
                </li>

            </ul>
            <!-- End Sidebar -->
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
    </div>
    <!-- Left Sidebar End -->
