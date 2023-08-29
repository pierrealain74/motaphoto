<?php

//Declarer le theme enfant 
add_action( 'wp_enqueue_scripts', 'motaphotochild_enqueue_styles' );
function motaphotochild_enqueue_styles() {

    wp_enqueue_style( 'motaphoto', get_template_directory_uri() . '/style.css' );

}


/** Creation of Custom Post Type : Portfolio   *********************************/ 
function portfolio_post_type() {

    $labels = array(
        'name'               => 'Portfolio', // Nom du CPT affiché dans la barre latérale
        'singular_name'      => 'Portfolio',
        'menu_name'          => 'Portfolio',
        'add_new'            => 'Ajouter',
        'add_new_item'       => 'Ajouter Portfolio',
        'edit_item'          => 'Modifier Portfolio',
        'new_item'           => 'Nouveau Portfolio',
        'view_item'          => 'Voir Portfolio',
        'all_items'          => 'Tous les Portfolios',
        'search_items'       => 'Rechercher des Portfolio',
        'not_found'          => 'Aucun Portfolio trouvé',
        'not_found_in_trash' => 'Aucun Portfolio trouvé dans la corbeille',
        'parent_item_colon'  => '',
        'menu_icon'          => 'dashicons-star-filled', // Icône du CPT affichée dans la barre latérale
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'menu_position'       => 5, // Position dans la barre latérale (plus petit = plus haut)
        'show_in_menu'        => true, // Afficher dans la barre latérale
        'menu_icon'           => 'dashicons-star-filled', // Icône du CPT affichée dans la barre latérale
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'          => array( 'post_tag', 'category' )
    );

    register_post_type( 'portfolio', $args ); // 'mon_cpt' est le slug du CPT

    register_meta( 'post', 'portfolio_client', array(
        'show_in_rest' => false,
        'single'       => true,
        'type'         => 'string',
    ) );



    //************Ajout d'une taxonomie personnalisée "Référence"*********************************/ 
    $args_taxonomy = array(
        'hierarchical'      => false, 
        'public'            => true,
        'show_in_rest'      => true, 
        'labels'            => array(
            'name'              => 'Références', // Nom de la taxonomie
            'singular_name'     => 'Référence',
            'menu_name'         => 'Références', // Nom affiché dans le menu
            'all_items'         => 'Toutes les Références', 
            'edit_item'         => 'Modifier Référence', 
            'view_item'         => 'Voir Référence', 
            'update_item'       => 'Mettre à jour Référence', 
            'add_new_item'      => 'Ajouter une nouvelle Référence', 
            'new_item_name'     => 'Nom du nouveau Référence', 
            'search_items'      => 'Rechercher des Références', 
            'popular_items'     => 'Références populaires', 
            'separate_items_with_commas' => 'Séparer les Références par des virgules',
            'add_or_remove_items'        => 'Ajouter ou supprimer des Références',
            'choose_from_most_used'      => 'Choisir parmi les Références les plus utilisées',
            'not_found'                  => 'Aucune Référence trouvée',
        ),
        'rewrite'           => array( 'slug' => 'references' ), // Permalien (URL) pour la taxonomie
    );

    // Enregistrement de la taxonomie personnalisée "Référence"
    register_taxonomy( 'reference', 'portfolio', $args_taxonomy );


/*********Ajouter une taxonomie personnalisée "Type"**************************** */    
    $args_taxonomy = array(
        'hierarchical'      => false, 
        'public'            => true,
        'show_in_rest'      => true, // Pour utiliser l'éditeur Gutenberg
        'labels'            => array(
            'name'              => 'Type', // Nom de la taxonomie
            'singular_name'     => 'Type',
            'menu_name'         => 'Types', // Nom affiché dans le menu
            'all_items'         => 'Tous les Types', 
            'edit_item'         => 'Modifier Type', 
            'view_item'         => 'Voir Type', 
            'update_item'       => 'Mettre à jour Type', 
            'add_new_item'      => 'Ajouter une nouveau Type', 
            'new_item_name'     => 'Nom du nouveau Type', 
            'search_items'      => 'Rechercher des Types', 
            'popular_items'     => 'Types populaires', 
            'separate_items_with_commas' => 'Séparer les Types par des virgules',
            'add_or_remove_items'        => 'Ajouter ou supprimer des Types',
            'choose_from_most_used'      => 'Choisir parmi les Types les plus utilisés',
            'not_found'                  => 'Aucune Type trouvé',
        ),
        'rewrite'           => array( 'slug' => 'types' ), // Permalien (URL) pour la taxonomie
    );

    // Enregistrement de la taxonomie personnalisée "Référence"
    register_taxonomy( 'type', 'portfolio', $args_taxonomy );

}
add_action( 'init', 'portfolio_post_type' );



