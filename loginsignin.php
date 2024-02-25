<!DOCTYPE html>
<html lang="en">

<head>
    <link href="css/login.css" rel="stylesheet" />
    <?php require 'auth/is-publicpage.php'; ?>

</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <?php if (!empty($errorMsg)) : ?>
                <div style="color: red;"><?php echo $errorMsg; ?></div>
            <?php endif; ?>
            <form action="registerlogic.php" method="post">
                <h1>Create Account</h1>

                <input id="inputFirstName" name="inputFirstName" type="text" placeholder="Enter your first name" />
                <input id="inputLastName" name="inputLastName" type="text" placeholder="Enter your last name" />
                <input id="inputEmail" name="inputEmail" type="email" placeholder="name@example.com" />
                <input id="inputPassword" name="inputPassword" type="password" placeholder="Create a password" />
                <input id="inputPasswordConfirm" name="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                <select id="userType" name="userType">
                    <option value="Patient">Patient</option>
                    <option value="Doctor">Doctor</option>
                </select>
                <input class="button" type="submit" name="submit" value="Create Account">
            </form>
        </div>

        <!--LOG IN-->
        <div class="form-container sign-in-container">
            <form action="login-logic.php" method="POST">
                <h1>Log in</h1>
                <input type="email" name="inputEmail" id="inputEmail" placeholder="name@example.com" required>
                <br>
                <input type="password" name="inputPassword" id="inputPassword" placeholder="Password" required>
                <br>
                <input class="button" type="submit" name="submit" value="Log in">
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">LOG In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>