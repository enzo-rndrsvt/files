<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./styles/auth.css">

<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>

    <body>

        <body>
            <div class="container">
                <h1>Connexion</h1>
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['message'])) {
                    echo "<p>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);
                }
                ?>
                <form action="./scripts/userLogin.php" method="POST">
                    <div><input type="text" id="nom" name="nom" placeholder="Nom d'utilisateur" required></div>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div><input type="submit" value="Connexion"></div>
                </form>
            </div>
        </body>

</html>