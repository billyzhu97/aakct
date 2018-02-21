<?php
session_start();
?>

<?php
$page_title = 'Maddie Freeman Photography';
include_once('./includes/header.php');
?>

<body>
<?php
    include_once('./includes/banner.php');
    include_once('./includes/navbar.php');
    include_once('includes/functions.php');

    if (!isset($_SESSION['logged_user'])) {
        echo("<h1>Sorry, this page is only available for admins</h1>");
    }
    else {
        include_once('includes/add-photo-admin-only.php');
    }

    include_once('./includes/footer.php');

?>

</body>
</html>