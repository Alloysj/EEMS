<title>Eems</title>
<style>
    .navbar {
        background-color: #008000;
        border: none;
        border-radius: 0;
        padding-bottom: 30px;
    }


    .navbar-nav>li>a {
        color: #FFFFFF;
    }

    .navbar-nav>li>a.active,
    .navbar-nav>li>a:hover,
    .navbar-nav>li>a:focus {
        color: #FFD700;
        /* Yellow text color on hover/focus/active */
    }


    .navbar-brand {
        color: #FFFFFF;
    }

    .navbar-brand:hover,
    .navbar-brand:focus {
        color: #FFD700;
    }

    /* CSS for dropdown menu */
    .dropdown-menu {
        display: none;
        /* Initially hide the dropdown */
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* Show dropdown menu when hovering over the login button */
    #login-dropdown:hover .dropdown-menu {
        display: block;
    }

    /* Style for dropdown items */
    .dropdown-menu li {
        padding: 8px 12px;
    }

    /* Style for dropdown links */
    .dropdown-menu li a {
        color: #333;
        text-decoration: none;
        display: block;
    }

    /* Style for dropdown links on hover */
    .dropdown-menu li a:hover {
        background-color: #ddd;
    }
</style>
<header class="bgImage">
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header"><!--website title-->

                <a class="navbar-brand">
                    <h2>Egerton Event Management System</h2>
                </a>
            </div>

            <ul class="nav navbar-nav navbar-right"><!--navigation-->
                <li><a href="home.php"><strong>Home</strong></a></li>
                <li><a href="RegisteredEvents.php"><strong>My events</strong></a></li>
                <li><a href="contact.php"><strong>Contact Us</strong></a></li>
                <li><a href="aboutus.php"><strong>About us</strong></a></li>
                <li class="btnlogout"><a class="btn btn-default navbar-btn" href="index.php">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>

            </ul>
            </li>
            </ul>

        </div><!--container div-->
    </nav>

</header>
