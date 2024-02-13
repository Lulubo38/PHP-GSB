<?php
session_start();

require 'database.php';
 if (isset($_SESSION['user_id'])) { 
    header('Location: dashboard.php');
    exit;
 }

 $errormessage = 'error';

 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour vérifier si l'utilisateur existe
    $sql = "SELECT id_utilisateur, email, mot_de_passe FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    // Exécution de la requête
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        // Si les identifiants sont corrects, démarrage de la session
        $_SESSION['user_id'] = $user['id_utilisateur'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: dashboard.php"); // Redirection vers le tableau de bord
        exit;
    } else {
        $errorMessage = 'Email ou mot de passe incorrect.';
    }
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour vérifier si l'utilisateur existe
    $sql = "SELECT id_utilisateur, email, mot_de_passe FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    // Exécution de la requête
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        // Si les identifiants sont corrects, démarrage de la session
        $_SESSION['user_id'] = $user['id_utilisateur'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: dashboard.php"); // Redirection vers le tableau de bord
        exit;
    } else {
        $errorMessage = 'Email ou mot de passe incorrect.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Crée un compte</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>utiliser un mail pour ce connecter</span>
                <input type="text" placeholder="Nom">
                <input type="email" placeholder="Email">
                <input type="Mot de Passe" placeholder="Mot de Passe">
                <button>S'inscrire</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form>
                <h1>Se connecter</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ou utiliser un mail et mot de passe</span>
                <input type="email" placeholder="Email">
                <input type="Mot de Passe" placeholder="Mot de Passe">
                <a href="#">Mot de Passe oublié?</a>
                <button>Se connecter</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>De Retour</h1>
                    <p>Indiquer vos informations personnel pour accedes au site</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Salut l'ami</h1>
                    <p>Indiquer vos informations personnel pour accedes au site</p>
                    <button class="hidden" id="register">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>