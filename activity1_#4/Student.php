<?php
require_once 'Database.php';

class Student extends Database {
    protected string $table = 'students';
    protected array $fields = ['name', 'email', 'age'];

    // Additional student-specific methods can be added here
}
?>
