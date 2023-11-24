<?php
    session_start();

    if((!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) || isset($_SESSION["user"])){
        header("Location: /BE20_CR5_SahraStursa/index.php");
    }
    
    // require_once is the most common used to link the database connetion
    require_once '../components/db_connect.php';

    $sql = "SELECT * FROM `products` p 
            LEFT JOIN `suppliers` s ON p.fk_supplier = s.id_supp";  
    $result = mysqli_query($conn, $sql);    
    $cards = "";

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $cards .= "
            <div class='p-1'>
                <div class='card' >
                    <img src='../assets/$row[picture]' class='card-img-top object-fit-cover' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>$row[name]</h5>
                        <p class='card-text'>Price: $row[price]</p>
                        <p class='card-text'>Supplier: $row[name_supp]</p>
                        <a href='details.php?id=$row[id]' class='btn btn-primary'>Details</a>
                        <a href='update.php?id=$row[id]' class='btn btn-warning'>Update</a>
                        <a href='delete.php?id=$row[id]' class='btn btn-danger'>Delete</a>
                    </div>
                </div>
            </div>
            ";
        }
    } else {
        $cards = "no data found";
    }
    
    mysqli_close($conn);
?><!DOCTYPE html>

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

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
        <!-- you also can write it with an "=" instead of the "php echo" -->
        <?= $cards; ?>  
    </div>

    <?php require_once '../components/footer.php'; ?>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>