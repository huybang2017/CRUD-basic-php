<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = "root";
$servername = "localhost";
$password = "";
$database = "myshop";

// connect db
$con = new mysqli($servername, $username, $password, $database);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /myshop/index.php");
        exit;
    }
    $id = $_GET["id"];

    // đọc bảng client tìm user bằng id

    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /myshop/index.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
} else {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    do {
        if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Update client in the database
        $sql = "UPDATE clients SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";
        $results = $con->query($sql);

        if (!$results) {
            $errorMessage = "Invalid query: " . $con->error;
        }

        $successMessage = "Client updated correctly";

        header("location: /myshop/index.php");
        exit();
    } while (true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container m-5">
        <h1>My clients</h1>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <div class="row my-5 d-none">
                <label class="col-sm-3 col-form-label">id: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo $id ?>">
                </div>
            </div>
            <div class="row my-5">
                <label class="col-sm-3 col-form-label">Name: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>

            <div class="row my-5">
                <label class="col-sm-3 col-form-label">Email: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>

            <div class="row my-5">
                <label class="col-sm-3 col-form-label">Phone: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
                </div>
            </div>

            <div class="row my-5">
                <label class="col-sm-3 col-form-label">Address: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="/myshop/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>