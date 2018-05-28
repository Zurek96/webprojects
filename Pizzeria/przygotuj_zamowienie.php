<?php
session_start();
require_once "connect.php";
$date = date('Y/m/d H:i:s', time());
$conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if($conn->connect_errno != 0)
    {
        echo "Error: ".$conn->connect_errno;
    }
    else
    { 
        $sql = 'INSERT INTO orders values (NULL, '.$_SESSION["user"]["user_id"].', "'.$date.'", NULL, "created")';
        if (($result = $conn -> query($sql)) === TRUE)
        {
            
            $last_id = $conn -> insert_id;
            $sql2 = 'INSERT INTO pizza_orders values ('.$last_id.', '.$_POST["rodzajPizzy"].', 1);';
            $result2 = $conn -> query($sql2);
            if($_POST["napoj"] != 0)
            {
                $sql3 = 'INSERT INTO drink_orders values ('.$last_id.', '.$_POST["napoj"].', 1);';
                $result3 = $conn -> query($sql3);
            }
            else
            {
                $result3 = TRUE;
            }
            if ($result2 === TRUE && $result3 === TRUE)
            {
                header('Location: rachunek.php');
            }
            else
            {
                echo "Error: " . $conn->error;
                $conn->close(); 
            }
        }
        else
        {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
            $conn->close();
        }
        
        
    }
        ?>
