<?php
include('condb.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert User</title>
</head>

<body>
    <!-- <h1>Insert User</h1> -->
    <?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];



    $sql = "INSERT INTO tb_user (fname, lname, phone,email, role) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$fname);
    $stmt->bindParam(2,$lname);
    $stmt->bindParam(3,$phone);
    $stmt->bindParam(4,$email);
    $stmt->bindParam(5,$role);
    

    $result = $stmt->execute();

    //if ($result !== false) {

    //    echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
    //} else {
    //    echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล";
    //}

    //SweetAlert


    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    if ($result) {
        echo '<script>
        setTimeout(function() {
        Swal.fire({
        position: "center",
        icon: "success",
        title: "เพิ่มข้อมูลสําเร็จ",
        showConfirmButton: false,
        timer: 1500
        }).then(function() {
        window.location = "index.php"; // Redirect to.. ปรับแก้ชื่อไฟล์ตามที่ต้องการให้ไป
        });
        }, 15);
        </script>';
    } else {
        echo '<script>
        setTimeout(function() {
        Swal.fire({
        position: "center",
        icon: "error",
        title: "เกิดขอผิดพลาด",
        showConfirmButton: true,
        // timer: 1500
        }).then(function() {
        window.location = "index.php"; // Redirect to.. ปรับแก้ชื่อไฟล์ตามที่ต้องการให้ไป
        });
        }, 15);
        </script>';
    }

    ?>


    <!-- <hr> -->
    <!-- <a href="index.php" class="btn btn-primary">กลับหน้าหลัก</a> -->
</body>

</html>