<?php
require_once 'db_connect.php';

$img = 'default.png';
$id = 0;
// Check if the user is logged in and retrieve their information
if(isset($_SESSION["user"]) || isset($_SESSION["adm"])) {
    if(isset($_SESSION["user"])){
        $id = $_SESSION["user"];
    } elseif(isset($_SESSION["adm"])) {
        $id = $_SESSION["adm"];
    }
    $sql = "SELECT user_img FROM user WHERE user_id = $id";
    $result = mysqli_query($conn, $sql);
    
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (!empty($row["user_img"])) {
            $img = $row["user_img"];
        }
    } else {
        // Handle error or user not found
        $img = 'default.png'; // A default image if user's image is not found
    }
}

?>
    <nav class='navbar navbar-expand-lg bg-body-tertiary'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='/BE20_CR5_SahraStursa/index.php'>
                <!-- show img and name if logged in -->
                <?php if(isset($_SESSION["user"]) || isset($_SESSION["adm"])): ?>
                    <div id='img'>
                        <img src='../assets/<?= $img ?>' alt='User Image' style='height: 50px; width: 50px; object-fit: cover;'>
                    </div>
                <?php else: ?>
                    Navbar
                <?php endif; ?>
            </a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                    <!-- show if admin is logged in -->
                    <?php if(isset($_SESSION["adm"])): ?>
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/user_dashboard.php'>User Dashboard</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/pets/create.php'>Add Pets</a>
                        </li>
                    <?php endif; ?>
                    <!-- show if user or admin is logged in -->
                    <?php if(isset($_SESSION["user"]) || isset($_SESSION["adm"])): ?>
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/pets/dashboard_adopted_pets.php'>Your Adopted Pets</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/update.php'>Update your Profile</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/logout.php'>Logout</a>
                        </li>
                    <?php else: ?>
                        <li class='nav-item'>
                            <a class='nav-link' href='/BE20_CR5_SahraStursa/user/login.php'>Login</a>
                        </li>
                        <li class='nav-item'>
                        <a class='nav-link' href='/BE20_CR5_SahraStursa/user/register.php'>Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>