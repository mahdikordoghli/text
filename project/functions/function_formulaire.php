<?php
session_start();

/*if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
	// If not authenticated, redirect to the login page
	header('Location: login.php');
	exit;
}*/

function find_employee_p($idRole, $idDepartement)
{
	include './connection.php';
	$sql = "SELECT p FROM userdb.role_departement WHERE idRole = ? AND idDepartement = ?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("ss", $idRole, $idDepartement);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;

}

function find_superviseur_p($idDepartement, $pDemandeur)
{
	if ($idDepartement == "PQM") {
		$pDestination = ($pDemandeur < 0)
			? ($pDemandeur == -3 ? 2 : $pDemandeur + 1)
			: ($pDemandeur > 1 ? $pDemandeur - 1 : 0);
	} else {
		$pDestination = ($pDemandeur < 0)
			? ($pDemandeur == -2 ? 1 : $pDemandeur + 1)
			: ($pDemandeur > 1 ? $pDemandeur - 1 : 0);
	}
	return $pDestination;

}

function find_superviseur_idRole($pDestination, $idDepartement)
{
	include './connection.php';
	$sql = "SELECT idRole FROM userdb.role_departement WHERE p = ? AND idDepartement = ?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("is", $pDestination, $idDepartement);
	$stmt->execute();
	return $stmt->get_result();
}

