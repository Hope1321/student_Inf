<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT s.full_name, s.gender, s.dob, s.pob, 
                   a.region, a.zone, a.woreda, a.hometown, 
                   c.phone, d.department_name, co.college_name, e.campus
            FROM Student s
            JOIN Contact c ON s.student_id = c.student_id
            JOIN Address a ON s.student_id = a.student_id
            JOIN Enrollment e ON s.student_id = e.student_id
            JOIN Department d ON e.department_id = d.department_id
            JOIN College co ON e.college_id = co.college_id
            WHERE s.student_id = $id 
              AND d.department_name = 'SENG'
              AND s.gender = 'Male'";

    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        echo "<h2>Details of {$row['full_name']}</h2>
              <table>
                <tr><th>Gender</th><td>{$row['gender']}</td></tr>
                <tr><th>Date of Birth</th><td>{$row['dob']}</td></tr>
                <tr><th>Place of Birth</th><td>{$row['pob']}</td></tr>
                <tr><th>Phone</th><td>{$row['phone']}</td></tr>
                <tr><th>College</th><td>{$row['college_name']}</td></tr>
                <tr><th>Department</th><td>{$row['department_name']}</td></tr>
                <tr><th>Campus</th><td>{$row['campus']}</td></tr>
                <tr><th>Region</th><td>{$row['region']}</td></tr>
                <tr><th>Zone</th><td>{$row['zone']}</td></tr>
                <tr><th>Woreda</th><td>{$row['woreda']}</td></tr>
                <tr><th>Hometown</th><td>{$row['hometown']}</td></tr>
              </table>
              <br><a class='button' href='index.php'>⬅ Back to List</a>";
    } else {
        echo "<p>No matching male student found in SENG department.</p>
              <a class='button' href='index.php'>⬅ Back</a>";
    }
}
?>
</body>
</html>
