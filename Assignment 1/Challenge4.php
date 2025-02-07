<?php
// Input: student's marks
$marks = 85; 

// Determine the grade based on the marks
if ($marks >= 90) {
    echo "You got an A!";
} elseif ($marks >= 80) {
    echo "You got a B!";
} elseif ($marks >= 70) {
    echo "You got a C!";
} elseif ($marks >= 60) {
    echo "You got a D!";
} else {
    echo "You got an F!";
}
?>
