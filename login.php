<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form class="login-form" action="" method="POST">
            <h2>Login</h2>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Create a connection to the database (adjust credentials as needed)
            $conn = new mysqli("localhost", "root", "", "register_db");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve user data from the database based on the provided email
            $select_query = "SELECT * FROM users WHERE email=?";
            $stmt = $conn->prepare($select_query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row["password"];

                // Verify the password
                if (password_verify($password, $hashedPassword)) {
                    echo "<p class='login-success'>Login successful. Welcome!<div class='container'>
                    <a href='dashboard.html'><button>DashBoard</button></a>
                    </div></p>";
                } else {
                    echo "<p class='login-error'>Invalid password. Please try again.</p>";
                }
            } else {
                echo "<p class='login-error'>Email not found. Please register first.<div class='container'>
                <a href='signup.html'><button>Register</button></a>
                </div></p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>

    </div>
</body>
</html>
