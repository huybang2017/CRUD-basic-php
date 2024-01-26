<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

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

    $sql = "DELETE FROM clients WHERE id=$id";
    $con->query($sql);
}

header("location:/myshop/index.php");
exit;
