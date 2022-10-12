<?php
// session_start(['cookie_lifetime' => 3600,]);

// Fonction permettant de faire la connection à la base de donnée

// function connectDB()

// {
//     $dbServer = "hhva.myd.infomaniak.com";
//     $dbName = "hhva_t23_7_v2";
//     $dbUser = "hhva_t23_7_v2";
//     $dbPwd = "3StNYEXg43";

//     static $bdd = null;

//     if ($bdd === null) {
//         $bdd = new PDO("mysql:host=$dbServer;dbname=$dbName;charset=utf8", $dbUser, $dbPwd);
//         $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     }
//     return $bdd;
// }



function connectDB() //fonction qui permet de se connecter à la BDD
{
    $dbServer = "localhost";
    $dbName = "hhva_t23_7_v2";
    $dbUser = "root";
    $dbPwd = "";

    static $bdd = null;

    if ($bdd === null) {
        $bdd = new PDO("mysql:host=$dbServer;dbname=$dbName;charset=utf8", $dbUser, $dbPwd);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $bdd;
}
