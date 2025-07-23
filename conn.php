<?php
$host = "localhost";
$user = "root";
$pass = ""; // Default XAMPP password is empty

// Step 1: Create connection (no DB yet)
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Create database
$sql = "CREATE DATABASE IF NOT EXISTS HUSCMS";
if ($conn->query($sql) === TRUE) {
    echo "Database HUSCMS created successfully.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

$conn->select_db("HUSCMS");

// Step 3: Create all tables
$table_sql = "
CREATE TABLE IF NOT EXISTS Student (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    dob DATE,
    pob VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS Contact (
    contact_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    phone VARCHAR(20) UNIQUE NOT NULL,
    FOREIGN KEY (student_id) REFERENCES Student(student_id)
);

CREATE TABLE IF NOT EXISTS Address (
    address_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    region VARCHAR(50),
    zone VARCHAR(50),
    woreda VARCHAR(50),
    hometown VARCHAR(100),
    FOREIGN KEY (student_id) REFERENCES Student(student_id)
);

CREATE TABLE IF NOT EXISTS Department (
    department_id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS College (
    college_id INT AUTO_INCREMENT PRIMARY KEY,
    college_name VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS Enrollment (
    student_id INT PRIMARY KEY,
    department_id INT,
    college_id INT,
    campus VARCHAR(100),
    FOREIGN KEY (student_id) REFERENCES Student(student_id),
    FOREIGN KEY (department_id) REFERENCES Department(department_id),
    FOREIGN KEY (college_id) REFERENCES College(college_id)
);
";

if ($conn->multi_query($table_sql)) {
    echo "Tables created successfully.<br>";
    while ($conn->more_results() && $conn->next_result()) {} // Clear results
} else {
    die("Error creating tables: " . $conn->error);
}

// Step 4: Insert sample data
$insert_sql = "
INSERT INTO Department (department_name) VALUES 
('SENG'), ('CIVIL'), ('MED'), ('LAW');

INSERT INTO College (college_name) VALUES 
('CCI'), ('CHMS'), ('CE'), ('CLA');

INSERT INTO Student (full_name, gender, dob, pob) VALUES
('Ujulu Obang', 'Male', '2002-03-15', 'Gambella'),
('Parastamol PainKiller', 'Female', '2001-11-22', 'Dire Dawa'),
('Firomsa Abdisa', 'Male', '2003-01-18', 'Nekemte'),
('Birke Kebede', 'Female', '2002-07-12', 'Bahir Dar'),
('Abduljebar Hussein', 'Male', '2001-09-09', 'Harar');

INSERT INTO Contact (student_id, phone) VALUES
(1, '0945789658'),
(2, '0789653252'),
(3, '0912345678'),
(4, '0923456789'),
(5, '0934567890');

INSERT INTO Address (student_id, region, zone, woreda, hometown) VALUES
(1, 'Gambella', 'Anuak Zone', 'Abobo', 'Abobo Town'),
(2, 'Harari', 'Harari Zone', 'Harar City', 'Jugal'),
(3, 'Oromia', 'East Wollega', 'Nekemte', 'Nekemte Town'),
(4, 'Amhara', 'West Gojjam', 'Bahir Dar', 'Tana Area'),
(5, 'Harari', 'Harar City', 'Jugol', 'Sheikh Abadir');

INSERT INTO Enrollment (student_id, department_id, college_id, campus) VALUES
(1, 1, 1, 'MAIN'),
(2, 3, 2, 'HARAR'),
(3, 1, 1, 'MAIN'),
(4, 4, 4, 'MAIN'),
(5, 1, 1, 'HARAR');
";

if ($conn->multi_query($insert_sql)) {
    echo "Sample data inserted successfully.";
} else {
    die("Error inserting data: " . $conn->error);
}

$conn->close();
?>
