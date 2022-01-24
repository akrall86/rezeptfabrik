<?php
require_once 'manager/recipemanager.php';

/**
 * The UploadManager class contains methods for uploading a picture and updating the URL in the DB.
 */
class FileUploadManager
{

    private string $uploadDirectory = 'uploads/';

    /**
     * @param int $user_id
     * @param int $recipe_id
     */
    public function __construct()
    {
    }

    /**
     * saves the image to the upload directory
     * @param int $user_id the id of the user who uploaded the photo
     * @param int $recipe_id the id of the recipe to which the photo belongs
     * @return string|false the destination path if the upload was successful, false otherwise
     */
    function uploadImage(int $user_id, int $recipe_id) :string|bool
    {
        if (file_exists($this->uploadDirectory) == false) {
            mkdir($this->uploadDirectory);
        }
        $filetype = strtolower(pathinfo(basename($_FILES["picture"]["name"]), PATHINFO_EXTENSION));
        $filename = $user_id . "_" . $recipe_id . "." . $filetype;
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $this->uploadDirectory . $filename)) {
            return $filename;
        }
        return false;
    }

    /**
     * updates the image in the upload directory
     * @param int $user_id the id of the user who uploaded the photo
     * @param int $recipe_id the id of the recipe to which the photo belongs
     * @return string|false the destination path if the update was successful, false otherwise
     */
    function updateImage(int $user_id, int $recipe_id) : string|bool
    {
        $filetype = strtolower(pathinfo(basename($_FILES["picture"]["name"]), PATHINFO_EXTENSION));
        $filename = $user_id . "_" . $recipe_id . "." . $filetype;
        $destinationPath = $this->uploadDirectory . $filename;
        unlink($destinationPath);
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $this->uploadDirectory . $filename)) {
            return $filename;
        }
        return false;
    }


}