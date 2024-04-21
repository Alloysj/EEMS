<title>Eems</title>
<style>
/*.bgImage {
    background-image: url(images/eu_logo.png);
    background-size: contain;
    background-size: 100%, 100%;
    height: 50%;
    background-repeat: no-repeat;
    height: 350px;
    margin-bottom: 25px;
}*/

/* Update background color */
.bgImage {
    background-image: url(images/eu_logo.png);
    background-size: fit;
    background-position: center;
    height: 60vh; 
    border-top: 150px;
}


.navbar {
    background-color: #008000; 
    border: none; 
    border-radius: 0; 
}


.navbar-nav > li > a {
    color: #FFFFFF; 
}

.navbar-nav > li > a.active,
.navbar-nav > li > a:hover,
.navbar-nav > li > a:focus {
    color: #FFD700; /* Yellow text color on hover/focus/active */
}


.navbar-brand {
    color: #FFFFFF; 
}

.navbar-brand:hover,
.navbar-brand:focus {
    color: #FFD700; 
}


.jumbotron {
    background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
    padding: 50px; 
    margin-top: 50px; 
    text-align: center;
}

.jumbotron h1 {
    color: #008000; 
}

.jumbotron p {
    color: #333333; 
}

</style>
<header class="bgImage" > 
    <nav class="navbar" >
        <div class="container">
        <div class="navbar-header"><!--website name/title-->
               
                <a class = "navbar-brand">
                   <h2>Egerton Event Management System</h2>
                </a>
        </div>
       
            <ul class="nav navbar-nav navbar-right"><!--navigation-->
                    <li><a href = "index.php"><strong>Home</strong></a></li>
                   <!-- <li><a href = "register.php"><strong>Register</strong></a></li> -->
                    <li><a href = "contact.php"><strong>Contact Us</strong></a></li>
                    <li><a href = "aboutus.php"><strong>About us</strong></a></li>
                    <li class="btnlogout"><a class = "btn btn-default navbar-btn" href = "login_form.php">Login <span class = "glyphicon glyphicon-log-in"></span></a></li>

            
                
                
            </ul>
        </div><!--container div-->
    </nav>
    <div class = "col-md-12">
        <div class = "container">
            <div class = "jumbotron"><!--jumbotron-->
                <h1><strong>Explore<br></strong> Your Favorite Event</h1><!--jumbotron heading-->
                <br><div class="browse d-md-flex col-md-14" >
                <div class="row">
                  
            </div>
        </div>
    </div>
</header>