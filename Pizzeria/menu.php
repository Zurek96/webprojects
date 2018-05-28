<?php
    session_start();
?>
<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="utf-8" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

    <!-- Responsive Web Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="Style/style.css" />
    <title>Menu</title>

</head>

<body>



    <div id="header" class="container-fluid" style="background-size: cover; background-image: url('Pics/pizzeria.jpg');">
        <b>PIZZERIA AiR!</b>
        <?php
    if(isset($_SESSION['logged']))
    {
        echo '<form action="wyloguj.php" method="get">';
        echo '<input type="submit" value="Wyloguj sie">';
        echo '</form>';
    }
?>
    </div>

    <div id="menu">
        <a href="onas.php">
            <div class="przycisk">O nas</div>
        </a>
        <a href="menu.php">
            <div class="przycisk">Menu</div>
        </a>
        <a href="zamow.php">
            <div class="przycisk">Zamów online</div>
        </a>
        <a href="rachunek.php">
                <div class="przycisk">Rachunek</div>
            </a>
        <a href="kontakt.php">
            <div class="przycisk">Kontakt</div>
        </a>
        <a href="zarejestruj_sie.php">
            <div class="przycisk">Zarejestruj się</div>
        </a>
    </div>

    <div id="dania">
        <?php    
            require_once "connect.php";

            $conn = @new mysqli($host, $db_user, $db_password, $db_name);
            if($conn->connect_errno != 0)
            {
                echo "Error: ".$conn->connect_errno;
            }
            else
            {   
                $sql = "SELECT pizza_id, name, price FROM pizzas";
                $result = $conn->query($sql);
                if($result->num_rows > 0)
                {
                    echo "<h1>Menu:</h1>";
                    while($row = $result->fetch_assoc())
                    {
                        echo "<div id='pizza'>".$row["pizza_id"]." ".$row["name"]."<span> ".$row["price"]."</span></div>";
                    }
                }
                $conn->close();
            }
        ?>


        <!--<h1>Menu:</h1>
        <div id="pizza">1. Margherita</div>
        <div id="pizza">2. Cacciatore</div>
        <div id="pizza">3. Vesuvio</div>-->


    </div>

    <div class="stopka"></div>

</body>

</html>
