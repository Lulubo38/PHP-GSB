<?php
require 'database.php';

$message = '';

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashage du mot de passe

    // Vérification si l'email est déjà utilisé
    $sql = "SELECT id_utilisateur FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $message = 'Cet email est déjà utilisé.';
    } else {
        // Insertion du nouvel utilisateur
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :password)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'password' => $password])) {
            $message = 'Compte créé avec succès.';
        } else {
            $message = 'Erreur lors de la création du compte.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <h2>Créer un compte</h2>
    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    <form action="register.php" method="post">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <button type="submit">S'inscrire</button>
        </div>
    </form>
</div>
</body>
</html>
