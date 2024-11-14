<?php
include("includes/config.php");

$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Skapa tabell
$sql = "
    DROP TABLE IF EXISTS contestants;
    CREATE TABLE contestants(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    email VARCHAR(128) NOT NULL,
    catname VARCHAR(64) NOT NULL,
    breed VARCHAR(64) NOT NULL,
    regdate timestamp NOT NULL DEFAULT current_timestamp()
);";

// Skicka SQL-frågan till server
if ($db->multi_query($sql)) {
    echo "Tabell skapad ok!";
} else {
    echo "Fel vid skapande av tabell!";
}