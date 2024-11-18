<?php
// Vérifier si l'utilisateur est connecté
require 'scripts/bdd.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$uploadDir = 'uploads/';

// Gérer la suppression d'un fichier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_file'])) {
    $fileToDelete = $uploadDir . basename($_POST['delete_file']);
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Fichier introuvable.<br>";
    }
}

// Gérer l'upload d'un fichier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME); // Nom du fichier sans extension
    $originalExtension = pathinfo($file['name'], PATHINFO_EXTENSION); // Extension du fichier

    $newName = !empty($_POST['filename']) ? $_POST['filename'] : $originalName;
    $baseName = $newName; // Sauvegarde du nom de base sans suffixe
    $filePath = $uploadDir . $newName . '.' . $originalExtension;

    // Vérifier si le fichier existe déjà et ajouter un suffixe si nécessaire
    $counter = 1;
    while (file_exists($filePath)) {
        $newName = $baseName . " ($counter)";
        $filePath = $uploadDir . $newName . '.' . $originalExtension;
        $counter++;
    }

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Erreur lors du téléchargement.<br>";
    }
}

// Récupérer les fichiers existants
$files = array_diff(scandir($uploadDir), ['.', '..']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Gestion des Fichiers</title>
</head>

<body>
    <div id="main-container">
        <div id="sidebar">
            <h2>Fichiers disponibles :</h2>
            <?php
            foreach ($files as $file) {
                echo "<div class='file-item'>
                    <a href='$uploadDir$file' target='_blank'>$file</a>
                    <form method='POST' class='delete-form'>
                        <input type='hidden' name='delete_file' value='$file'>
                        <button type='submit'>
                            <i class='fas fa-trash-alt'></i>
                        </button>
                    </form>
                  </div>";
            }
            ?>
        </div>
        <div id="content">
            <form id="uploadForm" enctype="multipart/form-data" method="POST">
                <label for="file">Fichier :</label>
                <input type="file" name="file" id="file" required>
                <br>
                <label for="filename">Nom personnalisé (optionnel) :</label>
                <input type="text" name="filename" id="filename">
                <br>
                <button type="submit">Uploader</button>
            </form>
        </div>
    </div>
</body>

</html>