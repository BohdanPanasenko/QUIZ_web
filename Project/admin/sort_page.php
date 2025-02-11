<?php
include 'templates/header_admin.tpl.php';
?>
<?php
//bullet 12
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}
?>


        <main>
            <h1>Sort Data</h1>
            <form action="sort.php" method="GET">
                <label for="sort-by">Sort By:</label>
                <select name="sort_by" id="sort-by">
                    <option value="username">Username</option>
                    <option value="email">Email</option>
                    <option value="question">Question</option>
                </select>
                <label for="order">Order:</label>
                <select name="order" id="order">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <button type="submit" class="btn">Sort</button>
            </form>
            <div id="sort-results">
                <!-- again bridge to sort.php -->
            </div>
        </main>
       

<?php
include 'templates/footer_admin.tpl.php';
?>