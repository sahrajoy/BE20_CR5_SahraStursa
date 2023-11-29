<?php
    session_start();

    if((!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) || isset($_SESSION["user"])){
        header("Location: /BE20_CR5_SahraStursa/index.php");
    }

    require_once "../components/db_connect.php";
    require_once "../components/fileUpload.php";

    $suppliers = "";
    // alerts
    $updateSuccess = false;
    $updateFailure = false;
    
    // get pet
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "SELECT * FROM `pets` WHERE `pet_id` = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    }

    // update pet
    if(isset ($_POST["update"])){
        $img = fileUpload($_FILES["img"], "pet");
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $species = $_POST["species"];
        $age = $_POST["age"];
        $vac = isset($_POST["vaccinated"]) ? 1 : 0; // Check if vaccinated checkbox is checked
        $cast = isset($_POST["castrated"]) ? 1 : 0; // Check if castrated checkbox is checked
        $chip = isset($_POST["chipped"]) ? 1 : 0;  // Check if chipped checkbox is checked
        
        if($_FILES["img"]["error"] == 0) {
                if($row["picture"] !== "product.png"){
                    unlink("../assets/$row[picture]");
                }
                $sql = "UPDATE `pets` SET `pet_img`= '$img[0]', `pet_name`='$name', `pet_gender`='$gender', `pet_species`='$species', `pet_age`=$age, `pet_vaccinated`=$vac, `pet_castrated`=$cast, `pet_chipped`=$chip WHERE `pet_id`=$id";
        }else{
            $sql = "UPDATE `pets` SET `pet_name`='$name', `pet_gender`='$gender', `pet_species`='$species', `pet_age`=$age, `pet_vaccinated`=$vac, `pet_castrated`=$cast, `pet_chipped`=$chip WHERE `pet_id`=$id";
        }


        if (mysqli_query($conn, $sql)){
            $updateSuccess = true;
        }else  {
                $updateFailure = true;
        }
   }
    // close the connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt a Pet - Update Pet</title>
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

    <h1>Update Pet</h1>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <label class="form-label">
            <h3>Image:</h3>
                <input type="file" name="img" class="form-control" value="<?= $row["pet_img"]??"" ?>">
            </label>
            <label class="form-label">
                <h3>Name:</h3>
                <input type="text" name="name" class="form-control" value="<?= $row["pet_name"]??"" ?>">
            </label>
            <label class="form-label">
                <h3>Gender:</h3>
                <input type="text" name="gender" class="form-control" value="<?= $row["pet_gender"]??"" ?>">
            </label>
            <label class="form-label">
                <h3>Species:</h3>
                <input type="text" name="species" class="form-control" value="<?= $row["pet_species"]??"" ?>">
            </label>
            <label class="form-label">
                <h3>Age:</h3>
                <input type="number" name="age" class="form-control" value="<?= $row["pet_age"]??"" ?>">
            </label>
            <!-- Checkbox vaccinated -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" <?= $row["pet_vaccinated"] ? "checked" : "" ?> name="vaccinated">
                <label class="form-check-label" for="vaccinated">Vaccinated</label>
            </div>
            <!-- Checkbox castrated -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" <?= $row["pet_castrated"] ? "checked" : "" ?> name="castrated">
                <label class="form-check-label" for="castrated">Castrated</label>
            </div>
            <!-- Checkbox chipped -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" <?= $row["pet_chipped"] ? "checked" : "" ?> name="chipped">
                <label class="form-check-label" for="chipped">Chipped</label>
            </div>
    
            <div class="buttonForm">
                <input type="submit" value="Update" name="update" class="btn btn-success">
            </div>
        </form>
    </div>

    <?php require_once '../components/footer.php'; ?>

    <!-- SweetAlert for Success -->
    <?php if ($updateSuccess): ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Pet successful updated!',
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
            window.location = "/BE20_CR5_SahraStursa/index.php"; 
        });
    </script>
    <?php endif; ?>
    
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>