<?php

require_once "../config.php";
// include "../php/action.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db();
   //check if user with this email already exist in the database
   
    $query = "SELECT * FROM students WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)){
        echo "Email already Taken";
    } else{
        $query = "INSERT INTO students (`full_names`, `email`, `password`, `gender`, `country`) VALUES ('$fullnames', '$email', '$password', '$gender', '$country')";
        $result = mysqli_query($conn, $query);
        
        if($query){
            echo "Student Registered Successfully";
        }else{
            echo "Registration Failed";
        }
    }
    
    }

//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();

    echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    $query = mysqli_query($conn, "SELECT * FROM students WHERE email = '$email' AND password = '$password'");
    $rows = mysqli_num_rows($query);
    if($rows == 1){
        $_SESSION['login'] = $email;
        //Redirect to a dashboard
        header("location: ./dashboard.php"); 
     }else{
        header("location: ./register.php");
         }

    mysqli_close($conn);
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
    //open connection to the database and check if username exist in the database
    $sql = "SELECT * FROM students where email = '$email'";
    $result = mysqli_query($conn, $sql);

    //if it does, replace the password with $password given
    // $result = 

}
function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    $query = "SELECT * from students";
    mysqli_query($conn, $query);

    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();
     //delete user with the given id from the database
     $sql = "DELETE FROM students where id = '$id'";

     if($conn->query($sql) == true){
         echo "Student Deleted";
     }else{
         echo "Failed";
     }

     mysqli_close($conn);
 
}

?>