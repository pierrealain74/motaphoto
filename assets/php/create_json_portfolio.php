<?php

/** 
 * Generate an Array in JSON File
 * All portfolio (acf) thumbnails & title
 * For diplaying in portfolio
 */

$args = array(
    'post_type' => 'portfolio',//Prends les portfolios
    'posts_per_page' => -1 //Prends tous les portfolios

);

/*Requete Wordpress des Portfolio*/
$photo_query = new WP_Query($args);

$counter = 0;

while ($photo_query -> have_posts()) {

    $photo_query->the_post();

    //Recupérer toutes les références
    $reference_terms = get_the_terms(get_the_ID(), 'reference');
    $reference_values = array();
    if ($reference_terms && !is_wp_error($reference_terms)) {
    foreach ($reference_terms as $term) {
        $reference_values[] = $term->name; // obtenir la valeur des références des portfolio
    }
    }

     //Recupérer tous les types
     $types_terms = get_the_terms(get_the_ID(), 'type');
     $types_values = array();
     if ($types_terms && !is_wp_error($types_terms)) {
     foreach ($types_terms as $type) {
         $type_values[] = $type->name; // obtenir la valeur des types des portfolio
     }
     }
 


  
    //Créer un array complet de toutes les datas des post
    $post_data = array(
        'id_post' => get_the_ID(),
        'post_title' => get_the_title(),
        'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
        'category' => get_the_category(),// Cat = television, concert,..
        'tags' => get_the_tags(),//Tags = paysage,..
        'type' => $type_values,//Types : Numérique,..
        'reference' =>  $reference_values,//taxonomie Reference = bf2395,..
    );
    $data[] = $post_data; 


    $counter++;
}


/*Creation du fichier JSON*/
$json_data = json_encode($data);
$file_path = get_stylesheet_directory() . '/assets/json/portfolio-data.json';
file_put_contents($file_path, $json_data);

