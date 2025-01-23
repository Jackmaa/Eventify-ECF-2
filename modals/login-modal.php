<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="loginModalLabel">Connectez vous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="includes/login.inc.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingUser" placeholder="name@example.com" name="uid" autocomplete="on">
                <label for="floatingUser">Username or Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPass" placeholder="password" name="pwd" autocomplete="on">
                <label for="floatingPass">Password</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">LOGIN</button> <!-- Submit button for login form -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>