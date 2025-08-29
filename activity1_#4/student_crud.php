<?php
require_once 'Student.php';

$student = new Student();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $student->create([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'age' => $_POST['age']
        ]);
    } elseif (isset($_POST['update'])) {
        $student->update($_POST['id'], [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'age' => $_POST['age']
        ]);
    } elseif (isset($_POST['delete'])) {
        $student->delete($_POST['id']);
    }
}

// Fetch all students
$students = $student->readAll();

// For editing
$editStudent = null;
if (isset($_GET['edit'])) {
    $editStudent = $student->read((int)$_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student CRUD</title>
</head>
<body>
    <h1>Student Management</h1>

    <form method="post">
        <input type="hidden" name="id" value="<?= $editStudent['id'] ?? '' ?>">
        <label>Name: <input type="text" name="name" required value="<?= htmlspecialchars($editStudent['name'] ?? '') ?>"></label><br>
        <label>Email: <input type="email" name="email" required value="<?= htmlspecialchars($editStudent['email'] ?? '') ?>"></label><br>
        <label>Age: <input type="number" name="age" required value="<?= htmlspecialchars($editStudent['age'] ?? '') ?>"></label><br>

        <?php if ($editStudent): ?>
            <button type="submit" name="update">Update</button>
            <button type="submit" name="delete" onclick="return confirm('Delete this student?')">Delete</button>
            <a href="student_crud.php">Cancel</a>
        <?php else: ?>
            <button type="submit" name="create">Add Student</button>
        <?php endif; ?>
    </form>

    <h2>Students List</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($students as $s): ?>
                <tr>
                    <td><?= $s['id'] ?></td>
                    <td><?= htmlspecialchars($s['name']) ?></td>
                    <td><?= htmlspecialchars($s['email']) ?></td>
                    <td><?= $s['age'] ?></td>
                    <td>
                        <a href="?edit=<?= $s['id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($students)): ?>
                <tr><td colspan="5">No students found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
