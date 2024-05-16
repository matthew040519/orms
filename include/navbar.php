<nav class="pcoded-navbar theme-horizontal menu-light">
        <div class="navbar-wrapper container">
            <div class="navbar-content sidenav-horizontal" id="layout-sidenav">
                <ul class="nav pcoded-inner-navbar sidenav-inner">
                    <li class="nav-item pcoded-menu-caption">
                    	<label>Navigation</label>
                    </li>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <?php if($_SESSION['role'] == 1) { ?>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Entry</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="users.php">Users</a></li>
                            <li><a href="rooms.php">Rooms</a></li>
                            <li><a href="amenities.php">Amenities</a></li>
                            <li><a href="setuprooms.php">Rooms With Amenities</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link "><span class="pcoded-micon"><i class="fas fa-calendar"></i></span><span class="pcoded-mtext">Reservation</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="pendingreservation.php">Pending Reservation</a></li>
                            <li><a href="acceptreservation.php">Accepted Reservation</a></li>
                            <li><a href="declinereservation.php">Decline Reservation</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link "><span class="pcoded-micon"><i class="fas fa-database"></i></span><span class="pcoded-mtext">Reports</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="reservationreports.php">Reservation Reports</a></li>
                        </ul>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Booking</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="booking.php">Book a Room</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link "><span class="pcoded-micon"><i class="fas fa-database"></i></span><span class="pcoded-mtext">Reports</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="reservationreports.php">Reservation Reports</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>