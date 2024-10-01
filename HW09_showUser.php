<?php
include('header.php');
require_once 'condb.php';

try {
    $sql = "SELECT * FROM tb_user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Employee Data Record</h1>
        <div>
            <a href="HW08_form.php" class="btn btn-primary">Add User</a>
        </div>
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $us) : ?>
                    <tr>
                        <td><?php echo $us['id']; ?></td>
                        <td><?php echo $us['fname']; ?></td>
                        <td><?php echo $us['lname']; ?></td>
                        <td><?php echo $us['phone']; ?></td>
                        <td><?php echo $us['email']; ?></td>
                        <td><?php echo $us['role'] == 1 ? "Admin" : "User"; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $us['id']; ?>" class="btn btn-warning">Edit</a>
                            <form action="HW10_deleteSweet.php" method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $us['id']; ?>">
                                <button type="button" class="delete-button btn btn-danger btn-sm" data-user-id="<?php echo $us['id']; ?>">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <a href="index.php">ย้อนกลับไปหน้าหลัก</a>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();

            // Function for showing delete confirmation
            function showDeleteConfirmation(userId) {
                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: 'คุณจะไม่สามารถเรียกคืนข้อมูลกลับได้!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'ลบ',
                    cancelButtonText: 'ยกเลิก',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = 'HW10_deleteSweet.php';
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'user_id';
                        input.value = userId;
                        form.appendChild(input);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }

            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const userId = button.getAttribute('data-user-id');
                    showDeleteConfirmation(userId);
                });
            });
        });
    </script>
</body>

</html>
