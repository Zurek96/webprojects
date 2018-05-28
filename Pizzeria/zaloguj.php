<?php
    session_start();
    require_once "connect.php";
    
    $email = $_POST['email'];
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if($conn->connect_errno != 0)
    {
        echo "Error: ".$conn->connect_errno;
    }
    else
    { 
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn -> query($sql);
        if ($result -> num_rows > 0)
        {
            $row = $result -> fetch_assoc();
            $user_id = $row["user_id"];
            $sql = "SELECT * FROM addresses WHERE user_id = '$user_id'";
            $result2 = $conn -> query($sql);
            if ($result2 -> num_rows > 0)
            {
                $row2 = $result2 -> fetch_assoc();
                $_SESSION['logged'] = true;
                $_SESSION['address'] = $row2;
                $_SESSION['user'] = $row;
                unset($_SESSION['error']);
                header('Location: index.php');
                $conn->close();
                exit();   
            }
            else
            {
                $_SESSION['error'] = '<span style = "color: white">Blad! Brak adresu dla wybranego użytkownika!</span>';
                header('Location: zaloguj_sie.php');
                $conn->close();
                exit();    
            }
                       
        }
        else
        {
            $_SESSION['error'] = '<span style = "color: white">Blad! Nie ma uzytkownika o podanym adresie e-mail!</span>';
            header('Location: zaloguj_sie.php');
            $conn->close();
            exit();
        }
    }
?>
