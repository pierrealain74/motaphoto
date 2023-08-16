<?php

//Declarer le theme enfant 
add_action( 'wp_enqueue_scripts', 'motaphotochild_enqueue_styles' );
function motaphotochild_enqueue_styles() {

    wp_enqueue_style( 'motaphoto', get_template_directory_uri() . '/style.css' );

}

/* Insertion code JS Menu Responsive CLICK sur burger / X 

      NE FONCTIONNE PAAAAAAAAAAAAAAAS !!!!!!!!!!!!!!!!!!!!

      POSE DANS FOOTER
*/
/* add_action('wp_enqueue_scripts', 'enqueue_menu_script');
function enqueue_menu_script() {
    // Enregistre le script 'menu' et l'ajoute à la file d'attente
    wp_enqueue_script('menu', get_stylesheet_directory_uri() . '/assets/js/menu.js', array(), null, true);
}
 */
/** Portfolio Post Type - Without ACF - */
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



    //******************************************** */ Ajouter une taxonomie personnalisée "Référence"
    $args_taxonomy = array(
        'hierarchical'      => false, // Si vous souhaitez que les termes soient hiérarchiques comme les catégories, mettez à 'true'
        'public'            => true,
        'show_in_rest'      => true, // Pour utiliser l'éditeur Gutenberg
        'labels'            => array(
            'name'              => 'Références', // Nom de la taxonomie
            'singular_name'     => 'Référence',
            'menu_name'         => 'Références', // Nom affiché dans le menu
            'all_items'         => 'Toutes les Références', // Tous les termes
            'edit_item'         => 'Modifier Référence', // Modifier un terme
            'view_item'         => 'Voir Référence', // Voir un terme
            'update_item'       => 'Mettre à jour Référence', // Mettre à jour un terme
            'add_new_item'      => 'Ajouter une nouvelle Référence', // Ajouter un nouveau terme
            'new_item_name'     => 'Nom du nouveau Référence', // Nom du nouveau terme
            'search_items'      => 'Rechercher des Références', // Rechercher des termes
            'popular_items'     => 'Références populaires', // Termes populaires
            'separate_items_with_commas' => 'Séparer les Références par des virgules',
            'add_or_remove_items'        => 'Ajouter ou supprimer des Références',
            'choose_from_most_used'      => 'Choisir parmi les Références les plus utilisées',
            'not_found'                  => 'Aucune Référence trouvée',
        ),
        'rewrite'           => array( 'slug' => 'references' ), // Permalien (URL) pour la taxonomie
    );

    // Enregistrement de la taxonomie personnalisée "Référence"
    register_taxonomy( 'reference', 'portfolio', $args_taxonomy );


/************************************* */


    // Ajouter une taxonomie personnalisée "Type"
    $args_taxonomy = array(
        'hierarchical'      => false, // Si vous souhaitez que les termes soient hiérarchiques comme les catégories, mettez à 'true'
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



/* MAJ du fichier JSON Portfolio */
// Fonction personnalisée pour exécuter votre programme
function save_portfolio_update_json() {
    // Vérifie si le formulaire est soumis
    if (isset($_POST['post_type']) && $_POST['post_type'] === 'portfolio') {

        require_once get_stylesheet_directory() . '/assets/php/create_json_portfolio.php';

    }
}
add_action('wp_loaded', 'save_portfolio_update_json');

//Js avec evenlistener sur le select categorie
function ajax_request()
{

    if (is_home()) {

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

function get_portfolio_items() {


    $selected_category = $_GET['category'];
    //var_dump($selected_category);

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

    $portfolio_query = new WP_Query($args);

    $portfolio_items = array();

    $counter = 0;

    while ($portfolio_query -> have_posts()) {
    
        $portfolio_query->the_post();
    
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
        $firstFourItems = array_slice($data, 0, 4);
    
        //wp_reset_postdata();
        $counter++;
    }
    
    // Retournez les données au format JSON
    wp_send_json($firstFourItems);
}


