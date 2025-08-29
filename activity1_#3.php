<?php
class Student {
    private string $name;
    private array $courses = [];
    private const COURSE_COST = 1450;

    public function __construct(string $name) {
        $this->name = $name;
    }

    // Add a course to the student's list
    public function addCourse(string $course): void {
        if (!in_array($course, $this->courses)) {
            $this->courses[] = $course;
        }
    }

    // Remove a course from the student's list
    public function removeCourse(string $course): void {
        $index = array_search($course, $this->courses);
        if ($index !== false) {
            unset($this->courses[$index]);
            // Reindex array to keep it sequential
            $this->courses = array_values($this->courses);
        }
    }

    // Get total enrollment fee based on number of courses
    public function getTotalFee(): int {
        return count($this->courses) * self::COURSE_COST;
    }

    // Optional: get list of courses
    public function getCourses(): array {
        return $this->courses;
    }
}

// Example usage:
$student = new Student("Juan Dela Cruz");
$student->addCourse("Mathematics");
$student->addCourse("Physics");
$student->addCourse("Chemistry");

// Remove a course
$student->removeCourse("Physics");

// Display total enrollment fee
echo "Total enrollment fee for " . $student->getTotalFee() . " PHP\n";

// Optional: display courses
echo "Enrolled courses: " . implode(", ", $student->getCourses()) . "\n";
?>
