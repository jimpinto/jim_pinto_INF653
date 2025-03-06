<?php
require_once('model/database.php');
require_once('model/course_db.php');

// Get the course ID from the URL
$course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
$course_name = get_course_name($course_id);

// Check if the course exists before displaying the form
if ($course_name === "Unknown Course") {
    $error = "Course not found.";
    include('view/error.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
</head>
<body>
    <h1>Update Course</h1>
    
    <!-- Display the form for updating a course -->
    <form action="update_course.php" method="post">
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
        <label for="course_name">Course Name:</label>
        <input type="text" name="course_name" value="<?php echo htmlspecialchars($course_name); ?>" required>
        <input type="submit" name="action" value="Update Course">
    </form>
    
    <p><a href=".?action=list_courses">Cancel</a></p>
</body>
</html>
