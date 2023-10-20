<?php
    session_start();
    $title = "Admin Home";
    $_SESSION['title'] = $title;
    include_once('nav_admin.php');
?>

</body>
</html>