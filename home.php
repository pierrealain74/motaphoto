<?php

/**
 * Template Name: Home
 *
 * @package motaphotochild
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

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

?>

<script>
    var item = <?php echo json_encode($data); ?>// charger le json pour les javascript
</script>

<?php	
	
	//Liste deroulantes : selection d'une catégorie ou tags
	get_template_part('template-parts/filters', null, array('data' => $data));	

	//Template portfolio
/* 	get_template_part('template-parts/portfolio', null, array('data' => $data)); */
	
?>
<div class="lightbox">    
    <button class="lightbox__next">Suivant</button>
    <button class="lightbox__prev">Précédent</button>
    <div class="lightbox__container">
       <img src="" alt="" id="imgLightboxContainer">
       <div class="lightbox-infos"><span class="lightbox-category">category</span><span class="lightbox-reference">reference</span></div>
       <button class="lightbox__close">Fermer</button>        
    </div>
</div>


<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/portfolio.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/loadmore.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/lightbox.js' ?>"></script>




</main>

<?php
/* get_sidebar(); */
get_footer();
?>