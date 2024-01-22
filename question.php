<?php 

include "./db.php"; // propojení s databází
session_start();

/**
 * Celkový počet otázek
 */

 $query = "SELECT * FROM questions";

// Výsledek

$result = $conn -> query($query) or die($conn -> error.__LINE__);

$total = $result -> num_rows;

//nastavení čísla otázky

$number = (int) $_GET['n'];

/**
 * Ziskej otázku
 */

$query1 = "SELECT * FROM questions WHERE question_number = $number";

//výsledek

$result = $conn -> query($query1) or die($conn -> error.__LINE__);

$question = $result -> fetch_assoc();




/**
 * Získej odpovědi
 */

 $query2 = "SELECT * FROM choices WHERE question_number = $number";

 //výsledek
 
 $choices = $conn -> query($query2) or die($conn -> error.__LINE__);
 




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
            <div class="current">Otázka <?php echo $number;?> z <?php echo $total;?></div>
            <p class="question">
                <!-- Vypsání zadaání otázky z databáze -->
                <?php echo $question['text'];?>
            </p>
            <form action="proccess.php" method="POST">
                <ul class="choices">
                    <!-- Vypsání odpovědí z databáze -->
                    <?php while ($row = $choices -> fetch_assoc()) : ?>
                    <li><input type="radio" name="choice" value="<?php print_r($row['ID']);?>"><?php echo $row['text'];?></li>
                    <?php endwhile; ?>
                
                </ul>
                <input type="submit" class="submit" value="Potvrď">
                <a href="index.php" class="start">Hlavní strana</a>
                <input type="hidden" name="number" value="<?php echo $number; ?>">
            </form>
        </div>
    </main>
    <footer>
        <div class="container">
            Copyright &copy; 2023 Vladimír Kochan
        </div>
    </footer>
</body>
</html>