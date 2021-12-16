<?php

    /**
     * The UploadManager class contains methods for uploading or updating pictures.
     */
class FileUploadManager {

    private string $uploadDirectory = '../uploads/';


    /**
     * @param int $user_id
     * @param int $recipe_id
     */
    public function __construct() {
    }

    /**
     * saves the image to the upload directory
     * @param int $user_id
     * @param int $recipe_id
     * @param string $tmpUploadFile
     * @return false|string returns the destination path if the upload was successful, false otherwise
     */
    function uploadImage(int $user_id, int $recipe_id, string $tmpUploadFile) {
        $filetype = $this->getFileType($tmpUploadFile);
        $filename = $user_id. "_" . $recipe_id . $filetype;
        $destinationPath = $this->uploadDirectory . $filename;
        if (move_uploaded_file($tmpUploadFile, $destinationPath)) {
            return  $destinationPath;
        }
        return false;
    }

    /**
     * updates the image in the upload directory
     * @param int $user_id
     * @param int $recipe_id
     * @param string $tmpUploadFile
     * @return false|string returns the destination path if the update was successful, false otherwise
     */
    function updateImage(int $user_id, int $recipe_id, string $tmpUploadFile) {
        $filetype = $this->getFileType($tmpUploadFile);
        $filename = $user_id. "_" . $recipe_id . $filetype;
        $destinationPath = $this->uploadDirectory . $filename;
        unlink($destinationPath);
        if (move_uploaded_file($tmpUploadFile, $destinationPath)) {
            return  $destinationPath;
        }
        return false;
    }

    /**
     * filters the type from the file name
     * @param string $name
     * @return string the file type
     */
    function getFileType(string $name) {
        $pos = strripos($name, '.');
        return substr($name, $pos + 1);
    }

}