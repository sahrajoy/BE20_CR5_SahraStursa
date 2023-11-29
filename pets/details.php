<?php
    session_start();        
    
    // require_once is the most common used to link the database connetion
    require_once '../components/db_connect.php';

    // alerts
    $adoptSuccsess = false;
    $adoptFailure = false;
    $alreadyAdopt = false;

    if (isset($_SESSION["user"]) && isset($_POST["adopt"])) {
        $petId = $_POST["pet"];
        $userId = $_SESSION["user"];
    
        // Check if the pet has already been adopted by this user
        $checkQuery = "SELECT * FROM `pet_adopt` WHERE `fk_user` = $userId AND `fk_pet` = $petId";
        $checkResult = mysqli_query($conn, $checkQuery);
    
        // If the pet has not been adopted by this user
        if (mysqli_num_rows($checkResult) == 0) {
            $date = date("Y-m-d");
            $insertQuery = "INSERT INTO `pet_adopt` (`fk_user`, `fk_pet`, `adopt_date`) VALUES ($userId, $petId, '$date')";
            if (mysqli_query($conn, $insertQuery)) {
                $adoptSuccsess = true;
            } else {
                $adoptFailure = true;
            }
        } else {
            $alreadyAdopt = true;
        }
    }

    if(isset($_GET['id']) && !empty($_GET["id"])){
        $sql = "SELECT * FROM `pets` WHERE `pet_id` = $_GET[id]";
        $result = mysqli_query($conn, $sql);    
        $cards = "";
    
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
                $cards .= "
                <div class='p-1'>
                    <div class='card' >
                        <img src='../assets/$row[pet_img]' class='card-img-top object-fit-cover' alt='...'>
                        <div class='card-body'>
                            <h4 class='card-title text-center mt-1'>$row[pet_name]</h4>
                            <p class='card-text'>Gender: $row[pet_gender]</p>
                            <p class='card-text'>Species: $row[pet_species]</p>
                            <p class='card-text'>Age: $row[pet_age]</p>
                            ";
                            // shows if vaccinated/castrated/chipped Yes, else No
                            if($row["pet_vaccinated"]) {
                                $cards .= " <p class='card-text'>Vaccinated: Yes</p>";
                            } else {
                                $cards .= "<p class='card-text'>Vaccinated: No</p>";
                            }
                            if($row["pet_castrated"]) {
                                $cards .= "<p class='card-text'>Castrated: Yes</p>";
                            } else {
                                $cards .= "<p class='card-text'>Castrated: No</p>";
                            }
                            if($row["pet_chipped"]) {
                                $cards .= "<p class='card-text'>Chipped: Yes</p>";
                            } else {
                                $cards .= "<p class='card-text'>Chipped: No</p>";
                            }
                            $cards .= "<div class='d-flex justify-content-around'>";

                            // if a admin is logged in than shows the buttons "Edit" and "Delete"
                            if(isset($_SESSION["adm"])) {
                                $cards .= "
                                <a href='update.php?id=$row[pet_id]' class='btn btn-primary' style='width:200px'>Edit</a>
                                <a href='delete.php?id=$row[pet_id]' class='btn btn-danger' style='width:200px'>Delete</a>
                                ";
                            }
                            // if user is logged in shows the button "Adopt"
                            if(isset($_SESSION["user"])) {
                                $cards .= "
                                <form method='POST'>
                                    <input type='hidden' value='$row[pet_id]' name='pet'>
                                    <input type='submit' value='Adopt' name='adopt' class='btn btn-danger' style='width:200px'>
                                </form>
                                ";
                            }  elseif(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
                                $cards .= "<a href='../user/login.php' class='btn btn-primary' style='width:200px'>Adopt</a>";
                            }
                            $cards .= "</div>
                        </div>
                    </div>
                </div>
                ";
        } else {
            $cards = "no data found";
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
    <?php
    $loc="../";
    require_once '../components/navbar.php'; 
    ?>

    <div class="container">
        <?= $cards; ?>  
    </div>

    <?php require_once '../components/footer.php'; ?>

    <!-- SweetAlert for Adopt Success -->
    <?php if ($adoptSuccsess): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'You have succsessfully adopted a Pet!',
        }).then(function() {
            window.location = "/BE20_CR5_SahraStursa/index.php";
        });
    </script>
    <?php endif; ?>
    <!-- SweetAlert for Adopt Failure -->
    <?php if ($adoptFailure): ?> 
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
    <!-- SweetAlert for aleady Adopt Failure -->
    <?php if ($alreadyAdopt): ?> 
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "You already adopt this pet!",
        }).then(function() {
            window.location = "/BE20_CR5_SahraStursa/index.php"; 
        });
    </script>
    <?php endif; ?>
        
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>