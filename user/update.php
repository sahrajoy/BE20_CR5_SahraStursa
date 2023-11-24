<?php
    session_start();        
    
    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: /BE20_CR5_SahraStursa/index.php");
        exit();
    }

    // if you an adm then you get the choosen id from a user you want to change via dashboard
    if(isset($_SESSION["adm"])){
        $id = $_GET["id"]??$_SESSION["adm"];
    } else{
        $id = $_SESSION["user"];
    }

    require_once '../components/db_connect.php';
    require_once '../components/clean.php';
    require_once '../components/fileUpload.php';

    $emailError = "";
    $passwordError = "";
    // alerts
    $updateSuccess = false;
    $updateFailure = false;

    $sql = "SELECT * FROM user WHERE `user_id` = $id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST["update"])) {
        $email = clean($_POST["email"]);    
        $password = clean($_POST["password"]);
        $img = fileUpload($_FILES["img"]);

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
        }

        // check if password is empty
        if(empty($password)) { 
            $error = true;
            $passwordError = "Please enter a password";
        } 
        // check if password is valid
        elseif(strlen($password) < 3) { 
            $error = true;
            $passwordError = "Please enter a valid password";
        }

        if($error === false) {
            $password = hash("sha256", $password); //hash crypt the password

            if($_FILES["img"]["error"] == 0){
                if($row["user_img"] !== "user.jpg"){
                    unlink("../assets/$row[user_img]");
                }
                $sql = "UPDATE `user` SET `user_img`='$img[0]',`user_email`='$email',`user_password`='$password' WHERE user_id = $id";
            }
            else{
                $sql = "UPDATE `user` SET `user_email`='$email',`user_password`='$password' WHERE user_id = $id";
            }

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
    <title>Adopt a Pet</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- SweetAlert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php require_once '../components/navbar.php'; ?>

    <h1>Update your Profile</h1>
    <div class="container">
        <div class="form">
            <form method="post" enctype="multipart/form-data">
                <label>
                    <h3>Email:</h3>
                    <input type="email" name="email" class="form-control" value="<?= $row["user_email"]; ?>">
                    <span><?= $emailError; ?></span>
                </label>
                <label>
                    <h3>Password:</h3>
                    <input type="password" name="password" class="form-control">
                    <span><?= $passwordError; ?></span>
                </label>
                <label class="form-label">
                    <h3>Picture:</h3>
                    <input type="file" name="img" class="form-control">
                </label>
                <div class="buttonForm">
                    <input type="submit" value="Update" name="update" class="btn btn-success">
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
            title: 'Login successful',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location = "/BE20_CR5_SahraStursa/index.php";
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
            window.location = "update.php"; 
        });
    </script>
    <?php endif; ?>
    
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>