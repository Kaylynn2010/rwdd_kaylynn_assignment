<?php
//no email!
// Step 1 - Create connection to your database
$hostname = 'localhost'; // 127.0.0.1 (IP address is optional)
$username = 'root'; // User: root@localhost from myadmin
$password = ''; // Usually empty in XAMPP, change if needed
$database = 'log_reg_sem4';
$connection = mysqli_connect($hostname, $username, $password, $database);

if ($connection === false) {
    die('Connection failed: ' . mysqli_connect_error());
} else {
    echo 'Connection established<br>';
}

// Check if the form is submitted for registration or login
if (isset($_POST['register'])) {
    // Registration process
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Step 2 - Create SQL command for inserting data
    $query = "INSERT INTO `user` (`UserID`, `Username`, `Email`, `Password`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')";

    // Step 3 - Prepare and execute the statement
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
    $password = $_POST['password'];

    // Step 2 - Create SQL command for checking login credentials
    $query = "SELECT * FROM `user` WHERE UserID = [value-1] AND Username = [value-2] AND Email = [value-3] AND Password = [value-4]";

    // Step 3 - Prepare and execute the statement
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Login successful<br>";
    } else {
        echo "Invalid email or password<br>";
    }

    $stmt->close();
}

// Step 5 - Close the connection
mysqli_close($connection);
?>
