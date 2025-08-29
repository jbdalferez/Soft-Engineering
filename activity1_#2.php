
<?php

class QuadraticEquation {
    private float $a;
    private float $b;
    private float $c;

    public function __construct(float $a, float $b, float $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getA(): float {
        return $this->a;
    }

    public function getB(): float {
        return $this->b;
    }

    public function getC(): float {
        return $this->c;
    }

    public function getDiscriminant(): float {
        return ($this->b * $this->b) - (4 * $this->a * $this->c);
    }

    public function getRoot1(): float|null {
        $discriminant = $this->getDiscriminant();
        if ($discriminant >= 0) {
            return (-$this->b + sqrt($discriminant)) / (2 * $this->a);
        } else {
            return null; // No real roots
        }
    }

    public function getRoot2(): float|null {
        $discriminant = $this->getDiscriminant();
        if ($discriminant >= 0) {
            return (-$this->b - sqrt($discriminant)) / (2 * $this->a);
        } else {
            return null; // No real roots
        }
    }
}

// Example usage:
// Create a QuadraticEquation object for x^2 + 2x - 3 = 0
$equation1 = new QuadraticEquation(1, 2, -3);

echo "Equation: " . $equation1->getA() . "x^2 + " . $equation1->getB() . "x + " . $equation1->getC() . " = 0\n";
echo "Discriminant: " . $equation1->getDiscriminant() . "\n";

$root1 = $equation1->getRoot1();
$root2 = $equation1->getRoot2();

if ($root1 !== null) {
    echo "Root 1: " . $root1 . "\n";
    echo "Root 2: " . $root2 . "\n";
} else {
    echo "The equation has no real roots.\n";
}

echo "------------------------\n";

// Example with one root: x^2 + 6x + 9 = 0
$equation2 = new QuadraticEquation(1, 6, 9);

echo "Equation: " . $equation2->getA() . "x^2 + " . $equation2->getB() . "x + " . $equation2->getC() . " = 0\n";
echo "Discriminant: " . $equation2->getDiscriminant() . "\n";

$root1_single = $equation2->getRoot1();

if ($root1_single !== null) {
    echo "Root: " . $root1_single . "\n";
} else {
    echo "The equation has no real roots.\n";
}

echo "------------------------\n";

// Example with no real roots: x^2 + x + 1 = 0
$equation3 = new QuadraticEquation(1, 1, 1);

echo "Equation: " . $equation3->getA() . "x^2 + " . $equation3->getB() . "x + " . $equation3->getC() . " = 0\n";
echo "Discriminant: " . $equation3->getDiscriminant() . "\n";

$root1_complex = $equation3->getRoot1();

if ($root1_complex !== null) {
    echo "Root 1: " . $root1_complex . "\n";
    echo "Root 2: " . $equation3->getRoot2() . "\n";
} else {
    echo "The equation has no real roots.\n";
}

?>
```
