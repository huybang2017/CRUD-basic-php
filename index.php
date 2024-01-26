<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container m-5">
        <h1>List of Clients</h1>
        <a class="btn btn-success" href="/myshop/create.php" role="button">New Clients</a>
        <br><br>

        <table class="table table-info">
            <thead>
                <tr class="text-center border-end">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Create at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- connect database: cái này search mạng copy vào không cần nhớ :)) -->
                <?php
                $servername = "localhost";
                $database = "myshop";
                $username = "root";
                $password = "";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // mysqli_close($conn);

                // ->: giống như . trong js hoặc là java dùng để trỏ vào phương thức của đối tượng

                // còn 1 cách connect trên w3c dùng PDO,MySQLi Procedural gì đó thì cũng đươc nma đa phần các project đều dùng cách kết nối như này vì nhanh gọn dễ hiểu (cách này gọi là MySQLi Object-oriented)

                // read database: đọc data
                $sql = "SELECT * FROM clients";
                $result = $conn->query($sql);
                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }

                // read data of each row
                // fetch_assoc: hàm để đọc giá trị trong bảng coi phần mysqli như đã nói để hiểu thêm
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr class='text-center border-end'>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td>$row[email]</td>
                            <td>$row[phone]</td>
                            <td>$row[address]</td>
                            <td>$row[created_at]</td>
                            <td>
                                <a class='btn btn-primary' href='/myshop/edit.php?id=$row[id]'>Edit</a>
                                <a class='btn btn-danger' href='/myshop/delete.php?id=$row[id]'>Delete</a>
                            </td>
                        </tr>
                    ";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>