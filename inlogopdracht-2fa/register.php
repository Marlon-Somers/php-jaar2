<?php  
// een sessie is een tijdelijke verbinding tussen server en de client
session_start();

//database verbinding
$dsn ='mysql:host=localhost;dbname=login2fa';
$user = 'root';
$pass = '';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false];

include 'GoogleAuthenticator.php';

use PHPGangsta\GoogleAuthenticator;



$ga = new GoogleAuthenticator();
$qrCodeUrl = '';
$secret = '';



if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    echo "test";

    $username = $_POST['username'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $secret = $ga->createSecret();

// verbind met de database
$pdo = new PDO($dsn, $user, $pass, $options);

 // voeg de gebruiker toe aan de database
$stmt = $pdo->prepare('INSERT INTO users (username, password, 2fa_secret) VALUES (?, ?, ?)');
$stmt->execute([$username, $password, $secret]);


    $qrCodeUrl = $ga->getQRCodeGoogleUrl('MARLON de coolste', $secret);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <H1>Register</H1>
    <form method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <button type="submit">Register</button>
    </form>

 <!-- Maak een if functie die alleen verder als er een QR code is gegenereerd. -->
 <?php if ($qrCodeUrl): ?>

<h3>Registratie succesvol! Scan deze QR code met Google Authenticator:</h3>

<!-- maak een afbeelding met de QR code. -->
<img src="<?php echo $qrCodeUrl; ?>" alt="QR Code"><br>

<!-- Toon de secret key. -->
<p>Sla de geheime sleutel op: <?php echo $secret; ?></p>

<?php endif; ?>

<a href="login.php">Login</a>
</body>
</html>