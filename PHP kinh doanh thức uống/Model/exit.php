<?php
    if (isset($_SESSION['Customer'])&&isset($_POST['exit'])) {
        echo "<script>console.log('ok')</script>";
        unset($_SESSION['Customer']);
    }
?>