<?php 
session_start();

//Configuration et connexion à la base de données
$host = 'db';
$db = 'mydatabase';
$user = 'user';
$pass = 'password';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES => false,
];
try {
$pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
die("Erreur de connexion à la base de données: ".$e->getMessage());
}


/*Ces fonctions sont utilisées pour que le carousel d'image de la page princiapale et la liste d'activité prennent 
leurs données de la base de données */

function selectActivityFromBase($index, $coloumn, $base){
    $row =  $base->query("SELECT * FROM activities WHERE id='$index'")->fetch(PDO::FETCH_ASSOC);
    echo $row[$coloumn];   
}

function getFromActivity($index, $base, $link, $second_table, $attribute){
    $activity = $base->query("SELECT * FROM activities WHERE id = $index")->fetch(PDO::FETCH_ASSOC);
    $number = $activity[$link];
    $coach_row = $base->query("SELECT * FROM $second_table WHERE id = $number")->fetch(PDO::FETCH_ASSOC);
    echo $coach_row[$attribute];
}


//Ces fonctions sont utilisées pour que les filtres affichent des options basées suir la base de données
function getNameFromTable($index, $base, $table) {
    $row = $base->query("SELECT * FROM $table WHERE id = $index")->fetch(PDO::FETCH_ASSOC);
    return $row["name"];
}

function getTableLenght($table, $base){
    $row =  $base->query("SELECT * FROM $table ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    return $row["id"];
}

function createOptionFilter($table, $base){
    $i = 0;
    for($i = 1; $i < getTableLenght($table, $base) + 1; $i = $i + 1) {
        $name = getNameFromTable($i, $base, $table);
        echo "<option value=$name>$name</option>";
    }
}


?>