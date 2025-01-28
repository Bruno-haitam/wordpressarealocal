<?php


if (!defined('ABSPATH')) {
    exit;
}


get_header();
?>


<div style="background-color: #fff; color: #1236; min-height: 100vh;">

   
    <?php include('formulario.php'); ?>

    <?php include('listar-formulario.php'); ?>


</div>

<?php

get_footer();
?>
