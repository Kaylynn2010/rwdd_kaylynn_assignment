<?php
//no email!
//step1 - create connection to ur database
$hostname = 'localhost'; //127.0.0.1 (IP address is optional) 
$username = 'root'; //User: root@localhost from myadmin
$password = ''; // Usually empty in XAMPP, change if needed
$database = 'log_reg_sem4';
$connection = mysqli_connect($hostname, $username, $password, $database);

if($connection === false) {
    die('Connection failed' . mysqli_connect_error());
} else {
    echo 'Connection established<br>';
}

// Sample data for inserting into the table
$email = 'test@example.com';
$password = 'test_password';

//step2 - create SQL commands - SELECT, INSERT, UPDATE, DELETE
// for inserting data
// $query = "SELECT * FROM `user` WHERE 1";
$query = "INSERT INTO `user` (email, password) VALUES (?,?)";

//step3 - execute the query/statement
$stmt = $connection->prepare($query);
$stmt->bind_param("ss", $email, $password); // 'ss' indicates both are strings
if ($stmt->execute()) {
    echo "Registration successful<br>";
    } else {
    echo "Error during registration: " . $stmt->error . "<br>";
    } 
    $stmt->close();
    
} elseif (isset($_POST['login'])) {
    // Login process
    $email = $_POST['email'];
    $password_value = $_POST['password'];

    // Step 2 - Create SQL command for checking login credentials
    $query = "SELECT * FROM `user` WHERE email = ? AND password = ?";

    // Step 3 - Prepare and execute the statement
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $email, $password_value);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Login successful<br>";
    } else {
        echo "Invalid email or password<br>";
    }

    $stmt->close();
}

// $result = $connection->execute_query($query, [$email, $password]);

//step4 - read/display the results


//step5 - close connection
mysqli_close($connection);
?>