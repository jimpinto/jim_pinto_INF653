<?php
// assignment_db.php

require_once('database.php'); // Include the database connection

// Fetch assignments by course ID
function get_assignments_by_course($course_id) {
    global $db;
    // If a course ID is provided, fetch assignments for that course
    if ($course_id) {
        $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments A
                  LEFT JOIN courses C ON A.courseID = C.courseID
                  WHERE A.courseID = :courseID ORDER BY A.ID';
    } else {
        // Otherwise, fetch all assignments
        $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments A
                  LEFT JOIN courses C ON A.courseID = C.courseID ORDER BY C.courseID';
    }

    // Prepare and execute the query
    $statement = $db->prepare($query);
    if ($course_id) {
        $statement->bindValue(':courseID', $course_id, PDO::PARAM_INT);
    }
    $statement->execute();
    $assignments = $statement->fetchAll();
    $statement->closeCursor(); // Close the cursor
    return $assignments; // Return the fetched assignments
}

// Delete an assignment by ID
function delete_assignment($assignment_id) {
    global $db;
    $query = 'DELETE FROM assignments WHERE ID = :assignment_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':assignment_id', $assignment_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor(); // Close the cursor
}

// Add a new assignment to a course
function add_assignment($course_id, $description) {
    global $db;
    $query = 'INSERT INTO assignments (courseID, Description) VALUES (:course_id, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id, PDO::PARAM_INT);
    $statement->bindValue(':description', $description, PDO::PARAM_STR);
    $statement->execute();
    $statement->closeCursor(); // Close the cursor
}

// Update an existing assignment
function update_assignment($assignment_id, $description, $course_id) {
    global $db;
    $query = 'UPDATE assignments 
              SET Description = :description, courseID = :course_id 
              WHERE ID = :assignment_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':description', $description, PDO::PARAM_STR);
    $statement->bindValue(':course_id', $course_id, PDO::PARAM_INT);
    $statement->bindValue(':assignment_id', $assignment_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor(); // Close the cursor
}

// Fetch an assignment by ID
function get_assignment_by_id($assignment_id) {
    global $db;
    $query = 'SELECT ID, Description, courseID FROM assignments WHERE ID = :assignment_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':assignment_id', $assignment_id, PDO::PARAM_INT);
    $statement->execute();
    $assignment = $statement->fetch();
    $statement->closeCursor(); // Close the cursor
    return $assignment; // Return the fetched assignment
}

// Fetch all courses for dropdown
function get_all_courses() {
    global $db;
    $query = 'SELECT courseID, courseName FROM courses ORDER BY courseName';
    $statement = $db->prepare($query);
    $statement->execute();
    $courses = $statement->fetchAll();
    $statement->closeCursor(); // Close the cursor
    return $courses; // Return the list of courses
}
?>
