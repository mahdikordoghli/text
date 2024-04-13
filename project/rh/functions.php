<?php
function insert($target_dir, $target_file, $uploadOk, $imageFileType){
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["file"]["size"] > 500000) { // Corrected file input name
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowed_extensions = array("pdf");
    if (!in_array($imageFileType, $allowed_extensions)) {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) { // Corrected file input name
            echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded."; // Corrected file input name
            // Path to your Python script
            $python_script = "C:/xampp/htdocs/project/rh/uploads/script.py";


            // Path to the uploaded file
            $uploaded_file_path = $target_file;

            // Execute Python script with uploaded file path as argument
            $output = shell_exec("python $python_script $uploaded_file_path");

            // Display output
            echo "<pre>$output</pre>";

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

