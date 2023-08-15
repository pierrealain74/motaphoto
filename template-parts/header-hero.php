<?php 


// Récupérer l'ID de la page d'accueil
$homepage_id = get_option('page_on_front');

// Récupérer la vignette (thumbnail) de la page d'accueil
$thumbnail_full = wp_get_attachment_image_src( get_post_thumbnail_id($homepage_id), 'full' );
 // Changer 'thumbnail' par le nom de la taille d'image souhaitée

// Afficher la vignette si elle existe
if ($thumbnail_full) {
  echo '<div class="image-home-background" style="background-image:url(' . $thumbnail_full[0] . ')"><div class="title-header">Photographe event</div></div>';
}
else {
  echo '<div class="image-home-background" style="background-image: url(' . get_stylesheet_directory_uri() . '/assets/img/header.png)"></div>';

}


?>
