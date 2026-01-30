<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Display Result</title>
</head>
<body>
    <h1>Display Student Result</h1>
    
    <form method="POST" action="">
        Enter Roll Number: <input type="text" name="roll_no" required>
        <input type="submit" name="show_result" value="Show Result">
        <a href="index.php">Back to Menu</a>
    </form>
    
    <?php
    if (isset($_POST['show_result'])) {
        $roll_no = $_POST['roll_no'];
        
        $sql = "SELECT s.Name, s.Class, m.M1, m.M2, m.M3 
                FROM Student s 
                JOIN Marks m ON s.Roll_Number = m.Roll_Number 
                WHERE s.Roll_Number = '$roll_no'";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['Name'];
            $class = $row['Class'];
            $m1 = $row['M1'];
            $m2 = $row['M2'];
            $m3 = $row['M3'];
            $total = $m1 + $m2 + $m3;
            
            // Calculate grade
            if ($total > 75) {
                $grade = "Distinction";
            } elseif ($total > 60) {
                $grade = "First Class";
            } elseif ($total > 50) {
                $grade = "Second Class";
            } else {
                $grade = "Fail";
            }
            
            echo "<h3>Result for Roll Number: $roll_no</h3>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Class:</strong> $class</p>";
            echo "<p><strong>Subject 1:</strong> $m1</p>";
            echo "<p><strong>Subject 2:</strong> $m2</p>";
            echo "<p><strong>Subject 3:</strong> $m3</p>";
            echo "<p><strong>Total Marks:</strong> $total</p>";
            echo "<p><strong>Grade:</strong> $grade</p>";
        } else {
            echo "<p style='color:red;'>No student found with Roll Number: $roll_no</p>";
        }
    }
    ?>
</body>
</html>