<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize user inputs as needed

    // Create a connection to the database (adjust credentials as needed)
    $conn = new mysqli("localhost", "root", "", "register_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $insert_query = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ss", $email, $hashedPassword);

    if ($stmt->execute()) {
        echo '<div class="success-container">
        <p class="success-message">Registration successful. You can now <a class="login-link" href="login.php">log in</a>.</p>
      </div>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* CSS for the Registration Success Message */
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #3498db, #8e44ad);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}

.success-container {
    background-color: #06f364;
    color: #fff;
    text-align: center;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    transform: scale(0.9); /* Initial scale for animation */
    animation: scaleUp 0.5s ease-in-out forwards; /* Scale up animation */
}

@keyframes scaleUp {
    0% {
        opacity: 0;
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.success-message {
    font-size: 24px;
    margin-bottom: 20px;
}

.login-link {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    border: 1px solid #fff;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.2s ease;
    display: inline-block;
}

.login-link:hover {
    background-color: #057aff;
    transform: scale(1.05);
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    .success-container {
        width: 90%; /* Adjust width for smaller screens */
    }
}

</style>
<body>
    
</body>
</html>