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
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h3 class="mt-4">ฟอร์มกรอกข้อมูลพนักงาน</h3>
        <hr>
        <form action="HW07_script.php" method="post">
            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="fname" id="firstname" aria-describedby="firstname">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lname" id="lastname" aria-describedby="lastname">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">phone</label>
                <input type="phone" class="form-control" name="phone" id="phone" aria-describedby="pho">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Role : </label>
                <input type="radio" class="form-check-input" name="role" id="role1" value="1">
                <label for="role1" class="form-label">admin</label>
                <input type="radio" class="form-check-input" name="role" id="role2" value="0" checked>
                <label for="role2" class="form-label">user</label>
            </div>
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </form>
        <hr>
        <p class="text-end">
            <a href="index.php" class="btn btn-primary">กลับหน้าหลัก</a>
        </p>
    </div>
</body>

</html>