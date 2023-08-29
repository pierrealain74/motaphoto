<?php

/**
 * Template Name: a-propos
 *
 * @package apropos
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

 get_header();



 ?>
 <style>

main {

    height: 100vh;
}

 </style>
 <main id="primary" class="site-main">


    <div class="containerimgBlog">
        
    <h2>A propos</h2>
    
    
    <?php while (have_posts()) : the_post(); ?>


        <div class="grid-container">

            <?php
            $args = array(
                'post_type' => 'post',     // Afficher les articles de type "post"
                'posts_per_page' => 4,     // Afficher les 4 premiers articles
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                $post_count = 0;

                while ($query->have_posts()) {
                    $query->the_post();
                    // Afficher le titre, l'extrait, la date, le thumbnail et le lien vers l'article
                    if ($post_count === 0) {
                        // Premier article dans la colonne de gauche
                        echo '<div class="left-column">';
                        echo get_the_post_thumbnail();
                        the_title('<h2>', '</h2>');
                        the_excerpt();
                        the_date();

                        // Ajouter le thumbnail et le lien vers l'article
                        
                        echo '<a href="' . get_permalink() . '">Lire l\'article</a>';

                        echo '</div>';
                    } else {
                        // Trois articles suivants dans la colonne de droite
                        if ($post_count === 1) {
                            echo '<div class="right-column">';
                        }
                        
                        echo '<span class="right-item">';


                                echo get_the_post_thumbnail(null, 'thumbnail');
                                

                                // Ajouter le lien vers l'article
                                echo '<a href="' . get_permalink() . '"><h3>' . get_the_title() . '</h3></a>';




                        echo '</span>';
                    }

                    $post_count++;
                }

                if ($post_count > 1) {
                    echo '</div>'; // Fermer la div de la colonne de droite
                }
            } else {
                echo "Aucun article trouvé.";
            }

            wp_reset_postdata();
            ?>
        </div> <!-- Endof GRID CONTAINER DIV -->

<?php endwhile; ?>

    </div><!-- Endof containerimgBlog DIV -->
</main>

 <?php
/*  get_sidebar();*/
 get_footer(); 
 ?>

 
 
 
 
 
 