<?php
    echo"
    <nav class='navbar navbar-expand-lg bg-body-tertiary'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='/BE20_CR5_SahraStursa/index.php'>Navbar</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                    ";
                    // show if admin is logged in
                    if(isset($_SESSION["adm"])){
                        echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/user_dashboard.php'>User Dashboard</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/pets/create.php'>Add Pets</a>
                        </li>
                        ";
                    }
                    // show if user or admin is logged in
                    if(isset($_SESSION["user"]) || isset($_SESSION["adm"])){
                        echo"
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/update.php'>Update your Profile</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/logout.php'>Logout</a>
                        </li>
                        ";
                    }else{
                        echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/login.php'>Login</a>
                        </li>
                        <li class='nav-item'>
                        <a class='nav-link' href='/BE20_CR5_SahraStursa/user/register.php'>Register</a>
                        </li>
                        ";
                    }
                echo "</ul>
            </div>
        </div>
    </nav>
";