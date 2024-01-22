<?php
include "./db.php";


/**
 * Ziskání celkový počet otázek
 */


$query = "SELECT * FROM questions";

// Výsledek

$result = $conn -> query($query) or die($conn -> error.__LINE__);

$total = $result -> num_rows;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Biblický Kvíz</title>
</head>
<body>
    <header>
        <div class="container">
            <h1>Biblický Kvíz</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Vyzkoušejte své Biblické znalosti</h2>
            <p> Toto je vícevýběrový test Biblických znalostí</p>
            <ul>
                <li><strong>Počet otázek:</strong> <?php echo $total; ?></li>
                <li><strong>Typ:</strong> Více výběrů</li>
                <li><strong>Čas k otázkám:</strong> <?php echo $total * .5; ?> minut</li>
            </ul>
            <a href="question.php?n=1" class="start">Začni Kvíz</a>
            <a href="add.php" class="start">Vlož otázku</a>
        </div>
    </main>
    <footer>
        <div class="container">
            Copyright &copy; 2023 Vladimír Kochan
        </div>
    </footer>
</body>
</html>