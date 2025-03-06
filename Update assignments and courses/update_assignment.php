<?php
// update_assignment.php

require_once('database.php');
require_once('assignment_db.php'); // Include the assignment database functions

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Grab the form data
    $assignment_id = $_POST['assignment_id'];
    $description = $_POST['description'];
    $course_id = $_POST['course_id'];

    // Update the assignment in the database
    update_assignment($assignment_id, $description, $course_id);

    // Redirect to the assignments list page after successful update
    header('Location: assignments.php'); // Change to your assignments list page
    exit();
} else {
    // If the form wasn't submitted, fetch the current assignment details
    if (isset($_GET['id'])) {
        $assignment_id = $_GET['id'];
        $assignment = get_assignment_by_id($assignment_id); // Get assignment details
        if ($assignment) {
            $current_description = $assignment['Description'];
            $current_course_id = $assignment['courseID'];
        } else {
            die('Assignment not found.'); // Handle missing assignment
        }
    } else {
        die('Assignment ID not provided.'); // Handle missing ID
    }
}

// Fetch all courses for the dropdown
$courses = get_all_courses(); // Assuming this function exists
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Assignment</title>
</head>
<body>
    <h1>Update Assignment</h1>
    <form action="update_assignment.php" method="POST">
        <!-- Hidden field for Assignment ID -->
        <input type="hidden" name="assignment_id" value="<?php echo htmlspecialchars($assignment_id); ?>">

        <!-- Text input for Description -->
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" value="<?php echo htmlspecialchars($current_description); ?>" required>

        <!-- Dropdown list for Course -->
        <label for="course">Course:</label>
        <select name="course_id" id="course" required>
            <?php foreach ($courses as $course): ?>
                <option value="<?php echo htmlspecialchars($course['courseID']); ?>" <?php if ($course['courseID'] == $current_course_id) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($course['courseName']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Update Assignment</button>
    </form>
</body>
</html>
