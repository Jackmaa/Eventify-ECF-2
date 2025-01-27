<?php
    session_start();                   // Start the session
    if (! isset($_SESSION["userid"])) { // Check if the user is not logged in
        header("Location: index.php");     // Redirect to the index page
        exit();                            // Exit the script
    }
    $id               = $_SESSION['userid'];    // Get the user ID from the session
    $title            = "User Profile";         // Set the page title
    $meta_description = "User Profile";         // Set the meta description 
                                                // Include the database connection class
    include './dbh.class.php';                  // Include the header file
    $connection = new Dbh();                    // Create a new database handler
    $bdd        = $connection->getConnection(); // Connect to the database
    $stmt       = $bdd->prepare('SELECT `auto_delete_past_events` FROM `user` WHERE `id_user` = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user       = $stmt->fetch(PDO::FETCH_ASSOC);
    $autoDelete = $user['auto_delete_past_events'];
    include './header.php';
?>
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
<div class="container col-lg-3">
    <form action="update_auto_delete.php" method="post">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="auto_delete" id="autoDelete"<?php echo $autoDelete ? 'checked' : ''; ?>>
            <label class="form-check-label" for="autoDelete">
                Auto-delete past events
            </label>
        </div>
        <button type="submit" class="btn btn-primary mt-1">Save</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>