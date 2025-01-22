<?php
    session_start();           // Start the session
    include './dbh.class.php'; // Include the database connection class

    $connection = new Dbh;                      // Create a new database connection
    $bdd        = $connection->getConnection(); // Get the database connection
    if (isset($_GET['id'])) {                   // Check if the 'id' parameter is set in the URL
        $id = $_GET['id'];                          // Get the 'id' parameter from the URL
    } else {
        header('location: error-404.php'); // Redirect to error page if 'id' is not set
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set the character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Set the viewport for responsive design -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/styles/styles.css"><!-- Link to the stylesheet -->
    <title>Document</title> <!-- Set the title of the document -->
</head>
<?php include './header.php'?>
<!-- Profile picture upload form -->
<div class="container col-lg-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeProfilePicture">
    Change Profile Picture
    </button>

    <!-- Modal -->
    <div class="modal fade" id="changeProfilePicture" tabindex="-1" aria-labelledby="changeProfilePictureLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="changeProfilePictureLabel">Change your profile picture</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="upload_profile_picture.php" method="post" enctype="multipart/form-data"> <!-- Form to upload profile picture -->
            <label for="profilePicture" class="form-label">Upload Profile Picture:</label> <!-- Label for the file input -->
            <input class="form-control" type="file" name="profilePicture" id="profilePicture" required> <!-- File input for profile picture -->
            <button class="btn btn-primary mt-1" type="submit" name="submit">Upload</button> <!-- Submit button -->
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>