 <header id="header" class="header fixed-top d-flex align-items-center">

     <div class="d-flex align-items-center justify-content-between">
         <a href="/" class="logo d-flex align-items-center">
             <img src="assets/img/epasslogo.png" alt="">
             <span class="d-none d-lg-block">E-Pass Slip RS</span>
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
     </div><!-- End Logo -->


     <nav class="header-nav ms-auto">
         <ul class="d-flex align-items-center">


             @php
                 // Fetch the latest 4 notifications for the logged-in user
                 $notifications = Auth::user()->notifications; // Get all notifications, not just unread ones
             @endphp

             <li class="nav-item dropdown">
                 <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                     <i class="bi bi-bell"></i>
                     <span class="badge bg-primary badge-number">{{ Auth::user()->unreadNotifications->count() }}</span>
                 </a>

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                     <li class="dropdown-header">
                         You have {{ Auth::user()->unreadNotifications->count() }} new notifications
                         <form action="{{ route('notifications.markAllAsReadguest') }}" method="POST"
                             style="display: inline;" id="mark-all-read-form">
                             @csrf
                             <button type="submit" class="badge rounded-pill bg-primary p-2 ms-2"
                                 style="border: none; cursor: pointer;">
                                 Mark all as read
                             </button>
                         </form>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <!-- Notification List with Scrollable Container -->
                     <div style="max-height: 300px; overflow-y: auto;">
                         @foreach ($notifications as $notification)
                             <li class="notification-item">
                                 <i class="bi bi-exclamation-circle "></i>
                                 <div>

                                     <p>{{ $notification->data['message'] }}</p>
                                     <!-- Display the message from the notification -->
                                     <p>{{ $notification->created_at->diffForHumans() }}</p>
                                 </div>
                             </li>
                             <li>
                                 <hr class="dropdown-divider">
                             </li>
                         @endforeach
                     </div>

                     <li class="dropdown-footer">
                         <a href="#">Show all notifications</a>
                     </li>
                 </ul>
             </li>


             <li class="nav-item dropdown pe-3">

                 <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                     data-bs-toggle="dropdown">
                     <img src="{{ Auth::check() && Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/img/default-avatar.jpg') }}"
                         alt="Profile" class="rounded-circle">
                     <span class="d-none d-md-block dropdown-toggle ps-2">
                         {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                     </span>
                 </a><!-- End Profile Image Icon -->

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                     <li class="dropdown-header">
                         <h6>

                             {{ Auth::check() ? Auth::user()->name : 'Guest' }} <br>

                         </h6>
                         <span>

                             {{ Auth::check() ? Auth::user()->designation : 'sad' }} <br>



                         </span>
                         <span>
                             {{ Auth::check() ? Auth::user()->email : 'Guest' }}
                         </span>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-center" href="/guestprofile">
                             <i class="bi bi-person"></i>
                             <span>My Profile</span>
                         </a>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>



                     <li>
                         <form id="logout-form" action="/guestout" method="POST" style="display: none;">
                             @csrf
                         </form>
                         <a class="dropdown-item d-flex align-items-center" href="#"
                             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                             <i class="bi bi-box-arrow-right"></i>
                             <span>Log Out</span>
                         </a>
                     </li>


                 </ul><!-- End Profile Dropdown Items -->
             </li><!-- End Profile Nav -->

         </ul>
     </nav><!-- End Icons Navigation -->

 </header>
