<?php
/**
 * Created by PhpStorm.
 * User: Patryk
 * Date: 24.08.2016
 * Time: 01:03
 */
//echo var_dump($_FILES['foto']['name']);
$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        return "<div class='alert alert-danger'>Wybrany plik nie jest obrazkiem!</div>";
    }
}
// Check if file already exists
if (file_exists("img/".$_SESSION['id_user']."_".time()."_".$_FILES['foto']['name'])) {
    $uploadOk = 0;
    $return = "<div class='alert alert-danger'>Plik o tej nazwie już istnieje</div>";

}
// Check file size
if ($_FILES["foto"]["size"] > 2097152) {
    $uploadOk = 0;
    $return = "<div class='alert alert-danger'>Ten plik jest za duży!</div>";

}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $uploadOk = 0;
    $return = "<div class='alert alert-danger'>Dozwolone formaty plików to JPG, JPEG, PNG & GIF.</div>";

}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    $file =$_FILES['foto']['tmp_name'];
    if (move_uploaded_file($file, $target_file)) {
        rename("img/".$_FILES['foto']['name'], "img/". $_SESSION['id_user'] . "_" . time() . "_" .
            $_FILES['foto']['name']);
        //echo "The file ". basename( $_FILES["foto"]["name"]). " has been uploaded.";
    } else {
        $uploadOk = 0;
        $return = "<div class='alert alert-danger'>Nie udało się dodać pliku.</div>";
    }
}