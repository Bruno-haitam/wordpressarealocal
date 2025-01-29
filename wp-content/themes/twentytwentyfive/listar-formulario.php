<?php
function display_custom_post_list()
{

    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 9,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    $query = new WP_Query($args);


    if ($query->have_posts()) {
?>
        <div class="landing-page-container" style="font-family: Arial, sans-serif; padding: 40px; max-width: 1200px; margin: auto; text-align: center; background-color: #1236; color: #fff; border-radius: 15px;">
            <h1 style="color: #fff; font-size: 2.5rem; margin-bottom: 20px;">Posts Recentes</h1>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; padding: 20px;">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    $thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : 'https://via.placeholder.com/300';

                ?>
                    <div class="post-card" style="background: #1a1a1a; padding: 20px; border-radius: 10px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);">
                        <div class="post-image-container" style="margin-bottom: 20px;">
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>" class="post-image"
                                style="width: 100%; height: 200px; border-radius: 10px; object-fit: cover; transition: transform 0.3s ease;">
                        </div>
                        <h2 style="font-size: 1.5rem; margin: 0 0 10px; color: #00d4ff;"><?php the_title(); ?></h2>
                        <p style="color: #aaa; font-size: 0.9rem; margin-bottom: 10px;"><?php echo get_the_date(); ?></p>
                        <p style="color: #fff; font-size: 1rem; margin: 10px 0;">
                            <?php echo wp_trim_words(get_the_content(), 20, '...'); ?>
                        </p>
                        <a href="<?php the_permalink(); ?>" class="read-more-btn">Leia mais</a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>


        <style>
            .post-image:hover {
                transform: scale(1.1);
            }
        </style>
    <?php
        wp_reset_postdata();
    } else {
    ?>
        <div class="landing-page-container" style="font-family: Arial, sans-serif; padding: 40px; max-width: 800px; margin: auto; text-align: center; background-color: #1236; color: #fff; border-radius: 15px;">
            <h1 style="color: #fff; font-size: 2.5rem; margin-bottom: 20px;">Posts Recentes</h1>
            <p style="color: #fff; font-size: 1.1rem;">Nenhum post foi encontrado. Seja o primeiro a compartilhar uma história!</p>
        </div>

        <style>
            .post-image:hover {
                transform: scale(1.1);
            }


            .read-more-btn {
                display: inline-block;
                padding: 10px 15px;
                color: #00d4ff;
                text-decoration: none;
                font-weight: bold;
                border: 2px solid #00d4ff;
                border-radius: 5px;
                transition: all 0.3s ease;
            }


            .read-more-btn:hover {
                background-color: #00d4ff;
                color: #1a1a1a;
                transform: scale(1.05);
            }
        </style>
<?php
    }
}





display_custom_post_list();

?>