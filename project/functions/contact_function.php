<?php
insert_contact($name, $subject, $message, $id, $mat){
    include './connection.php';
    $sql = "INSERT INTO contact (id_user, nom, matricule, sujet, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssss", $id, $name, $mat, $subject, $message);
    if ($stmt->execute()) {
        return 1;
    }else{
        return 0;
    }
}