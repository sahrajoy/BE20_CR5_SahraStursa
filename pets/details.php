<?php
    session_start();        
    
    // require_once is the most common used to link the database connetion
    require_once '../components/db_connect.php';

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
                            <h3 class='card-title'>$row[pet_name]</h3>
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

                            // if a admin is logged in than shows the buttons "Edit" and "Delete"
                            if(isset($_SESSION["adm"])) {
                                $cards .= "
                                <a href='update.php?id=$row[pet_id]' class='btn btn-primary'>Edit</a>
                                <a href='delete.php?id=$row[pet_id]' class='btn btn-danger'>Delete</a>
                                ";
                            }
                            // if user is logged in shows the button "Adopt"
                            if(isset($_SESSION["user"])) {
                                $cards .= "
                                <form method='POST'>
                                    <input type='hidden' value='$row[pet_id]' name='adopt'>
                                    <input type='submit' value='Adopt' name='adopt' class='btn btn-danger'>
                                </form>
                                ";
                            }  elseif(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
                                $cards .= "<a href='../user/login.php' class='btn btn-primary'>Adopt</a>";
                            }
                        $cards .= "</div>
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
    <?php require_once '../components/navbar.php'; ?>

    <div class="container">
        <?= $cards; ?>  
    </div>

    <?php require_once '../components/footer.php'; ?>
        
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>