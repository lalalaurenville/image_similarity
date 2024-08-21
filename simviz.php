<?php
    // ini_set('max_execution_time', '0');

    /// Request data
    $file1 = $_REQUEST['file1'];
    $file2 = $_REQUEST['file2'];
    
    // call file
    $command = escapeshellcmd("python Image_similarity.py"." "."Images/{$file1}"." "."Images/{$file2}");
    $output = shell_exec($command);
    echo $output;
    header("Location: results.php" . "?file1=$file1" . "&file2=$file2");
    exit;
?>