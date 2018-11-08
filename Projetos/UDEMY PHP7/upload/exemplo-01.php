<form method="post" enctype="multipart/form-data">

    <input type="file" name="fileUpload">
    <button type="submit">Send</button>

</form>

<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 17/10/2018
 * Time: 14:46
 */

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $file = $_FILES["fileUpload"];
    if ($file["error"]){
        throw new Exception("Error: ".$file["error"]);
    }

    $dirUploads = "uploads";

    if(!is_dir($dirUploads)){
        mkdir($dirUploads);
    }

    if (move_uploaded_file($file["tmp_name"],$dirUploads . DIRECTORY_SEPARATOR . $file["name"])){
        echo "Upload realizado com sucesso!";
    } else {
        print_r($_FILES);
        throw new Exception("Não foi possível fazer o upload do arquivo!");
    }

}