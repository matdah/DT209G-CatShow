<?php
$sitename = "PHP-Demo";
$divider = " | ";

$devMode = false;

if ($devMode) {
    // Aktivera felmeddelanden
    error_reporting(-1);
    ini_set("display_errors", 1);
}

// Aktivera stöd för att inkludera klassfiler automatiskt
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php';
});

if ($devMode) {
    // Lokala databasinställningar
    define("DBHOST", "localhost");
    define("DBUSER", "catshow");
    define("DBPASS", "password");
    define("DBDATABASE", "catshow");
} else {
    define("DBHOST", "localhost");
    define("DBUSER", "catshow");
    define("DBPASS", "password");
    define("DBDATABASE", "catshow");
}