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
        <?php
		session_start();

		if((!isset($_SESSION['logged'])) || ($_SESSION['logged'] == false)) 
		{
			$_SESSION[error] = '<span style="color:white">Nie jestes zalogowany! Zaloguj sie. </span>';
			header('Location: zaloguj_sie.php');
			exit();
		}
	?>



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
                $sql = 'SELECT * FROM orders WHERE user_id = '.$_SESSION['user']['user_id'].' and order_status = \'created\';';
                $result = $conn->query($sql);
                if($result->num_rows > 0)
                {
                    echo 'ZAMOWIENIA:<br/><br/><br/>';
                    while($order = $result -> fetch_assoc())
                    {
                        $suma = 0;
                        echo 'Zamowienie '.$order["order_id"].'<br/><br/>';
                        echo '<table class="table table-striped table-bordered table-hover">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Produkt</th>';
                        echo '<th>Ilosc</th>';
                        echo '<th>Cena</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '</tbody>';
                        $sql2 = 'SELECT * FROM pizza_orders WHERE order_id = '.$order["order_id"].';';
                        $sql3 = 'SELECT * FROM drink_orders WHERE order_id = '.$order["order_id"].';';
                        $result2 = $conn -> query($sql2);
                        $result3 = $conn -> query($sql3);
                        if($result2 -> num_rows > 0)
                        {
                            while($ordered_pizza = $result2 -> fetch_assoc())
                            {
                                echo '<tr>';
                                $sql4 = 'SELECT * FROM pizzas WHERE pizza_id = '.$ordered_pizza["pizza_id"];
                                $result4 = $conn -> query($sql4);
                                if($result -> num_rows > 0)
                                {
                                    $pizza = $result4 -> fetch_assoc();
                                    echo '<td>'.$pizza["name"].'</td>';
                                    echo '<td>'.$ordered_pizza["quantity"].'</td>';
                                    echo '<td>'.$pizza["price"].'</td>';
                                    $suma = $suma + $pizza["price"];
                                }
                                echo'</tr>';
                            }
                        }
                        if($result3 -> num_rows > 0)
                        {
                            while($ordered_drink = $result3 -> fetch_assoc())
                            {
                                echo '<tr>';
                                $sql4 = 'SELECT * FROM drinks WHERE drink_id = '.$ordered_drink["drink_id"];
                                $result4 = $conn -> query($sql4);
                                if($result -> num_rows > 0)
                                {
                                    $drink = $result4 -> fetch_assoc();
                                    echo '<td>'.$drink["name"].' '.$drink["capacity"].'</td>';
                                    echo '<td>'.$ordered_drink["quantity"].'</td>';
                                    echo '<td>'.$drink["price"].'</td>';
                                    $suma = $suma + $drink["price"];
                                }
                                echo'</tr>';
                            }
                        }
                        echo '<tr>';
                        echo '<td></td>';
                        echo '<td><b>Suma</b></td>';
                        echo '<td><b>'.$suma.'</b></td>';
                        echo '</tr>';
                        echo '</tbody>';
                        echo '</table>';
                        echo '<form action = "oplac_zamowienie.php" method="POST">';
                        echo '<input type="hidden" name="order_id" value ='.$order["order_id"].'></input>';
                        echo '<input type="submit" class="btn btn-primary" value="Oplac zamowienie"></input>';
                        echo '</form>';
                    }
                    while($row = $result->fetch_assoc())
                    {
                        echo "<div id='pizza'>".$row["pizza_id"]." ".$row["name"]."<span> ".$row["price"]."</span></div>";
                    }
                }
                else
                {
                    echo 'Nie posiadasz nieoplaconych zamowien';
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
