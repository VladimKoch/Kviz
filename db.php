<?php

/*-----------------------------------------
            Spojení s databází
------------------------------------------*/

$server="localhost";
$user="Vlada89";
$pass="Tyr2017";
$name = "kviz";


$conn = new mysqli($server,$user,$pass,$name);
 
/*----------- Kontrola chyby --------------*/

if ($conn -> connect_errno){
    die('Prihlašeni k databazi se nezdařilo: ' . $conn->connect_errno);
    exit();
}

// else{
//    echo 'Spojeni s databází proběhlo úspěšně';
// }

/*--------------------------------------------------
             SQL dotaz, tvroba tabulky
----------------------------------------------------*/
 $db_questions =

    "CREATE TABLE IF NOT EXISTS questions(
    question_number bigint (20) NOT NULL,
    text text NOT NULL,
    PRIMARY KEY (question_number))";

$db_choices =

    "CREATE TABLE IF NOT EXISTS choices(
        ID bigint(20) NOT NULL AUTO_INCREMENT,
        question_number INT (20) NOT NULL,
        is_correct TINYINT (1) NOT NULL DEFAULT 0,
        text text NOT NULL,
        PRIMARY KEY (ID))";

/*----------------- Kontrola zda tabulka existuje -----------------*/
    if ($conn -> query($db_questions) && $conn->query($db_choices) === TRUE) {
        // print("<br> Tabulky byly vytvořeny");
    }

?>