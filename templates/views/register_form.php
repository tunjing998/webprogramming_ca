<main>
    <div id="head">
        <h1>Register</h1>
        <h3>Ensure that all fields marked * is properly input before submitting to complete the signup process.
        </h3>
    </div>
    <form id="register" name="register" action='<?= BASE_DIR ?>/register' method='post'>
        <p class='error'><?= $locals['error'] ?></p>
        <label>Username * </label><br>
        <input id="usernameRegister" name="username" required autofocus type="text" placeholder="Enter Username" title="At Least 5 Characters" value="<?= $locals['username']; ?>" />
        <span id='availiable'>
            <!-- <i class="fas fa-spinner"></i> -->
        </span>
        <br>
        <label>Email<strong>*</strong></label><br>
        <input id="email" type="email" name="email" required size="60" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Enter Your Email Address" title="No Upper Case Letters Allowed" value="<?= $locals['email']; ?>" />
        <span id='emailAvailiable'>
            <!-- <i class="fas fa-spinner"></i> -->
        </span>
        <br>
        <label>Password<strong>*</strong></label><br>
        <input id="passwordRegister" name="passcode" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}" type="password" placeholder="At Least 7 Characters" title="At Least 7 Characters, At Least 1 Uppercase, Lowercase & Number" />
        <span id='passwordStrength'></span>
        <br>
        <label>Confirm Password<strong>*</strong></label><br>
        <input id="passwordConfirm" name="passcodeConfirm" required type="password" placeholder="Re-enter Your Password" /><br>
        <input id="submitButton" type="submit" value="Sign Up" />
    </form>
</main>
<script src="assets/js/register.js"></script>