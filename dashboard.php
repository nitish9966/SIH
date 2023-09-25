<!-- result.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
            echo "<p class='login-result'>$message</p>";
        }
        ?>
    </div>
</body>
</html>
