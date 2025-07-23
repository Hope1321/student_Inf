<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Male SENG Students</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .top-button {
            margin-bottom: 20px;
            text-align: right;
        }

        .add-btn {
            background-color: #198754;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .add-btn:hover {
            background-color: #157347;
        }
    </style>
</head>
<body>
    <h1> Haramaya University student Details Information </h1>
    <h2>Male Students in Software Engineering (SENG)</h2>

    <div class="top-button">
        <a class="add-btn" href="add.php">+ Add New Student</a>
    </div>

    <table>
        <tr>
            <th>Full Name</th>
            <th>College</th>
            <th>Department</th>
            <th>Campus</th>
            <th>Gender</th>
            <th>Phone</th>
            <th> <details></details> Action</th>
        </tr>
        <?php
        $sql = "SELECT s.student_id, s.full_name, s.gender, c.phone,
                       d.department_name, co.college_name, e.campus
                FROM Student s
                JOIN Contact c ON s.student_id = c.student_id
                JOIN Enrollment e ON s.student_id = e.student_id
                JOIN Department d ON e.department_id = d.department_id
                JOIN College co ON e.college_id = co.college_id
                WHERE s.gender = 'Male' AND d.department_name = 'SENG'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['full_name']}</td>
                        <td>{$row['college_name']}</td>
                        <td>{$row['department_name']}</td>
                        <td>{$row['campus']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['phone']}</td>
                        <td><a class='button' href='detail.php?id={$row['student_id']}'>Detail</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No male students found in SENG department.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
