<?php
include 'templates/header_admin.tpl.php';
?>
<?php

//bullet 11
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}
?>


        <main>
            <h1>Search</h1>
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search..." required>
                <button type="submit" class="btn">Search</button>
            </form>
            <div id="search-results">
                <!-- bridge to search.php -->
            </div>
        </main>
        

<?php
include 'templates/footer_admin.tpl.php';
?>