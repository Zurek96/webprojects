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
        $sql = 'UPDATE orders SET order_status = \'payed\' where order_id = '.$_POST["order_id"].';';
        if (($conn -> query($sql)) === TRUE)
        {
            header('Location: rachunek.php');
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $conn->close();
        }
        
        
    }
        ?>
