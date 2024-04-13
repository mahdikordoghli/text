<?php
/*session_start();
include './connection.php';

if (isset($_POST['action']) && isset($_POST['id'])) {
  $action = $_POST['action'];
  $id = $_POST['id'];

  $req = "UPDATE userdb.demandeconge SET statut = ? WHERE idConge = ?";
  $stmt = $mysqli->prepare($req);
  $stmt->bind_param("ss", $action, $id);
  $stmt->execute();

  echo $action; // Send the updated status back to the JavaScript code
} else {
  echo 'Error: Missing parameters';
}*/
// Check if the request method is POST

session_start();
include './connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the raw POST data
  $postData = file_get_contents('php://input');

  // Decode the JSON data
  $data = json_decode($postData);

  // Check if JSON decoding was successful
  if ($data !== null) {
    // Extract the id and name from the decoded JSON data
    $id = $data->id;
    $val = $data->val;
    $type = $data->type;
    $idUser = $data->idUser;


    if ($type == 'conge') {
      $req = "UPDATE userdb.demandeconge SET statut = ? WHERE idConge = ?";
      $stmt = $mysqli->prepare($req);
    
      $stmt->bind_param("ss", $val, $id);

      $stmt->execute();
      $stmt->close();
      //see if the supervisor approve the demande
      if ($val == 'refusé') {
        //recherche si le congé est payer
        $req = "SELECT typeConge, dateSortie, dateReprise FROM userdb.demandeconge WHERE idConge = ?";
        $stmt = $mysqli->prepare($req);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_array();
        $stmt->close();
        if ($row['typeConge'] == 'Congé payé') {
          $req = "SELECT solde FROM userinfo WHERE id = ?";
          $stmt = $mysqli->prepare($req);
          $stmt->bind_param("s", $idUser);
          $stmt->execute();
          $res = $stmt->get_result();
          $row2 = $res->fetch_array();
          $stmt->close();
          $solde = $row2['solde'];
          //Get the dates
          $dateSortieObj = new DateTime($row['dateSortie']);
          $dateRepriseObj = new DateTime($row['dateReprise']);

          $interval = $dateSortieObj->diff($dateRepriseObj);

          // Get the difference in days
          $diffInDays = $interval->days;
          //new solde
          $newSolde = $solde + $diffInDays;
          //update solde
          $req = "UPDATE userinfo SET solde = ? WHERE id = ?";
          $stmt = $mysqli->prepare($req);
          $stmt->bind_param("is", $newSolde, $idUser);
          $stmt->execute();

        }

      }



    }
    if ($type == 'permission de sortie') {
      $req = "UPDATE userdb.permissionsortie SET statut = ? WHERE idPermission = ?";
      $stmt = $mysqli->prepare($req);

      $stmt->bind_param("si", $val, $id);

      $stmt->execute();
    }
    if ($type == 'manque de badgeage') {
      $req = "UPDATE userdb.badgeage SET statut = ? WHERE idBadgeage = ?";
      $stmt = $mysqli->prepare($req);

      $stmt->bind_param("ss", $val, $id);

      $stmt->execute();
    }
    if ($type == 'regime horaire') {
      $req = "UPDATE userdb.changerregimehoraire SET statut = ? WHERE id = ?";
      $stmt = $mysqli->prepare($req);

      $stmt->bind_param("ss", $val, $id);

      $stmt->execute();
    }

  } else {
    // Handle JSON decoding error
    echo "Error decoding JSON data\n";
  }
} else {
  // Handle if the request method is not POST
  echo "Only POST requests are allowed\n";
}
?>