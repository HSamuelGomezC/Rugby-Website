<?php
    session_start();
    error_reporting(0);
    $_SESSION['title'] = "User Home";
    $mensaje = $_SESSION["mensaje"];
    $fecha   = $_SESSION["fecha"];
?>

<?php
    include_once('nav_user.php');
    if($mensaje) { //En caso de haber un mensaje...
?>
    <p class="mensaje"> <?php echo $mensaje ?> </p>

<?php
    }
?>


</body>
</html>