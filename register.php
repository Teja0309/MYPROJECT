<?php 
    $db = mysqli_connect("localhost", "root", "", "userdb", 3307);

    if(!$db){
        die("Unable to connect database");
    } else{
        echo "Connection Successful";
        echo "\n";
    }

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM userDetails WHERE username=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows===0){
        $createUserQuery = "INSERT INTO userDetails(username, email, password) VALUES(?, ?, ?)";
        $stmt1 = $db->prepare($createUserQuery);
        $stmt1->bind_param("sss", $username, $email, $password);
        $stmt1->execute();
        
        echo "User added successfully";
    } else{
        echo "User already exists";
    }

?>;