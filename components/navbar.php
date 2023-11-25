<?php
echo "
    <nav class='navbar navbar-expand-lg bg-body-tertiary'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='/BE20_CR5_SahraStursa/index.php'>
                <img src='../assets/logo.jpg' alt='logo' style='height: 15vh; width: 15vh; object-fit: cover;'>        
            </a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                <ul class='navbar-nav ms-auto mb-2 mb-lg-0'>
                ";
                    // show if admin is logged in 
                    if(isset($_SESSION['adm'])){
                        echo " 
                        <li class='nav-item align-self-center'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/user_dashboard.php'>User Dashboard</a>
                        </li>
                        <li class='nav-item align-self-center'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/pets/create.php'>Add Pets</a>
                        </li>
                        ";
                    }
                    // show if user is logged in
                    if(isset($_SESSION['user'])){
                        echo " 
                        <li class='nav-item align-self-center'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/pets/dashboard_adopted_pets.php'>Your adopted Pets</a>
                        </li>
                        ";
                    }
                    // show if user or admin is logged in
                    if(isset($_SESSION['user']) || isset($_SESSION['adm'])){
                        echo " 
                        <li class='nav-item align-self-center'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/update.php'>Update your Profile</a>
                        </li>
                        <li class='nav-item align-self-center'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/logout.php'>Logout</a>
                        </li>
                        ";
                    }else{
                        echo " 
                        <li class='nav-item align-self-center'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/login.php'>Login</a>
                        </li>
                        <li class='nav-item align-self-center'>
                        <a class='nav-link' href='/BE20_CR5_SahraStursa/user/register.php'>Register</a>
                        </li>
                        ";
                    }
                    // show img and name if logged in 
                    if(isset($_SESSION['user']) || isset($_SESSION['adm'])){
                        echo " 
                        <div id='img'>
                            <img src='../assets/$_SESSION[img]' alt='User Image' style='height: 6vh; width: 6vh; object-fit: cover; border-radius: 50vh; margin: 1vh;'>
                        </div>
                        ";
                    }
                echo "</ul>
            </div>
        </div>
    </nav>
    ";