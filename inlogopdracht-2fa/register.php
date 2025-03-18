<?php  
// een sessie is een tijdelijke verbinding tussen server en de client
session_start();

//database verbinding
$dsn ='mysql:host=localhost;dbname=login2fa';
$user = 'root';
$pass = '';


use PHPGangsta\PHPGangsta_GoogleAuthenticator;


$ga = new GoogleAuthenticator();
$qrCodeUrl = '';
$secret = '';

if ($_SERVER['REQUEST_METHOD'] === 'post'){
    $username = $_POST['username'];

    $password = password_hash(password: $_POST['password'], algo: PASSWORD_DEFAULT);

    $secret = $g->createSecret();


$pdo = new PDO(dsm: $dsm, username: $user, password: $pass, options: $options);

$stmt = $pdo->prepare(query: 'INSERT INTO users (username, password, 2fa_secret) VALUES (?,?, ?)');

$stmt->exacute(params: [$username, $password, $secret]);


    $sqrCodeUrl = $ga->getQRCodeGoogleUrl('MARLON de coolste', $secret);

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
    <from method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <button type="submit">Register</button>
    </from>

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