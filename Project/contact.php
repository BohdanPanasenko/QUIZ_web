<?php
include 'templates/header.tpl.php';
?>
        <main>
            <h1>Contact Us</h1>
            <?php if (isset($_SESSION['contact_message'])): ?>
                <p style="color: green;"><?php echo htmlspecialchars($_SESSION['contact_message']); ?></p>
                <?php unset($_SESSION['contact_message']); ?>
            <?php endif; ?>
            <form action="contact_process.php" method="POST">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div>
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn">Send</button>
            </form>
        </main>
<?php
include 'templates/footer.tpl.php';
?>