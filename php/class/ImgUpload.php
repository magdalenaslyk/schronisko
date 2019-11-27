<?php

class ImgUpload
{
    public function __construct()
    {
    }

    public function UploadImage($unique_name, $target_dir)
    {
        $target_file = $target_dir . basename($_FILES["uzdjecie"]["name"]);
        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["uzdjecie"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
// Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["uzdjecie"]["size"] > 500000) {
            $uploadOk = 0;
        }
// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return $uploadOk;
// if everything is ok, try to upload file
        } else {
            $new_dir = $target_dir.$unique_name.".".$imageFileType;
            if (move_uploaded_file($_FILES["uzdjecie"]["tmp_name"], $new_dir)) {
                return "/".$new_dir;
            } else {
                return false;
            }
        }

    }
}