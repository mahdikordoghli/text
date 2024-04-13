<?php
function login()
{
    include "connection.php";


    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM userdb.userInfo WHERE id = ? AND password = ? ";

    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();

    $res = $stmt->get_result();

    $row = $res->fetch_array();


    if (mysqli_num_rows($res) == 0) {
        echo 'failed';
        /*?><script> alert("mott de passe"); </script><?php*/
    } else {
        $usr = $row['id'];
        $idRole = $row[5];
        $idDepartement = $row[6];
        $name = $row[1];
        $prenom = $row[2];
        $matricule = $row['matricule'];
        $solde = $row[7];
        $email = $row['email'];
        $phone = $row['phone'];


        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $usr;
        $_SESSION['idRole'] = $idRole;
        $_SESSION['idDepartement'] = $idDepartement;
        $_SESSION['name'] = $name;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['matricule'] = $matricule;
        $_SESSION['solde'] = $solde;
        $_SESSION['test'] = false;
        $_SESSION['authenticated'] = true;
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["phone"] = $phone;
        if($idDepartement == "PHR"){
            header("Location:rh/indexrh.php");
        }else{
            header("Location:index.php");
        }
        
       
        exit();

    }


}
