<?php

/**
 * Template Name: infos-img
 *
 * @package motaphotochild
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */


 //Verifier si le fichier Json Portfolio default n'est pas vide 
$jsonfile = get_stylesheet_directory() . '/assets/json/portfolio-data.json';

//Crée le JSON portfolio si il est vide
if (empty(file_get_contents($jsonfile))) {
    save_portfolio_update_json();
}


 //Récupérer l'index de l'image dans l'url
 if (isset($_GET['index'])) {
    $index = $_GET['index'];
	$id_post = $_GET['id'];
	$postdate = $_GET['postdate'];
	$categoryNameToSearch = $_GET['cat'];
}


get_header();
?>
<main id="primary" class="site-main">

<script>
// Définissez la variable themeDirectoryUri pour qu'elle soit accessible en JavaScript
var themeDirectoryUri = "<?php echo get_stylesheet_directory_uri(); ?>";
</script>




<?php

	//Affichage de la photo cliquée dans la home
	//Ouvre le fichier JSON 

	$json_data = file_get_contents(get_stylesheet_directory() . '/assets/json/portfolio-data.json');
	$data = json_decode($json_data, true);
?>





<div class="containerimgInfos">
	<div class="imgInfos">
		
			<div class="txt item">

				<?php

				//var_dump($data);
				//Afficher dans DIV TXT = titre, categorie, type,.. d'une photo
			

				foreach ($data as $imageElement) {


					/* 	echo $imageElement['id_post']; */


					 if ($imageElement['id_post'] == $id_post) {
		
						echo '<span class="titleimgInfos">' . $imageElement['post_title'].'</span>';
						echo '<p class="taxonomyimgInfos">';
							echo '<span class="ref">Reference : '.$imageElement['reference'][0].'</span><br />';
							echo '<span class="cat">Catégorie : '.$imageElement['category'][0]['name'].'</span><br />';
							echo 'Format : '.$imageElement['tags'][0]['name'].'<br />';
							echo 'Type : '.$imageElement['type'][0].'<br />';
							echo 'Année : '.$imageElement['post_date'];
						echo '</p>';

						// ...
						break; // Sortir de la boucle car l'élément a été trouvé
					} 
				}
				?>

			</div>
				<!--Afficher la photo sur la partie de droite -->

			<figure class="item">
				
					<div class="rolloverImgInfos">
						<button class="rolloverImg-fullscreenInfos"></button>
					</div> 
					<?php

					echo '<img src="' . $imageElement['thumbnail_mediumlarge'] . '" alt="'. $imageElement['post_title'] .'" class="imageInfos" data-index="'.$index.'" postdate="'.$imageElement['post_date'].'">';
					?>			
			</figure>
			<div class="contactImgInfos item">

				<p>Cette photo vous intéresse ?</p>
				<button class="btContact">Contact</button>

			</div>	
			<!--MINI SLIDER ******************************-->
			<div class="minislider item">

				<div class="rolloverArrowSlider"><img src="" alt="" /></div>
				<button class="arrowblackNext">Suivant</button>
	   			<button class="arrowblackPrev">Precedent</button>

			</div>



			<div class="like item">Vous aimerez aussi...</div>



	</div><!--fin imgInfos-->
</div><!--Container-->

<?php 

get_template_part('template-parts/tmp_lightboxInfo');
get_template_part('template-parts/tmp_lightbox');
?>

<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/minislide.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/lightbox-infos.js' ?>"></script>

<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/portfolio.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/loadmore.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/lightbox.js' ?>"></script>


</main><!-- #main -->
<?php
/* get_sidebar(); */
get_footer();
?>
