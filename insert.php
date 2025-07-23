<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $pob = $_POST['pob'];
    $phone = $_POST['phone'];
    $region = $_POST['region'];
    $zone = $_POST['zone'];
    $woreda = $_POST['woreda'];
    $hometown = $_POST['hometown'];
    $department_id = $_POST['department_id'];
    $college_id = $_POST['college_id'];
    $campus = $_POST['campus'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert into Student
        $stmt1 = $conn->prepare("INSERT INTO Student (full_name, gender, dob, pob) VALUES (?, ?, ?, ?)");
        $stmt1->bind_param("ssss", $full_name, $gender, $dob, $pob);
        $stmt1->execute();
        $student_id = $stmt1->insert_id;

        // Contact
        $stmt2 = $conn->prepare("INSERT INTO Contact (student_id, phone) VALUES (?, ?)");
        $stmt2->bind_param("is", $student_id, $phone);
        $stmt2->execute();

        // Address
        $stmt3 = $conn->prepare("INSERT INTO Address (student_id, region, zone, woreda, hometown) VALUES (?, ?, ?, ?, ?)");
        $stmt3->bind_param("issss", $student_id, $region, $zone, $woreda, $hometown);
        $stmt3->execute();

        // Enrollment
        $stmt4 = $conn->prepare("INSERT INTO Enrollment (student_id, department_id, college_id, campus) VALUES (?, ?, ?, ?)");
        $stmt4->bind_param("iiis", $student_id, $department_id, $college_id, $campus);
        $stmt4->execute();

        // Commit all
        $conn->commit();
        echo "<script>alert('Student added successfully!'); window.location.href='index.php';</script>";

    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
