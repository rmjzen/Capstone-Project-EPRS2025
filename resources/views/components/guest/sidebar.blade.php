<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Home</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/guestdashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed " href="/guestpass">
                <i class="bi bi-card-heading"></i>
                <span>Pass Slip</span>
            </a>
        </li>


        {{-- @if (auth()->user()->designation === 'Head of Office')
            <li class="nav-item">
                <a class="nav-link collapsed" href="/guestpass">
                    <i class="bi bi-card-heading"></i>
                    <span>Request from faculty</span>
                </a>
            </li>
        @endif
        <!-- End Pass Slip Nav --> --}}

        <li class="nav-item">
            <a class="nav-link collapsed " href="/guestviewrequest">
                <i class="bi bi-calendar4-range"></i>
                <span>Request Pass Slip</span>
            </a>
        </li>
        <!-- End Request Pass Slip Nav -->



        <li class="nav-heading">Settings</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/guestprofile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
            </a>
        </li><!-- End F.A.Q Page Nav --> --}}



        <li>
            <form id="logout-form" action="/guestout" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="nav-link collapsed" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
            </a>
        </li>




    </ul>

</aside>
<!-- End Sidebar-->
