class utilisateur {
require_once "../config/database.php"
try {
$dsn = "mysql:host=$host; dbname = $db";
$pdo = new PDO($dsn, $user, $pw);
}catch (PDOException $e){
die();
}



}