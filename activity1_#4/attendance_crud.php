<?php
require_once 'Attendance.php';
require_once 'Student.php';

$attendance = new Attendance();
$student = new Student();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $attendance->create([
            'student_id' => $_POST['student_id'],
            'date' => $_POST['date'],
            'status' => $_POST['status']
        ]);
    } elseif (isset($_POST['update'])) {
        $attendance->update($_POST['id'], [
            'student_id' => $_POST['student_id'],
            'date' => $_POST['date'],
            'status' => $_POST['status']
        ]);
    } elseif (isset($_POST['delete'])) {
        $attendance->delete($_POST['id']);
    }
}

// Fetch all attendance records
$records = $attendance->readAll();

// Fetch all students for dropdown
$students = $student->readAll();

// For editing
$editRecord = null;
if (isset($_GET['edit'])) {
    $editRecord = $attendance->read((int)$_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance CRUD</title>
</head>
<body>
    <h1>Attendance Management</h1>

    <form method="post">
        <input type="hidden" name="id" value="<?= $editRecord['id'] ?? '' ?>">

        <label>Student:
            <select name="student_id" required>
                <option value="">Select Student</option>
                <?php foreach ($students as $s): ?>
                    <option value="<?= $s['id'] ?>" <?= (isset($editRecord['student_id']) && $editRecord['student_id'] == $s['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($s['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>

        <label>Date: <input type="date" name="date" required value="<?= $editRecord['date'] ?? '' ?>"></label><br>

        <label>Status:
            <select name="status" required>
                <option value="Present" <?= (isset($editRecord['status']) && $editRecord['status'] == 'Present') ? 'selected' : '' ?>>Present</option>
                <option value="Absent" <?= (isset($editRecord['status']) && $editRecord['status'] == 'Absent') ? 'selected' : '' ?>>Absent</option>
            </select>
        </label><br>

        <?php if ($editRecord): ?>
            <button type="submit" name="update">Update</button>
            <button type="submit" name="delete" onclick="return confirm('Delete this record?')">Delete</button>
            <a href="attendance_crud.php">Cancel</a>
        <?php else: ?>
            <button type="submit" name="create">Add Attendance</button>
        <?php endif; ?>
    </form>

    <h2>Attendance Records</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr><th>ID</th><th>Student</th><th>Date</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($records as $r): ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td>
                        <?php
                        $studentName = '';
                        foreach ($students as $s) {
                            if ($s['id'] == $r['student_id']) {
                                $studentName = $s['name'];
                                break;
                            }
                        }
                        echo htmlspecialchars($studentName);
                        ?>
                    </td>
                    <td><?= $r['date'] ?></td>
                    <td><?= $r['status'] ?></td>
                    <td>
                        <a href="?edit=<?= $r['id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($records)): ?>
                <tr><td colspan="5">No attendance records found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
