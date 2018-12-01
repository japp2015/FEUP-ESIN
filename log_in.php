<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Polícia Nacional</title>
    <link href="log_in_style.css" rel="stylesheet">
</head>

<header> 
    <div class="title_container">
        <a href="public.php"><h1 class="login-form-title">Polícia Nacional</h1></a>
    </div>
</header>

<body>
    <div class="logIn">
        <form class="login_content" action="action_log_in.php" method="post">

            <div class="input_container">
                <input type="text" placeholder="Utilizador" name="username" required>
            </div>

            <div class="input_container">
                <input type="password" placeholder="Senha" name="password" required>
            </div>

            <div class="input_container_btn">
                <button type="submit" class="btn">Entrar</button>
            </div>
        </form>
        <div class="error">
            <?php if (isset($_GET['error'])) {
                    echo "<p>" . $error = $_GET['error'] . "</p>";
            } ?>
        </div>
    </div>

</body>

</html>