function find_superviseur_id($roleDestinateur, $idDepartement)
{
	include './connection.php';
	$sql = "SELECT id FROM userdb.userinfo WHERE idRole = ? AND idDepartement = ?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("ss", $roleDestinateur, $idDepartement);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}

function conge_insert($conge, $dateSortie, $dateReprise, $idRole, $idDepartement, $id)
{
	include './connection.php';
	if ($conge == "Congé payé") {

		$dateSortieObj = new DateTime($dateSortie);
		$dateRepriseObj = new DateTime($dateReprise);
		$interval = $dateSortieObj->diff($dateRepriseObj);

		// Get the difference in days
		$diffInDays = $interval->days;


		$sql = "SELECT solde FROM userinfo WHERE id =?";

		$stmt = $mysqli->prepare($sql);

		$stmt->bind_param("s", $id);

		$stmt->execute();

		$res = $stmt->get_result();

		$row = $res->fetch_array();
		$solde = $row[0];

		if ($solde < $diffInDays) {
			?>
			<script>
				alert("Votre solde est insuffisant.");
				window.location.href = "index.php";
			</script>
			<?php
			exit();
		}

	}
	$token = md5(uniqid());
	$_SESSION['token'] = $token; // Store token for potential future use
	//appel fonction pour determiner la valeur de "p" pour l'employé
	$result = find_employee_p($idRole, $idDepartement);

	$row = $result->fetch_array(MYSQLI_ASSOC);

	if (mysqli_num_rows($result) === 1) { // Check if row exists
		$pDemandeur = $row['p'];

		// Calculate destination supervisor "p" 
		$pDestination = find_superviseur_p($idDepartement, $pDemandeur);

		// Find supervisor's ID using prepared statements and sanitization:
		$result = find_superviseur_idRole($pDestination, $idDepartement);
		$row = $result->fetch_array(MYSQLI_ASSOC); // Use associative array

		if (mysqli_num_rows($result) === 1) { // Check if row exists
			$roleDestinateur = $row['idRole'];

			// Find supervisor's user ID using prepared statements and sanitization:
			$result = find_superviseur_id($roleDestinateur, $idDepartement);
			$row = $result->fetch_array(MYSQLI_ASSOC); // Use associative array

			if (mysqli_num_rows($result) === 1) { // Check if row exists
				$idDestination = $row['id'];

				// Insert leave request using prepared statements and potential sanitization:
				$sql = "INSERT INTO demandeconge (username, typeConge, dateSortie, dateReprise, destination) VALUES (?, ?, ?, ?, ?)";
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("sssss", $id, $conge, $dateSortie, $dateReprise, $idDestination);


				if ($stmt->execute()) {
					$stmt->close();
					if ($conge == "Congé payé") {
						//retire le solde
						$newSolde = $solde - $diffInDays;
						//update solde
						$req = "UPDATE userinfo SET solde = ? WHERE id = ?";
						$stmt = $mysqli->prepare($req);
						$stmt->bind_param("is", $newSolde, $id);
						$stmt->execute();
						$_SESSION["solde"] = $newSolde;
					}

					// Success message and redirection (with output buffering):
					?>
					<script>alert("La demande a été envoyée avec succès");
						window.location.href = "index.php";</script>
					<?php



					$_SESSION['test'] = true; // Set session variable (purpose unclear)
				} else {
					// Error message (consider more detailed error handling):
					?>
					<script>alert("La demande n'a pas été envoyée");
						window.location.href = "index.php";
					</script>

					<?php
				}
			} else {
				// Handle case where supervisor user ID not found
				echo "supervisor not found";
			}
		} else {
			// Handle case where supervisor role ID not found
			// ... (e.g., log error, display appropriate message) ...
			echo "superviseur id not found";
		}
	}
}

function permission_insert($regime, $du, $au, $id, $idRole, $idDepartement)
{
	include './connection.php';
	$result = find_employee_p($idRole, $idDepartement);

	$row = $result->fetch_array(MYSQLI_ASSOC);

	if (mysqli_num_rows($result) === 1) { // Check if row exists
		$pDemandeur = $row['p'];

		// Calculate destination supervisor "p" 
		$pDestination = find_superviseur_p($idDepartement, $pDemandeur);

		// Find supervisor's ID using prepared statements and sanitization:
		$result = find_superviseur_idRole($pDestination, $idDepartement);
		$row = $result->fetch_array(MYSQLI_ASSOC); // Use associative array

		if (mysqli_num_rows($result) === 1) { // Check if row exists
			$roleDestinateur = $row['idRole'];

			// Find supervisor's user ID using prepared statements and sanitization:
			$result = find_superviseur_id($roleDestinateur, $idDepartement);
			$row = $result->fetch_array(MYSQLI_ASSOC); // Use associative array

			if (mysqli_num_rows($result) === 1) { // Check if row exists
				$idDestination = $row['id'];

				// Insert leave request using prepared statements and potential sanitization:
				$sql = "INSERT INTO permissionsortie (username, regimeHoraire, du, au, destination) VALUES (?,?,?,?,?)";
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("sssss", $id, $regime, $du, $au, $idDestination);

				if ($stmt->execute()) {

					?>
					<script>alert("La demande a été envoyée avec succès");
						window.location.href = "index.php";</script>
					<?php

					$_SESSION['test'] = true; // Set session variable (purpose unclear)
				} else {
					// Error message (consider more detailed error handling):
					?>
					<script>alert("La demande n'est pas envoyée");
						window.location.href = "index.php";</script>
					<?php

				}
			} else {
				// Handle case where supervisor user ID not found
				echo "supervisor not found";
			}
		} else {
			// Handle case where supervisor role ID not found
			// ... (e.g., log error, display appropriate message) ...
			echo "superviseur id not found";
		}
	}
}

function horaire_insert($date, $time, $idRole, $idDepartement, $id)
{

	include './connection.php';
	//appel fonction pour determiner la valeur de "p" pour l'employé
	$result = find_employee_p($idRole, $idDepartement);

	$row = $result->fetch_array(MYSQLI_ASSOC);

	if (mysqli_num_rows($result) === 1) { // Check if row exists
		$pDemandeur = $row['p'];

		// Calculate destination supervisor "p" 
		$pDestination = find_superviseur_p($idDepartement, $pDemandeur);

		// Find supervisor's ID using prepared statements and sanitization:
		$result = find_superviseur_idRole($pDestination, $idDepartement);
		$row = $result->fetch_array(MYSQLI_ASSOC); // Use associative array

		if (mysqli_num_rows($result) === 1) { // Check if row exists
			$roleDestinateur = $row['idRole'];

			// Find supervisor's user ID using prepared statements and sanitization:
			$result = find_superviseur_id($roleDestinateur, $idDepartement);
			$row = $result->fetch_array(MYSQLI_ASSOC); // Use associative array

			if (mysqli_num_rows($result) === 1) { // Check if row exists
				$idDestination = $row['id'];

				// Insert leave request using prepared statements and potential sanitization:
				$sql = "INSERT INTO changerregimehoraire (username, date, time, destination) VALUES (?,?,?,?)";
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("ssss", $id, $date, $time, $idDestination);

				if ($stmt->execute()) {

					?>
					<script>alert("La demande a été envoyée avec succès");
						window.location.href = "index.php";</script>
					<?php

					$_SESSION['test'] = true; // Set session variable (purpose unclear)
				} else {
					// Error message (consider more detailed error handling):
					?>
					<script>alert("La demande n'est pas envoyée");
						window.location.href = "index.php";</script>
					<?php

				}
			} else {
				// Handle case where supervisor user ID not found
				echo "supervisor not found";
			}
		} else {
			// Handle case where supervisor role ID not found
			// ... (e.g., log error, display appropriate message) ...
			echo "superviseur id not found";
		}
	}
}

function badgeage_insert($date, $entre, $sortie, $idRole, $idDepartement, $id)
{
	include './connection.php';


	$result = find_employee_p($idRole, $idDepartement);

	$row = $result->fetch_array(MYSQLI_ASSOC);

	if (mysqli_num_rows($result) === 1) { // Check if row exists
		$pDemandeur = $row['p'];

		// Calculate destination supervisor "p" 
		$pDestination = find_superviseur_p($idDepartement, $pDemandeur);

		// Find supervisor's ID using prepared statements and sanitization:
		$result = find_superviseur_idRole($pDestination, $idDepartement);
		$row = $result->fetch_array(MYSQLI_ASSOC); // Use associative array

		if (mysqli_num_rows($result) === 1) { // Check if row exists
			$roleDestinateur = $row['idRole'];

			// Find supervisor's user ID using prepared statements and sanitization:
			$result = find_superviseur_id($roleDestinateur, $idDepartement);
			$row = $result->fetch_array(MYSQLI_ASSOC); // Use associative array

			if (mysqli_num_rows($result) === 1) { // Check if row exists
				$idDestination = $row['id'];

				// Insert leave request using prepared statements and potential sanitization:
				$sql = "INSERT INTO badgeage (username, date, entree, sortie, destination) VALUES (?,?,?,?,?)";
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("sssss", $id, $date, $entre, $sortie, $idDestination);

				if ($stmt->execute()) {
					?>
					<script>alert("La demande a été envoyée avec succès");
						window.location.href = "index.php";</script>
					<?php

					$_SESSION['test'] = true; // Set session variable (purpose unclear)
				} else {
					// Error message (consider more detailed error handling):
					?>
					<script>alert("La demande n'est pas envoyée");
						window.location.href = "index.php";</script>
					<?php

				}
			} else {
				// Handle case where supervisor user ID not found
				echo "supervisor not found";
			}
		} else {
			// Handle case where supervisor role ID not found
			// ... (e.g., log error, display appropriate message) ...
			echo "superviseur id not found";
		}
	}
}

