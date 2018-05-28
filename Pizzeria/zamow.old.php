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

    <div id="header" class="container-fluid" style="background-size: cover; background-image: url('Pics/pizzeria.jpg');">
        <b>PIZZERIA AiR!</b>
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
        <a href="kontakt.php">
            <div class="przycisk">Kontakt</div>
        </a>
        <a href="zarejestruj_sie.php">
            <div class="przycisk">Zarejestruj się</div>
        </a>
    </div>


    <div id="zamowienie">
        <div id="wypelniacz"></div>

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
                    echo '<select id="rodzajPizzy">';
                    while($row = $result->fetch_assoc())
                    {
                        echo "<option>".$row["name"]."</option>";
                    }
                    echo "</select>";
                }
            }
        ?>

        <br/>
        <br/> Rozmiar:
        <select id="rozmiarPizzy">
            <option>Duża (50cm)</option>
            <option>Średnia (40cm)</option>
            <option>Mała (30cm)</option>
        </select>

        <br/>
        <br/>

        <?php
            $conn = @new mysqli($host, $db_user, $db_password, $db_name);
            if($conn->connect_errno == 0) 
            {
                $sql = "SELECT name, price, capacity FROM drinks";
                $result = $conn->query($sql);
                if($result->num_rows > 0)
                {
                    echo 'Napój: ';
                    echo '<select id="napoj">';
                    echo '<option> Brak </option>';
                    while($row = $result->fetch_assoc())
                    {
                        echo '<option>'.$row["name"].' ('.$row["capacity"].'l)</option>';
                    }
                    echo '</select>';
                }
                $conn->close();
            }

        ?>

            <br/>
            <br/> Adres dostawy:
            <input id="adres" type="text" placeholder="Ulica i numer domu">

            <br/>
            <br/> Numer telefonu:
            <input id="numerTelefonu" type="text" placeholder="123456789">

            <br/>
            <br/>
            <button class="btn btn-success" onclick="zapiszDane();">Wsadź dane do klasy i listy</button>

            <div class="podsumowanie"></div>

            <button class="btn btn-primary" onclick="wyslijZamowienie();"> Wyślij zamówienie</button>

    </div>

    <div class="stopka"></div>

</body>

</html>
