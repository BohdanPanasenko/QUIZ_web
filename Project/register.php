<?php
include 'templates/header.tpl.php';
?>
<?php
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>

        <main>
            <h1>Register</h1>
            <div id="error-message" style="color: red;"></div>
            <form id="register-form" action="register_process.php" method="POST">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    <span id="username-message"></span>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="g-recaptcha" data-sitekey="6LfmGLwqAAAAAIteG8ywAOYGHF-IKBLNZVyxz2y2"></div>
                <button type="submit" class="btn">Register</button>
            </form>
        </main>


<?php
include 'templates/footer.tpl.php';
?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="assets/js/check_username.js"></script>
    <script src="assets/js/register_validation.js"></script>
