<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'students_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get exam title from POST request
$examTitle = $_POST['exam_title'];

// Prepare SQL query based on the selected exam title
$query = "SELECT reg_students.first_name, reg_students.roll_number, reg_students.stream, results_tb.percentage
          FROM reg_students
          INNER JOIN results_tb ON reg_students.id = results_tb.student_id
          INNER JOIN exams ON exams.id = results_tb.exam_id
          WHERE exams.title = ?";

// Initialize statement
$stmt = $conn->prepare($query);

// Check if prepare failed
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("s", $examTitle);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Check if any records found
if ($result->num_rows > 0) {
    $rank = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rank++ . "</td>";
        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['roll_number']) . "</td>";
        echo "<td>" . htmlspecialchars($row['stream']) . "</td>";
        echo "<td>" . htmlspecialchars($row['percentage']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No records found.</td></tr>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
