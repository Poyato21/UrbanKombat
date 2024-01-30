<header>
    <body>

    <div id="topHeader">
    <div class="row">
        <div class="column">
            <img src="img/logoPerfil.png" alt="logo" id="logoPerfil" />
            <?php
                if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
                    echo $_SESSION['nombre'] . " || <a href='logout.php'> (Salir)</a>";
                    
                } else {
                    echo "<p> <a href='login.php'>Login</a> | <a href='registro.php'>Registro</a></p>";
                }
            ?>
        </div>
        <div class="column"><img src="img/logo.jpeg" alt="logo" id="logo"/></div>
        <div class="column"></div>
    </div>
    </div>

    <div id="menu">
        <div><a href="index.php"> INICIO </a></div>
        <div><a href="detalles.php"> DETALLES </a></div>
        <div><a href="bocetos.php"> BOCETOS </a></div>
        <div><a href="miembros.php"> MIEMBROS </a></div>
        <div><a href="contacto.php"> CONTACTO </a></div>
        <div><a href="compra.php"> TIENDA </a></div> 
        <?php
            if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
                echo "<div><a href='vota.php'>VOTACIONES</a></div>
                    <div><a href='foro.php'>FORO</a></div>
                    <div><a href='codigos.php'>MIS CÓDIGOS</a></div>";
            }
            if(isset($_SESSION["esAdmin"])&& $_SESSION["esAdmin"]){
                echo "<div><a href='admin.php'>ADMINISTRAR</a></div>";
            }
        ?>
    </div>
</header>
