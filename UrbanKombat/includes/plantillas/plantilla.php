<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/diseno.css"/>
    <link rel="stylesheet" type="text/css" href="css/<?=$css?>"/>
    
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/validar.js"></script>
    
    <title><?=$titulo ?></title>
</head>
<body>
    <?php require("includes/comun/header.php");?>

    <main>
        <article>  
            <?=$contenido?>
        </article>
    </main>
    <?php
        require("includes/comun/pie.php");
    ?>
</body>
</html>



