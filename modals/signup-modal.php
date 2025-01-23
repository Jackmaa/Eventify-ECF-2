<!-- Modal SignUp-->
<div class="modal fade" id="signUp" tabindex="-1" aria-labelledby="signUpLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signUpLabel">Connectez vous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="includes/signup.inc.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingUserSignUp" placeholder="username" name="uid" autocomplete="on">
                <label for="floatingUserSignUp">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmailSignUp" placeholder="name@example.com" name="email" autocomplete="on">
                <label for="floatingEmailSignUp">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassSignUp" placeholder="password" name="pwd" autocomplete="on">
                <label for="floatingPassSignUp">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingRePassSignUp" placeholder="password" name="pwdRepeat" autocomplete="on">
                <label for="floatingRePassSignUp">Verify Password</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">SIGN UP</button> <!-- Submit button for login form -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>