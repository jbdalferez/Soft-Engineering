<?php
class Rectangle {
    private float $width;
    private float $height;

    // Constructor with default values
    public function __construct(float $width = 1.0, float $height = 1.0) {
        $this->width = $width;
        $this->height = $height;
    }

    // Method to get the area of the rectangle
    public function getArea(): float {
        return $this->width * $this->height;
    }

    // Method to get the perimeter of the rectangle
    public function getPerimeter(): float {
        return 2 * ($this->width + $this->height);
    }

    // Optional: getters and setters if needed
    public function getWidth(): float {
        return $this->width;
    }

    public function getHeight(): float {
        return $this->height;
    }

    public function setWidth(float $width): void {
        $this->width = $width;
    }

    public function setHeight(float $height): void {
        $this->height = $height;
    }
}
?>
