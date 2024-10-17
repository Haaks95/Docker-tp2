<?php
$servername = "db";
$username = "user";
$password = "user_password";
$dbname = "test_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Créer une table si elle n'existe pas
$sql = "CREATE TABLE IF NOT EXISTS test_table (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    value VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
}

$sql = "INSERT INTO test_table (value) VALUES ('Random value: " . rand(1, 100) . "')";
$conn->query($sql);

$sql = "SELECT value FROM test_table ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Last entry: " . $row["value"] . "<br>";
    }
} else {
    echo "No entries found.";
}

$conn->close();
?>
