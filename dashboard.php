<?php
session_start(); // Démarrage de la session

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirection vers la page de connexion si non connecté
    exit;
}

// Inclusion du fichier de connexion à la base de données
require 'database.php';

// Récupération des informations de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Vous pouvez ici ajouter des requêtes pour récupérer d'autres informations nécessaires pour le tableau de bord
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="style.css"> <!-- Assurez-vous d'avoir un fichier CSS pour les styles -->
</head>
<body>
    <div class="dashboard-container">
        <h1>Bienvenue sur le tableau de bord</h1>
        <p>Voici votre espace personnel où vous pouvez gérer les stocks, consulter les commandes, et plus encore.</p>
        <!-- Ici, vous pouvez ajouter des liens ou des fonctionnalités spécifiques à votre application -->
        <a href="logout.php">Déconnexion</a>
    </div>
</body>
</html>
