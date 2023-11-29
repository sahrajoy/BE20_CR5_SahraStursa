<?php
    session_start();        
    
    if(isset($_SESSION["user"]) || isset($_SESSION["adm"])){
        header("Location: /BE20_CR5_SahraStursa/index.php");
    }

    require_once '../components/db_connect.php';
    require_once '../components/clean.php';

    $emailError = "";
    $passwordError = "";
    // alerts
    $updateSuccess = false;
    $updateFailure = false;

    if (isset($_POST["register"])) {
        $email = clean($_POST["email"]);
        $password = clean($_POST["password"]);
       
        $error = false;
        
        // check if email is empty
        if(empty($email)) {     
            $error = true;
            $emailError = "Please enter a email";
        } 
        // check if email is valid
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {    
            $error = true;
            $emailError = "Please enter a valid email";
        } else {
            $sql = "SELECT * FROM user WHERE user_email = '$email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) !== 0) {
                $error = true;
                $emailError = "Email already exists.";
            }
        }

        // check if password is empty
        if(empty($password)) {  
            $error = true;
            $passwordError = "Please enter a password";
        } 
        // check if password is valid
        elseif(strlen($password) < 6) {     
            $error = true;
            $passwordError = "Please enter a valid password";
        }

        if($error === false) {
            $password = hash("sha256", $password); //hash crypt the password

            $sql = "INSERT INTO `user`(`user_email`, `user_password`) VALUES ('$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $updateSuccess = true;
            }else  {
                $updateFailure = true;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt a Pet - Sign up</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- SweetAlert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php
    $loc="../";
    require_once '../components/navbar.php'; 
    ?>

    <h1>Sign Up</h1>
    <div class="container">
        <div class="form">
            <form method="post" enctype="multipart/form-data">
                <label>
                    <h3>Email:</h3>
                    <input type="email" name="email" class="form-control" value="<?= $email??""; ?>">
                    <span><?= $emailError; ?></span>
                </label>
                <label>
                    <h3>Password:</h3>
                    <input type="password" name="password" class="form-control">
                    <span><?= $passwordError; ?></span>
                </label>
                <div class="buttonForm">
                    <input type="submit" value="Register" name="register" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

    <?php require_once '../components/footer.php'; ?>

    <!-- SweetAlert for Success -->
    <?php if ($updateSuccess): ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'New user has been created!',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location = "login.php";
        });
    </script>
    <?php endif; ?>
    
    <!-- SweetAlert for Failure -->
    <?php if ($updateFailure): ?> 
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
        }).then(function() {
            window.location = "/BE20_CR5_SahraStursa/index.php"; 
        });
    </script>
    <?php endif; ?>
    
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>