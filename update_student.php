<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Student Details & Marks</title>
</head>
<body>
    <h1>Update Student Details & Marks</h1>
    
    <form method="POST" action="">
        Enter Roll Number: <input type="text" name="roll_no" required>
        <input type="submit" name="fetch_data" value="Load Student Data">
        <a href="index.php">Back to Menu</a>
    </form>
    
    <?php
    // Fetch student data
    if (isset($_POST['fetch_data'])) {
        $roll_no = $_POST['roll_no'];
        
        // Get student info
        $sql_student = "SELECT * FROM Student WHERE Roll_Number = '$roll_no'";
        $student_result = $conn->query($sql_student);
        
        if ($student_result->num_rows > 0) {
            $student = $student_result->fetch_assoc();
            
            // Get marks info
            $sql_marks = "SELECT * FROM Marks WHERE Roll_Number = '$roll_no'";
            $marks_result = $conn->query($sql_marks);
            $marks = $marks_result->fetch_assoc();
            ?>
            
            <h2>Update Student Details</h2>
            <form method="POST" action="">
                <input type="hidden" name="roll_no" value="<?php echo $roll_no; ?>">
                Name: <input type="text" name="name" value="<?php echo $student['Name']; ?>" required><br><br>
                Class: <input type="text" name="class" value="<?php echo $student['Class']; ?>" required><br><br>
                Date of Birth: <input type="date" name="dob" value="<?php echo $student['DOB']; ?>" required><br><br>
                Contact No: <input type="text" name="contact" value="<?php echo $student['Contact_No']; ?>" required><br><br>
                <input type="submit" name="update_personal" value="Update Personal Info">
            </form>
            
            <h2>Update Marks</h2>
            <form method="POST" action="">
                <input type="hidden" name="roll_no" value="<?php echo $roll_no; ?>">
                Subject 1: <input type="number" name="m1" value="<?php echo $marks['M1']; ?>" required><br><br>
                Subject 2: <input type="number" name="m2" value="<?php echo $marks['M2']; ?>" required><br><br>
                Subject 3: <input type="number" name="m3" value="<?php echo $marks['M3']; ?>" required><br><br>
                <input type="submit" name="update_marks" value="Update Marks">
            </form>
            
            <?php
        } else {
            echo "<p style='color:red;'>No student found with Roll Number: $roll_no</p>";
        }
    }
    
    // Update Personal Info
    if (isset($_POST['update_personal'])) {
        $roll_no = $_POST['roll_no'];
        $name = $_POST['name'];
        $class = $_POST['class'];
        $dob = $_POST['dob'];
        $contact = $_POST['contact'];
        
        $sql = "UPDATE Student SET Name='$name', Class='$class', DOB='$dob', Contact_No='$contact' WHERE Roll_Number='$roll_no'";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green;'>Personal information updated successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error updating: " . $conn->error . "</p>";
        }
    }
    
    // Update Marks
    if (isset($_POST['update_marks'])) {
        $roll_no = $_POST['roll_no'];
        $m1 = $_POST['m1'];
        $m2 = $_POST['m2'];
        $m3 = $_POST['m3'];
        
        // Check if marks exist
        $check_sql = "SELECT * FROM Marks WHERE Roll_Number = '$roll_no'";
        $check_result = $conn->query($check_sql);
        
        if ($check_result->num_rows > 0) {
            $sql = "UPDATE Marks SET M1='$m1', M2='$m2', M3='$m3' WHERE Roll_Number='$roll_no'";
        } else {
            $sql = "INSERT INTO Marks (Roll_Number, M1, M2, M3) VALUES ('$roll_no', '$m1', '$m2', '$m3')";
        }
        
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green;'>Marks updated successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error updating marks: " . $conn->error . "</p>";
        }
    }
    ?>
</body>
</html>