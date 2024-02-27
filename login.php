<?php
    $db = mysqli_connect("localhost", "root", "", "userdb", 3307);

    if(!$db){
        die("Unable to connect database");
    } else{
        echo "";
        echo "\n";
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM userDetails WHERE username=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows!==0){
        $row = $result->fetch_assoc();
        $checkPassword = $row["password"] === $password;
        if ($checkPassword){
            echo "Login Successful\n";
            echo '<button><a href="login.html">Logout</a></button>';
        } else{
            echo "Invalid Password";
        }
    } else{
        echo "Invalid Username";
    }

?>;