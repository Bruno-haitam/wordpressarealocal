<?php
// Função para processar o formulário e criar um post
function process_custom_post_form() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['custom_post_submit'])) {
        $errors = []; // Array para armazenar erros

        // Validação do título
        if (empty($_POST['post_title']) || strlen($_POST['post_title']) < 3 || strlen($_POST['post_title']) > 100) {
            $errors[] = 'O título deve ter entre 3 e 100 caracteres.';
        }

        // Validação do conteúdo
        if (empty($_POST['post_content']) || strlen($_POST['post_content']) < 10 || strlen($_POST['post_content']) > 1000) {
            $errors[] = 'O conteúdo deve ter entre 10 e 1000 caracteres.';
        }

        // Validação da imagem
        if (empty($_FILES['post_image']['name'])) {
            $errors[] = 'Você precisa selecionar uma imagem.';
        } else {
            $file_type = wp_check_filetype($_FILES['post_image']['name']);
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($file_type['type'], $allowed_types)) {
                $errors[] = 'Apenas imagens JPEG, PNG ou GIF são permitidas.';
            }
        }

        // Se houver erros, exibe-os
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<p style="color: red; text-align: center;">' . $error . '</p>';
            }
        } else {
            // Processa o post, pois tudo foi validado
            $title = sanitize_text_field($_POST['post_title']);
            $content = sanitize_textarea_field($_POST['post_content']);
            $image = $_FILES['post_image'];

            $post_data = [
                'post_title'   => $title,
                'post_content' => $content,
                'post_status'  => 'publish',
                'post_type'    => 'post',
            ];
            $post_id = wp_insert_post($post_data);

            if ($post_id && !is_wp_error($post_id)) {
                // Insere a imagem destacada
                require_once ABSPATH . 'wp-admin/includes/file.php';
                $upload = wp_handle_upload($image, ['test_form' => false]);
                if (!isset($upload['error'])) {
                    $attachment = [
                        'post_mime_type' => $upload['type'],
                        'post_title'     => sanitize_file_name($upload['file']),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    ];
                    $attachment_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
                    require_once ABSPATH . 'wp-admin/includes/image.php';
                    $attach_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
                    wp_update_attachment_metadata($attachment_id, $attach_data);
                    set_post_thumbnail($post_id, $attachment_id);

                    echo '<p style="color: green; text-align: center;">Post criado com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao enviar a imagem.</p>';
                }
            }
        }
    }
}

// Função para exibir o formulário com design de landing page
function display_custom_post_form() {
    ?>
    <div class="landing-page-container" style="font-family: Arial, sans-serif; padding: 40px; max-width: 800px; margin: auto; text-align: center;">
        <h1 style="color: #333; font-size: 2.5rem; margin-bottom: 20px;">Compartilhe Sua História</h1>
        <p style="color: #666; font-size: 1.1rem; margin-bottom: 30px;">
            Preencha o formulário abaixo para criar um post no blog e compartilhar sua experiência com nossa comunidade.
        </p>
        <form method="POST" enctype="multipart/form-data" style="background: #f9f9f9; border: 1px solid #ddd; border-radius: 10px; padding: 20px;">
            <div style="margin-bottom: 20px;">
                <label for="post_title" style="display: block; font-weight: bold; margin-bottom: 5px;">Título:</label>
                <input type="text" name="post_title" id="post_title" placeholder="Digite o título do post" required 
                       minlength="3" maxlength="100" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="post_content" style="display: block; font-weight: bold; margin-bottom: 5px;">Conteúdo:</label>
                <textarea name="post_content" id="post_content" placeholder="Escreva seu conteúdo aqui" required 
                          minlength="10" maxlength="1000" 
                          style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
            </div>
            <div style="margin-bottom: 20px;">
                <label for="post_image" style="display: block; font-weight: bold; margin-bottom: 5px;">Imagem:</label>
                <input type="file" name="post_image" id="post_image" accept="image/*" required 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <button type="submit" name="custom_post_submit" 
                    style="background-color: #0073aa; color: white; padding: 15px 20px; font-size: 1.1rem; border: none; border-radius: 5px; cursor: pointer;">
                Publicar Agora
            </button>
        </form>
    </div>
    <?php
}

// Processa o formulário antes de exibir o conteúdo
process_custom_post_form();

// Chama a função para exibir o formulário no lugar desejado
display_custom_post_form();
?>


<?php
// Garante que o arquivo não seja acessado diretamente.
if (!defined('ABSPATH')) {
    exit;
}
