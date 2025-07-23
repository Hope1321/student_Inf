<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Student</title>
    <link rel="stylesheet" href="style.css">
    <style>
        form {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }
        .submit-btn {
            margin-top: 20px;
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Add New Student</h2>
    <form action="insert.php" method="POST">
        <label>Full Name</label>
        <input type="text" name="full_name" required>

        <label>Gender</label>
        <select name="gender" required>
            <option value="">-- Select --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label>Date of Birth</label>
        <input type="date" name="dob">

        <label>Place of Birth</label>
        <input type="text" name="pob">

        <label>Phone</label>
        <input type="text" name="phone" required>

        <label>Region</label>
       <select name="region" id="region_12" >
        
       </select>
    
        <label>Zone</label>
        <input type="text" name="zone">

        <label>Woreda</label>
        <input type="text" name="woreda">

        <label>Hometown</label>
        <input type="text" name="hometown">

        <label>Department</label>
        <select name="department_id" required>
            <?php
            $dep = $conn->query("SELECT * FROM Department");
            while($d = $dep->fetch_assoc()){
                echo "<option value='{$d['department_id']}'>{$d['department_name']}</option>";
            }
            ?>
        </select>

        <label>College</label>
        <select name="college_id" required>
            <?php
            $col = $conn->query("SELECT * FROM College");
            while($c = $col->fetch_assoc()){
                echo "<option value='{$c['college_id']}'>{$c['college_name']}</option>";
            }
            ?>
        </select>

        <label>Campus</label>
        <input type="text" name="campus" required>

        <button class="submit-btn" type="submit">Add Student</button>
    </form>
</body>
</html>
