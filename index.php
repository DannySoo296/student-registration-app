<!DOCTYPE html>
<html>
<head>
    <title>Student Registration System</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        .container { max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; margin: 5px 0 15px 0; }
        input[type="submit"] { background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        input[type="submit"]:hover { background: #45a049; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<div class="container">
    <h1>📚 Student Registration</h1>
    
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<div class='error'>Connection failed: " . $conn->connect_error . "</div>");
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $course = $_POST['course'];
        
        $sql = "INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<div class='success'>✅ Registration successful for " . $name . "!</div>";
        } else {
            echo "<div class='error'>❌ Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }
    ?>
    
    <form method="POST" action="">
        <label>Student Name:</label>
        <input type="text" name="name" required>
        
        <label>Email Address:</label>
        <input type="email" name="email" required>
        
        <label>Course:</label>
        <input type="text" name="course" required>
        
        <input type="submit" value="Register Student">
    </form>
    
    <hr>
    
    <h3>📋 Registered Students</h3>
    <?php
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row['name'] . " - " . $row['email'] . " (" . $row['course'] . ")</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No students registered yet.</p>";
    }
    
    $conn->close();
    ?>
</div>

</body>
</html>