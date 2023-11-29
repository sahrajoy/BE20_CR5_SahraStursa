<?php
    session_start();
    
    if((!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) || isset($_SESSION["user"])){
        header("Location: /BE20_CR5_SahraStursa/index.php");
    }

    require_once "../components/db_connect.php";
    require_once "../components/fileUpload.php";

    // alerts
    $updateSuccess = false;
    $updateFailure = false;

    // create a pet
    if(isset ($_POST["create"])){
        $img = fileUpload($_FILES["img"], "pet");
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $species = $_POST["species"];
        $age = $_POST["age"];
        $vac = isset($_POST["vaccinated"]) ? 1 : 0; // Check if vaccinated checkbox is checked
        $cast = isset($_POST["castrated"]) ? 1 : 0; // Check if castrated checkbox is checked
        $chip = isset($_POST["chipped"]) ? 1 : 0;  // Check if chipped checkbox is checked

        $sql = "INSERT INTO `pets`(`pet_img`, `pet_name`, `pet_gender`, `pet_species`, `pet_age`, `pet_vaccinated`, `pet_castrated`, `pet_chipped`) VALUES ('$img[0]', '$name','$gender','$species', $age, $vac, $cast, $chip)";
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
    <title>Adopt a Pet - Add a new Pet</title>
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

    <h1>Add a new Pet</h1>
    <div class="container">
        <div class="form">
            <form action="" method="POST" enctype="multipart/form-data">
                <label class="form-label">
                    <h3 class="me-auto">Image:</h3>
                    <input type="file" name="img" class="form-control ms-auto">
                </label>
                <label class="form-label">
                    <h3 class="me-auto">Name:</h3>
                    <input type="text" name="name" class="form-control ms-auto">
                </label>
                <label class="form-label">
                    <h3 class="me-auto">Gender:</h3>
                    <input type="text" name="gender" class="form-control ms-auto">
                </label>
                <label class="form-label">
                    <h3 class="me-auto">Species:</h3>
                    <input type="text" name="species" class="form-control ms-auto">
                </label>
                <label class="form-label">
                    <h3 class="me-auto">Age:</h3>
                    <input type="number" name="age" class="form-control ms-auto">
                </label>
                <!-- Checkbox vaccinated -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="vaccinated">
                    <label class="form-check-label" for="defaultCheck1">Vaccinated</label>
                </div>
                <!-- Checkbox castrated -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="castrated">
                    <label class="form-check-label" for="defaultCheck1">Castrated</label>
                </div>
                <!-- Checkbox chipped -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="chipped">
                    <label class="form-check-label" for="defaultCheck1">Chipped</label>
                </div>

                <div class="buttonForm">
                    <input type="submit" value="Create" name="create" class="btn btn-success">
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
            title: 'New pet has been created!',
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