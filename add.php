

<?php 


include 'db.php';

if(isset($_POST['submit'])){

    // Ziskání post proměnné
    $question_number = $_POST['question_number'];
    $question_text = $_POST['question_text'];
    $correct_choice =  $_POST['correct_choice'];

    //očištění stringu
    $cleanStringQuestionNumber = strip_tags($question_number);
    $cleanStringQuestionText = strip_tags($question_text);
    $cleanStringCorrectChoice = strip_tags($correct_choice);

    //Vytvoření pole pro vložení otázek

        $choices = array();
        $choices['1'] = strip_tags($_POST['choice1']);
        $choices['2'] = strip_tags($_POST['choice2']);
        $choices['3'] = strip_tags($_POST['choice3']);
        $choices['4'] = strip_tags($_POST['choice4']);
        

    


        //Question query

        $query = "INSERT INTO `questions` (question_number,text) VALUES ('$cleanStringQuestionNumber','$cleanStringQuestionText')";

    // Vložení řádku

    $insert_row = $conn -> query($query) or die($conn->error.__LINE__);

    //Validace vložení

    if($insert_row){
        foreach($choices as $choice => $value){
            if($value != ""){
                if ($correct_choice == $choice){
                    $is_correct = 1;
                }
                else {
                    $is_correct =  0;
                }
                // Příkaz pro volbu 

                $query = "INSERT INTO `choices`(question_number, is_correct, text)
                                        VALUES('$cleanStringQuestionNumber','$is_correct','$value')";

                //Spušetění příkazu
                
                $insert_row = $conn -> query($query) or die ($conn -> error.__LINE__);

                //Validate insert

                if($insert_row){
                    continue;

                } else {
                    die('Error : ('.$conn->errno .') '. $conn -> error);
                }
            }
        }

        
        $msg = 'Otázka byla vložena';
    }



}

/**
 * Ziskání celkový počet otázek
 */


 $query = "SELECT * FROM questions";

 // Výsledek
 
 $result = $conn -> query($query) or die($conn -> error.__LINE__);
 
 $total = $result -> num_rows;

 $next = $total + 1;


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
        <h1>Vlož otázku</h1>
        <?php if(isset($msg)){echo '<h3>' .$msg . '<h3>';}?>
        <form action="add.php" method="POSt">
            <p>
                <label for="" class="label">Otázka č.</label>
                <input type="number" name="question_number" value="<?php echo $next; ?>">
            </p>
            <p>
                <label for="" class="label">Text otázky</label>
                <input type="text" name="question_text">
            </p>
            <p>
                <label for="" class="label">Volba číslo #1</label>
                <input type="text" name="choice1">
            </p>
            <p>
                <label for="" class="label">Volba číslo #2</label>
                <input type="text" name="choice2">
            </p>
            <p>
                <label for="" class="label">Volba číslo #3</label>
                <input type="text" name="choice3">
            </p>
            <p>
                <label for="" class="label">Volba číslo #4</label>
                <input type="text" name="choice4">
            </p>
            <p>
                <label for="" class="label">Správná odpověď</label>
                <input type="number" name="correct_choice">
            </p>
            <p>
                <input type="submit" name="submit" class="submit" value="Potvrď">
                <a href="index.php" class="start">Hlavní strana</a>
            </p>
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