<?php
include('condb.php');
include('header.php');
include('footer.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert User</title>
</head>

<body>
    <h1>Insert User</h1>
    <?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];



    $sql = "INSERT INTO tb_user (fname, lname, phone,email, role) VALUES (:fname, :lname,:phone,:email,:role)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fname',$fname);
    $stmt->bindParam(':lname',$lname);
    $stmt->bindParam(':phone',$phone);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':role',$role);
    

    $result = $stmt->execute();

    if ($result !== false) {

        echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล";
    }
    ?>
    <hr>
    <a href="index.php" class="btn btn-primary">กลับหน้าหลัก</a>
</body>

</html>