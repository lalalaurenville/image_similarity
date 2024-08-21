<?php
    
	$target_path = "Images/"; //Declaring Path for uploaded images
    $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed

    if(isset($_FILES['filename1'])) {
        $ext = explode('.', basename($_FILES['filename1']['name']));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        
        $file_name1 = md5(uniqid()) . "." . $ext[count($ext) - 1];
        $target_path = $target_path . $file_name1;//set the target path with a new name of image
	    if (($_FILES["filename1"]["size"] < 1000000) //Approx. 1000kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['filename1']['tmp_name'], $target_path)) {//if file moved to uploads folder
                echo '<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {//if file was not moved.
                echo '<span id="error">please try again!.</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            echo '<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }

    if(isset($_FILES['filename2'])) {
        $target_path2 = "Images/"; //Declaring Path for uploaded images
        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['filename2']['name']));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable

        $file_name2 = md5(uniqid()) . "." . $ext[count($ext) - 1];
        $target_path2 = $target_path2 . $file_name2;//set the target path with a new name of image
	    if (($_FILES["filename2"]["size"] < 1000000) //Approx. 1000kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['filename2']['tmp_name'], $target_path2)) {//if file moved to uploads folder
                echo '<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
                
            } else {//if file was not moved.
                echo '<span id="error">please try again!.</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            echo '<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }

if (isset($_POST['action'])) {    
    $url = "simviz.php";
    $url .= "?file1=$file_name1";
    $url .= "&file2=$file_name2";

    header("Location: ".$url);
    exit();
}
?>