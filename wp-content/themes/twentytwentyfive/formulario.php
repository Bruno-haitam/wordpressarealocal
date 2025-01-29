<?php

function process_custom_post_form() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['custom_post_submit'])) {
        $errors = []; 

        
        if (empty($_POST['post_title']) || strlen($_POST['post_title']) < 3 || strlen($_POST['post_title']) > 100) {
            $errors[] = 'O título deve ter entre 3 e 100 caracteres.';
        }

        
        if (empty($_POST['post_content']) || strlen($_POST['post_content']) < 10 || strlen($_POST['post_content']) > 1000) {
            $errors[] = 'O conteúdo deve ter entre 10 e 1000 caracteres.';
        }

      
        if (empty($_FILES['post_image']['name'])) {
            $errors[] = 'Você precisa selecionar uma imagem.';
        } else {
            $file_type = wp_check_filetype($_FILES['post_image']['name']);
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($file_type['type'], $allowed_types)) {
                $errors[] = 'Apenas imagens JPEG, PNG ou GIF são permitidas.';
            }
        }

        
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<p style="color: red; text-align: center;">' . $error . '</p>';
            }
        } else {
    
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


function display_custom_post_form() {
    ?>
    <style>
        
        .form-container {
            background: #1236;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        
        .submit-btn {
            background-color: #0073aa;
            color: white;
            padding: 15px 20px;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        
        .submit-btn:hover {
            background-color: #009be3;
            transform: scale(1.05);
        }
    </style>

    <div class="landing-page-container" style="font-family: Arial, sans-serif; padding: 40px; max-width: 800px; margin: auto; text-align: center;">
        <h1 style="color: #333; font-size: 2.5rem; margin-bottom: 20px;">Compartilhe Suas Conquistas</h1>
        <p style="color: #666; font-size: 1.1rem; margin-bottom: 30px;">
            Preencha o formulário abaixo para criar um post no blog e compartilhar suas experiências com nossa comunidade.
        </p>
        <form method="POST" enctype="multipart/form-data" class="form-container">
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
            <button type="submit" name="custom_post_submit" class="submit-btn">
                Publicar Agora
            </button>
        </form>
    </div>
    <?php
}


process_custom_post_form();


display_custom_post_form();
?>


<?php

if (!defined('ABSPATH')) {
    exit;
}
?>
