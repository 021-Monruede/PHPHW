<?php
require_once 'condb.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$userId = $_GET['id'];

try {
    $sql = "SELECT * FROM tb_user WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: index.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    try {
        $sql = "UPDATE tb_user SET fname = :fname, lname = :lname, phone = :phone, email = :email, role = :role WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $userId);
        
        $stmt->execute();
        header("Location: index.php?message=User+updated+successfully");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit User</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" name="fname" id="fname" class="form-control" value="<?php echo htmlspecialchars($user['fname']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" name="lname" id="lname" class="form-control" value="<?php echo htmlspecialchars($user['lname']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="1" <?php echo ($user['role'] == 1) ? 'selected' : ''; ?>>Admin</option>
                    <option value="0" <?php echo ($user['role'] == 0) ? 'selected' : ''; ?>>User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update User</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>
