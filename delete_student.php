<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
</head>
<body>
    <h1>Delete Student Record</h1>
    
    <form method="POST" action="">
        Enter Roll Number: <input type="text" name="roll_no" required>
        <input type="submit" name="delete" value="Delete Student">
        <a href="index.php">Back to Menu</a>
    </form>
    
    <?php
    if (isset($_POST['delete'])) {
        $roll_no = $_POST['roll_no'];
        
        // First check if student exists
        $check_sql = "SELECT Name FROM Student WHERE Roll_Number = '$roll_no'";
        $check_result = $conn->query($check_sql);
        
        if ($check_result->num_rows > 0) {
            $student = $check_result->fetch_assoc();
            $student_name = $student['Name'];
            
            // Show confirmation
            echo "<p>Are you sure you want to delete student: <strong>$student_name</strong> (Roll No: $roll_no)?</p>";
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='roll_no' value='$roll_no'>";
            echo "<input type='hidden' name='confirmed' value='1'>";
            echo "<input type='submit' name='confirm_delete' value='Yes, Delete'>";
            echo "<button type='button' onclick='window.history.back()'>Cancel</button>";
            echo "</form>";
        } else {
            echo "<p style='color:red;'>No student found with Roll Number: $roll_no</p>";
        }
    }
    
    // Handle confirmed deletion
    if (isset($_POST['confirm_delete'])) {
        $roll_no = $_POST['roll_no'];
        
        // Delete student (marks will be deleted automatically due to foreign key constraint)
        $sql = "DELETE FROM Student WHERE Roll_Number = '$roll_no'";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green;'>Student record (Roll No: $roll_no) deleted successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error deleting student: " . $conn->error . "</p>";
        }
    }
    ?>
</body>
</html>