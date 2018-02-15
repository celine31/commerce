<?php
session_start();
$nbPage=!isset($_SESSION['nbPage']) ? $_SESSION['nbPage']=1 : $_SESSION['nbPage']++;

?>
<html> 
    <head>
        <title>page 1</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <h1> Page 1</h1>
            <h2> Vues : <?= $nbPage?> </h2>
            <a href="page2.php">page 2</a>
        </div>
    </body>
</html>