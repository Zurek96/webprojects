/* vim: set sw=4, td=4 */
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
    <script src="JavaScript/zamawianie.js"></script>
    <title>Zamów online</title>

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


        <div id="zamowienie">
            <div id="wypelniacz"></div>
            <form action="przygotuj_zamowienie.php" method="post">


                <h1>Zamów online</h1>

                <br/>
                <br/>

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
                    		echo "Pizza: ";
                    		echo '<select name="rodzajPizzy">';
                    		while($row = $result->fetch_assoc())
                    		{
			    		       echo '<option value="'.$row["pizza_id"].'">'.$row["name"]."</option>";
                    		}
                    		echo "</select><br/>";
                	}
                	$sql = "SELECT drink_id, name, price, capacity FROM drinks";
                	$result = $conn->query($sql);
			if($result->num_rows > 0)
			{
			    echo 'Napój: ';
			    echo '<select name="napoj">';
			    echo '<option value="0"> Brak </option>';
			    while($row = $result->fetch_assoc())
			    {
				    echo '<option value="'.$row["drink_id"].'">'.$row["name"].' ('.$row["capacity"].'l)</option>';
			    }
			    echo '</select>';
			}
                	$conn->close();
            	
        	


        echo '<br/><br/>';
        echo 'Adres dostawy:';
		echo '<input value ='.str_replace(" ","&nbsp;",$_SESSION['address']['address']).' name="adres" type="text" placeholder="Ulica i numer domu">';
		echo '<br/><br/>';
		echo 'Numer telefonu:';
        echo '<input value='.$_SESSION['user']['phone'].' name="numerTelefonu" type="text" placeholder="123456789"><br/><br/>
                <input type="submit" class="btn btn-success">Wsadź dane do klasy i listy</input></form>';
		}
		?>

        </div>

        <div class="stopka"></div>

</body>

</html>
