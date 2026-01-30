<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert New Student</title>
</head>
<body>
    <h1>Insert New Student</h1>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $class = $_POST['class'];
        $dob = $_POST['dob'];
        $contact = $_POST['contact'];
        $m1 = $_POST['m1'];
        $m2 = $_POST['m2'];
        $m3 = $_POST['m3'];
        
        // Insert into Student table
        $sql1 = "INSERT INTO Student (Name, Class, DOB, Contact_No) VALUES ('$name', '$class', '$dob', '$contact')";
        
        if ($conn->query($sql1) === TRUE) {
            $roll_number = $conn->insert_id;
            
            // Insert into Marks table
            $sql2 = "INSERT INTO Marks (Roll_Number, M1, M2, M3) VALUES ('$roll_number', '$m1', '$m2', '$m3')";
            
            if ($conn->query($sql2) === TRUE) {
                echo "<p style='color:green;'>Student inserted successfully! Roll Number: $roll_number</p>";
            } else {
                echo "<p style='color:red;'>Error inserting marks: " . $conn->error . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Error inserting student: " . $conn->error . "</p>";
        }
    }
    ?>
    
    <form method="POST" action="">
        <h3>Personal Information</h3>
        Name: <input type="text" name="name" required><br><br>
        Class: <input type="text" name="class" required><br><br>
        Date of Birth: <input type="date" name="dob" required><br><br>
        Contact No: <input type="text" name="contact" required><br><br>
        
        <h3>Marks</h3>
        Subject 1: <input type="number" name="m1" min="0" max="100" required><br><br>
        Subject 2: <input type="number" name="m2" min="0" max="100" required><br><br>
        Subject 3: <input type="number" name="m3" min="0" max="100" required><br><br>
        
        <input type="submit" value="Insert Student">
        <a href="index.php">Back to Menu</a>
    </form>
</body>
</html>