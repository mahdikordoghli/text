<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $id = $_GET['id'];
    ?>


    <style>
        /* Style for the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* Style for table header */
        th {
            background-color: #f2f2f2;
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        /* Style for table data cells */
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        /* Style for alternating rows */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>

    <?php
    include './connection.php';

    $sql = "SELECT * FROM assurance where id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_array();
    $ch = $row[1];

    $lines = explode("\n", $ch);

    echo "<table>";
    // Table header row
    echo "<tr>";
    echo "<th>Date</th>";
    echo "<th>Nom</th>";
    echo "<th>Executant</th>";
    echo "<th>Acte</th>";
    echo "<th>Qte</th>";
    echo "<th>Frais Réels</th>";
    echo "<th>Mutuel</th>";
    echo "<th>Remb</th>";
    echo "<th>Non Remb</th>";
    echo "<th>Tpg</th>";
    echo "</tr>";
    $i = 1;

    foreach ($lines as $line) {
        // Trim any extra whitespace
        $line = trim($line);

        if ($line[0] == "X") {
            $line = substr($line, 2);
            $date = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $nom = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $prenom = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $executant = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $acte = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $qte = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $frais_reels = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $mutuel = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $remb = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $non_remb = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $tpg = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);

            echo "<tr>";
            echo "<td>" . $date . "</td>";
            echo "<td>" . $nom . " " . $prenom . "</td>";
            echo "<td>" . $executant . "</td>";
            echo "<td>" . $acte . "</td>";
            echo "<td>" . $qte . "</td>";
            echo "<td>" . $frais_reels . "</td>";
            echo "<td>" . $mutuel . "</td>";
            echo "<td>" . $remb . "</td>";
            echo "<td>" . $non_remb . "</td>";
            echo "<td>" . $tpg . "</td>";
            echo "</tr>";
        } else if ($line[0] == "D") {
            $line = substr($line, 2);
            $decompte = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $date2 = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $t_frais_reels = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $t_mutuel = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $t_remb = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $t_non_remb = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $t_tpg = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            echo "<tr>";
            echo "<td>" . "DECOMPTE" . "</td>";
            echo "<td>" . $decompte . "</td>";
            echo "<td>" . "DATE" . "</td>";
            echo "<td>" . $date2 . "</td>";
            echo "<td>" . "TOTAL" . "</td>";
            echo "<td>" . $t_frais_reels . "</td>";
            echo "<td>" . $t_mutuel . "</td>";
            echo "<td>" . $t_remb . "</td>";
            echo "<td>" . $t_non_remb . "</td>";
            echo "<td>" . $t_tpg . "</td>";
            echo "</tr>";

        } else if ($line[0] == "T") {

            echo "</table>";
            echo "<table>";
            // Table header row
            echo "<tr>";
            echo "<th>TYPE</th>";
            echo "<th>Frais Réels</th>";
            echo "<th>Mutuel</th>";
            echo "<th>Remb</th>";
            echo "<th>Non Remb</th>";
            echo "<th>Tpg</th>";
            echo "</tr>";

            $line = substr($line, 2);
            $fr_reels = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $mut = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $remb = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $n_remb = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);
            $tpg = substr($line, 0, strpos($line, ";"));
            $line = substr($line, strpos($line, ";") + 1);

            echo "<tr>";
            if ($i == 1) {
                echo "<td>" . "TOTAL BENIFICIAIRE" . "</td>";
            } else {
                echo "<td>" . "TOTAL ADHERENT" . "</td>";
            }

            echo "<td>" . $fr_reels . "</td>";
            echo "<td>" . $mut . "</td>";
            echo "<td>" . $remb . "</td>";
            echo "<td>" . $n_remb . "</td>";
            echo "<td>" . $tpg . "</td>";
            echo "</tr>";


            $i = $i + 1;
        }

    }
    echo "</table>";

    //echo "<tr><th>DATE</th><th>AYANT-DROIT</th><th>EXECUTANT</th><th>ACTE</th><th>QT</th><th>FR.REELS</th><th>1ERE MUT</th><th>REMB</th><th>NON REMB</th><th>TPG</th></tr>";
    ?>

</body>

</html>