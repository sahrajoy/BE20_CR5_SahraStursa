<?php
    session_start();

    if (!isset($_SESSION["adm"] )) {
        header("Location: /BE20_CR5_SahraStursa/index.php");
    }

    require_once '../components/db_connect.php';

    $sql = "SELECT * FROM user WHERE `user_status` != 'adm'";
    $result = mysqli_query($conn, $sql);
    $data = "";

    // alerts
    $updateSuccess = false;
    $updateFailure = false;

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $data .= "
            <tr>
                <th scope='row'>$row[user_id]</th>
                <td>$row[user_email]</td>
                <td class='text-center'><a href='/BE20_CR5_SahraStursa/user/update.php?id=$row[user_id]' class='btn btn-primary'>Update</a></td>
            </tr>
            ";
        };
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt a Pet - User Dashboard</title>
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

    <h1>User Dashboard</h1>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?= $data; ?>
            </tbody>
        </table>
    </div>    

    <?php require_once '../components/footer.php'; ?>

    <!-- SweetAlert for Success -->
    <?php if ($updateSuccess): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Login successful',
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
            window.location = "login.php"; 
        });
    </script>
    <?php endif; ?>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>