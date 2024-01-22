<?php 

session_start();

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
            <h2>Hotovo!</h2>
            <p>Gratulujeme, jste na konci testu</p>
            <p>Vaše konečné skóre je: <?php echo $_SESSION['score'];?></p>
            <a href="question.php?n=1" class="start" name="start">Zkusit znovu</a>
        </div>
    </main>
    <footer>
        <div class="container">
            Copyright &copy; 2023 Vladimír Kochan
        </div>
    </footer>
</body>
</html>

<?php session_unset(); ?>;