<?php
session_start(); // Start the session

if (isset($_POST["submit"])) {                                                     // Check if the form is submitted
    $targetDir      = "assets/img/";                                                   // Set the target directory for uploads
    $fileName       = $_SESSION["useruid"];                                            // Set the file name to the username
    $fileExtension  = pathinfo($_FILES["profilePicture"]["name"], PATHINFO_EXTENSION); // Get the file extension
    $targetFilePath = $targetDir . $fileName . "." . $fileExtension;                   // Set the target file path
    $fileType       = pathinfo($targetFilePath, PATHINFO_EXTENSION);                   // Get the file type

    // Allow certain file formats
    $allowTypes = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
    if (in_array($fileType, $allowTypes)) { // Check if the file type is allowed

        // Delete any existing profile picture files with the username
        foreach (glob($targetDir . $fileName . ".*") as $existingFile) {
            unlink($existingFile); // Delete the existing file
        }

                                                                                          // Upload file to server
        if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFilePath)) { // Move the uploaded file

                                                                                 // Resize the image to 50x50 pixels
            list($width, $height) = getimagesize($targetFilePath);               // Get the original dimensions
            $newWidth             = 50;                                          // Set the new width
            $newHeight            = 50;                                          // Set the new height
            $imageResized         = imagecreatetruecolor($newWidth, $newHeight); // Create a new true color image

            // Create an image resource from the uploaded file
            switch ($fileType) {
            case 'jpg':
            case 'jpeg':
                $imageTmp = imagecreatefromjpeg($targetFilePath);
                break;
            case 'png':
                $imageTmp = imagecreatefrompng($targetFilePath);
                break;
            case 'gif':
                $imageTmp = imagecreatefromgif($targetFilePath);
                break;
            case 'webp':
                if (function_exists('imagecreatefromwebp')) {
                    $imageTmp = imagecreatefromwebp($targetFilePath);
                } else {
                    $imageTmp = null;
                }
                break;
            default:
                $imageTmp = null;
                break;
            }

            if ($imageTmp) { // Check if the image resource is created
                                 // Preserve transparency for PNG images
                if ($fileType == 'png') {
                    imagealphablending($imageResized, false);
                    imagesavealpha($imageResized, true);
                }
                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height); // Resize the image

                // Save the resized image as WebP
                imagewebp($imageResized, $targetDir . $fileName . ".webp");

                // Destroy the temporary image resource
                imagedestroy($imageTmp);
                // Destroy the resized image resource
                imagedestroy($imageResized);
                unlink($targetFilePath); // Delete the original file

                header("location: user-profile.php?id=" . $_SESSION["userid"] . "&upload=success"); // Redirect to the user page with success message
            } else {
                header("location: user-profile.php?id=" . $_SESSION["userid"] . "&upload=error"); // Redirect to the user page with error message
            }
        } else {
            header("location: user-profile.php?id=" . $_SESSION["userid"] . "&upload=error"); // Redirect to the user page with error message
        }
    } else {
        header("location: user-profile.php?id=" . $_SESSION["userid"] . "&upload=invalid"); // Redirect to the user page with invalid file type message
    }
} else {
    header("location: user-profile.php?id=" . $_SESSION["userid"]); // Redirect to the user page if the form is not submitted
}
?>