<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reddit</title>
    <link href="css/forms.css" rel="stylesheet">
</head>

<body>
    <div class="login">
        <form class="login_content" action="action_login.php" method="post">
            <div class="title_container">
                <h1 class="login-form-title">Login</h1>
            </div>

            <div class="input_container">
                <input type="text" placeholder="Enter username" name="username" required>
            </div>

            <div class="input_container">
                <input type="password" placeholder="Enter password" name="password" required>
            </div>

            <div class="input_container">
                <button type="submit">Login</button>
            </div>
            
            <?php if (isset($_GET['error'])) {
                echo "<p>" . $error = $_GET['error'] . "</p>";
            } ?>
        </form>
    </div>

</body>

</html>