function save_portfolio_update_json($post_id = null) {
    // Si $post_id n'est pas fourni, on vérifie le type de post en cours de traitement
    if ($post_id === null || get_post_type($post_id) === 'portfolio') {
        require_once get_stylesheet_directory() . '/assets/php/create_json_portfolio.php';
        
    }
}

// Action lors de la sauvegarde/mise à jour d'un post
add_action('save_post', 'save_portfolio_update_json');

// Action lors de la suppression d'un post
add_action('delete_post', 'save_portfolio_update_json');

// Action lors de la création d'un post
add_action('wp_insert_post', 'save_portfolio_update_json');


//Js avec evenlistener sur le select categorie
function ajax_request()
{

    if (is_front_page()) {

        // Define the URL for your AJAX endpoint
        $ajax_url = admin_url('admin-ajax.php');

        wp_enqueue_script('ajaxrequest', get_stylesheet_directory_uri() . '/assets/js/inputselect.js');
        wp_localize_script('ajaxrequest', 'ajax_object', array('ajax_url' => $ajax_url));

    }
}
add_action('wp_enqueue_scripts', 'ajax_request');




/***************** Traiter requete AJAX
 *  logique pour gérer la requête AJAX et récupérer les éléments du portfolio en fonction de la catégorie sélectionnée
 * 
 */
// Créez une fonction pour gérer la requête AJAX
add_action('wp_ajax_get_portfolio_items', 'get_portfolio_items');
add_action('wp_ajax_nopriv_get_portfolio_items', 'get_portfolio_items');


//Selectionne la bonne variable si c'est Category ou Format
function get_portfolio_items() {


    $selected_category = $_GET['category'];
    $selected_format = $_GET['format'];
    $selected_sort = $_GET['sort'];
    //var_dump($selected_category);

    // Choisissez la clé de taxonomie en fonction de la situation
    $taxonomy_key = !empty($selected_category) ? 'category' : (!empty($selected_format) ? 'post_tag' : '');

    //var_dump('taxonomy : ', $taxonomy_key);


    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
        'tax_query' => array(),
    );
    
    if (!empty($taxonomy_key)) {
        $args['tax_query'][] = array(
            'taxonomy' => $taxonomy_key,// choix category / format
            'field' => 'name', // Utilisez 'term_id', 'slug' ou 'name' en fonction de ce que vous avez
            'terms' => !empty($selected_category) ? $selected_category : $selected_format,// mariage, concert / paysage, portrait
        );
    }


   /*  
   
   Requete pour juste le select category  - avant le rajout des deux autres select
   $args = array(
        'post_type' => 'portfolio', // Remplacez par le nom de votre custom post type
        'posts_per_page' => -1, // Récupère tous les éléments
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Remplacez par la taxonomie de catégorie appropriée
                'field' => 'name', // Utilisez 'term_id', 'slug' ou 'name' en fonction de ce que vous avez
                'terms' => $selected_category,
            ),
        ),
    );
 */
    
 
    //Requete Wordpress
    $portfolio_query = new WP_Query($args);
    //var_dump('requete wp_query : ', $portfolio_query);


    $counter = 0;
    if ($portfolio_query->have_posts()) {

        while ($portfolio_query->have_posts()) {

            $portfolio_query->the_post();

            $id_post = get_the_ID();
            $post_date = get_the_date('Y-m-d H:i:s', $id_post);

            //Recupérer toutes les références
            $reference_terms = get_the_terms($id_post, 'reference');
            $reference_values = array();
            if ($reference_terms && !is_wp_error($reference_terms)) {
                foreach ($reference_terms as $term) {
                    $reference_values[] = $term->name; // obtenir la valeur des références des portfolio
                }
            }

            //Recupérer tous les types
            $types_terms = get_the_terms($id_post, 'type');
            $types_values = array();
            if ($types_terms && !is_wp_error($types_terms)) {
                foreach ($types_terms as $type) {
                    $type_values[] = $type->name; // obtenir la valeur des types des portfolio
                }
            }


            //Créer un array complet de toutes les datas des post
            $post_data = array(
                'id_post' => $id_post,
                'post_title' => get_the_title(),
                'post_date' => $post_date,
                'thumbnail' => get_the_post_thumbnail_url($id_post, 'full'),
                'thumbnail_mediumlarge' => get_the_post_thumbnail_url($id_post, 'medium_large'),
                'category' => get_the_category(), // Cat = television, concert,..
                'tags' => get_the_tags(), //Tags = paysage,..
                'type' => $type_values, //Types : Numérique,..
                'reference' => $reference_values, //taxonomie Reference = bf2395,..
            );
            $data[] = $post_data;
            //$firstFourItems = array_slice($data, 0, 4);

            //wp_reset_postdata();
            $counter++;
        }
        
        wp_send_json($data);
        wp_reset_postdata();// vide la requete
    }
    else {
        // Aucun résultat trouvé
        var_dump('Requete WPQuery vide...');
    }
    
    // Retournez les données au format JSON
    
}


