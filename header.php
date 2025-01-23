<?php
    include './temp.php';
    include './dbh.class.php';
    $connection = new Dbh;
    $bdd        = $connection->getConnection();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <title>Document</title>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg bs-body-bg">
        <div class="container-fluid d-flex align-content-center gap-3">
            <img src="./assets/img/logo.svg" alt="Eventify Logo" width="50" height="50" class="align-self-center">
            <a class="navbar-brand" href="homepage.php">EVENTIFY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="events.php">My Events</a>
                    </li>
                </ul>
                <?php
                    if (isset($_SESSION["userid"])) {                                                                                  // Check if the user is logged in
                        $extension      = getUserProfilePictureExtension($_SESSION["useruid"]);                                            // Get the profile picture extension
                        $profilePicPath = $extension ? "assets/img/" . $_SESSION["useruid"] . "." . $extension : "assets/img/default.png"; // Set the profile picture path
                    ?>
                <div>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-lg-center">
                        <li class="nav-item d-flex align-items-center gap-3">

                            <img class="profile-pic" src="<?php echo $profilePicPath; ?>" alt="Profile Picture" width="50" height="50"> <!-- Display the profile picture -->

                            <a href="./user-profile.php?id=<?php echo $_SESSION["userid"] ?>" class="nav-link"> <!-- Link to the user's profile page -->
                                <?php echo $_SESSION["useruid"]; ?> <!-- Display the username -->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="includes/logout.inc.php" class="nav-link">LOGOUT</a>
                        </li>
                    </ul>
                </div> <!-- Link to logout -->
                <?php
                }?>
            </div>
        </div>
    </nav>
    </header>