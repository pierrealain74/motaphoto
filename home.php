<?php

/**
 * Template Name: Home
 *
 * @package motaphotochild
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
 //Verifier si le fichier Json Portfolio default n'est pas vide 
$jsonfile = get_stylesheet_directory() . '/assets/json/portfolio-data.json';

//Creation du JSON si JSON Vide : en cas de migration par exemple
if (empty(file_get_contents($jsonfile))) {
    save_portfolio_update_json();
}
get_header();
?>
<main id="primary" class="site-main">


<script>
// Variable themeDirectoryUri accessible en JavaScript
var themeDirectoryUri = "<?php echo get_stylesheet_directory_uri(); ?>";
</script>
<?php

	//Header
	get_template_part('template-parts/header-hero'); 

	/*///////////////////////////////////  CAROUSEL  ////////////////////////////////////////////*/

	//START : Get All portfolio Datas via JSON file
	$json_data = file_get_contents(get_stylesheet_directory() . '/assets/json/portfolio-data.json');
	$data = json_decode($json_data, true);
	//var_dump('json par defaut : ', $data);

?>

<script>
    var item = <?php echo json_encode($data); ?>// charger le json pour les javascript
</script>

<?php	
	
	//Liste deroulantes : selection d'une catégorie ou tags
	get_template_part('template-parts/filters', null, array('data' => $data));
	
	//Template lightbox
	

	//Template portfolio
/* 	get_template_part('template-parts/portfolio', null, array('data' => $data)); */

	get_template_part('template-parts/tmp_lightbox');
	
?>

<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/portfolio.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/loadmore.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/lightbox.js' ?>"></script>




</main>

<?php
/* get_sidebar(); */
get_footer();
?>