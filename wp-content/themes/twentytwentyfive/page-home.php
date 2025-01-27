<?php

// Garante que o arquivo não seja acessado diretamente
if (!defined('ABSPATH')) {
    exit;
}

// Inclui o cabeçalho do tema
get_header();
?>

<!-- Define o estilo inline no body -->
<div style="background-color: #1236; color: #1236; min-height: 100vh;">

    <!-- Inclui o formulário de postagem -->
    <?php include('formulario.php'); ?>

    <?php include('listar-formulario.php'); ?>


</div>

<?php
// Inclui o rodapé do tema
get_footer();
?>
