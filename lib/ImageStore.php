<?php 
class ImageStore{
    public static function storeImage($file,$targetdir)
    {
        $target = $targetdir . basename($file['image']['name']);
        if (move_uploaded_file($file['image']['tmp_name'], $target)) {
            $toReturn = true;
        } else {
            $toReturn = false;
        }
        return $toReturn;
    }
}
?>
<!---the image upload is reference from https://www.youtube.com/watch?v=Ipa9xAs_nTg and https://www.w3schools.com/php/php_file_upload.asp -->