<?php
require_once 'Database.php';

class Attendance extends Database {
    protected string $table = 'attendance';
    protected array $fields = ['student_id', 'date', 'status'];

    // Additional attendance-specific methods can be added here
}
?>
