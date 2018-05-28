<?php
    session_start();
    require_once "connect.php";
    
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $address = $_POST['address'];
    $role = 'customer';
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];
    $date = date('Y/m/d H:i:s', time());
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if($conn->connect_errno != 0)
    {
        echo "Error: ".$conn->connect_errno;
    }
    else
    { 
        $sql = "INSERT INTO users values (NULL, '$last_name', '$first_name', '$role', '$email', '$phone', '$date')";
        
        if ($conn->query($sql) === TRUE)
        {
            $sql = "SELECT * FROM users WHERE created_at = '$date'";
            $result = $conn->query($sql);
            if ($result -> num_rows > 0) 
            {
                $row = $result -> fetch_assoc();
                $user_id = $row['user_id'];
                $result -> free_result();
                $sql2 = "INSERT INTO addresses values (NULL, '$city', '$zip_code', '$address', $user_id)";
                if ($conn->query($sql2) === TRUE)
                {
                    $sql3 = 'SELECT * from addresses where user_id = '.$user_id.';';
                    $result = $conn -> query($sql3);
                    if($result -> num_rows > 0)
                    {
                        $_SESSION['logged'] = true;
                        $_SESSION['user'] = $row;
                        $_SESSION['address'] = $result -> fetch_assoc();
                        unset($_SESSION['error']);

                        header('Location: index.php');
                        exit();
                        $conn->close();
                    }
                    else
                    {
                            echo "Error: " . $sql3 . "<br>" . $conn->error;
                            $conn->close();
                    }   
                }
                else
                {
                    echo "Error: " . $sql2 . "<br>" . $conn->error;
                    $conn->close();
                }   
            }
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
                $conn->close();
            }
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $conn->close();
        }
    }
?>
