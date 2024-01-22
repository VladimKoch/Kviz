<?php

include './db.php';


session_start();

// Kontrola jestli skoré je nastavené

if (!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}

if ($_GET['final.php']){
    $_SESSION['score'] = session_unset();
}

//kontrola zda byl potvrzen submit

if ($_POST){
    $question_number = $_POST['number'];
    $selected_choice = $_POST['choice'];

    $next = $question_number +1 ;


    /**
     * Získánní celkový počet otázek
     */

     $query = "SELECT * FROM questions";

    // Výsledek

    $result = $conn -> query($query) or die($conn -> error.__LINE__);

    $total = $result -> num_rows;

    /**
     * Získej správnou odpověď
     */

    $query2 = "SELECT * from `choices` where question_number = $question_number AND is_correct = 1";

    $resultCorrect = $conn -> query($query2) or die($conn -> error.__LINE__);

    // získání řádku

    $correctAnswer = $resultCorrect -> fetch_assoc();

    print_r($correctAnswer);

    //nastavení správne odpovědi

    $correct_choice = $correctAnswer['ID'];

    // Porovnání
    If ($correct_choice == $selected_choice){
        // Odpověď je správná
        $_SESSION['score'] = $_SESSION['score'] + 1 ; 

        print_r ($_SESSION['score']);
    }

        // Kontrola poslední otázky
    if ($question_number == $total){
        header("Location: final.php");
    }

    else {
        header("Location: question.php?n=".$next);
    }

} 


?>