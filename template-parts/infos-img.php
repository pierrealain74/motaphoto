<?php

/**
 * Template Name: infos-img
 *
 * @package motaphotochild
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

 //Récupérer l'index de l'image dans l'url
 if (isset($_GET['index'])) {
    $index = $_GET['index'];
	$id_post = $_GET['id'];
	$categoryNameToSearch = $_GET['cat'];
}


get_header();


?>
<main id="primary" class="site-main">
	<script>
	// Définissez la variable themeDirectoryUri pour qu'elle soit accessible en JavaScript
	var themeDirectoryUri = "<?php echo get_stylesheet_directory_uri(); ?>";
	</script>

<!--////////////////////////////////////Carousel//////////////////////////////////////////////////////-->

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
							echo 'Année : 2021';
						echo '</p>';

						// ...
						break; // Sortir de la boucle car l'élément a été trouvé
					} 
				}

				?>

			</div>
				<!--Afficher la photo-->

			<figure class="item">
					<div class="rolloverImgInfos">
						<button class="btFullScreen"></button>
					</div> 
					<?php

					echo '<img src="' . $imageElement['thumbnail'] . '" alt="'. $imageElement['post_title'] .'" class="imgSrc" data-index="'.$index.'">';
					?>			
			</figure>
			<div class="contactImgInfos item">

				<p>Cette photo vous intéresse ?</p>
				<button class="btContact">Contact</button>

			</div>	
			<!--MINI SLIDER ******************************-->
			<div class="minislider item">
				
				<?php

					$indexMini = $index;
					$indexMini++;//On prend l'image suivante

					if($indexMini >= count($data)-1){ // si la photo principale est la derniere photo de la liste on repart à 0
					$index = 0;

					} 
					

					$imageElementNext = $data[$indexMini];
					echo '<img src="' . $imageElementNext['thumbnail'] . '" alt="'. $imageElementNext['post_title'] .'" class="imgminislider" data-index="'.$indexMini.'">';
				?>
				<button class="arrowblackNext">Suivant</button>
	   			<button class="arrowblackPrev">Precedent</button>

			</div>
			<div class="like item">Vous aimerez aussi...</div>
	</div><!--fin imgInfos-->
</div><!--Container-->
<?php 

//Afficher les photos de la meme categorie de la photo principale


include get_stylesheet_directory() . '/assets/php/like.php';//contient les fonctions pour créer un array avec uniquement les catégories de la photo principale ET fonciton de suppression de l'item photo principal (pour pas la répéter)

// Créer le tableau initial
$thumbnailsWithReferences = createThumbnailsWithReferences($data, $categoryNameToSearch);

// Obtenir l'id_post à enlever
$idPostToRemove = $_GET['id'];

// Filtrer le tableau pour enlever l'élément avec l'id_post spécifié
$thumbnailsFiltered = filterOutItemById($thumbnailsWithReferences, $idPostToRemove);

if($thumbnailsFiltered == null){
	echo '<div class="container"><section class="gallery"><p>&#128512; Pas de résultat !</p></section></div>';
}else{
	get_template_part('template-parts/portfolio', null, array('data' => $thumbnailsFiltered));
}

?>

<!--lightbox INFOS************Just afficher l'image en plein ecran******************-->
<div class="lightbox">    
    <div class="lightbox__container">
       <img src="" alt="" class="imgLightboxContainer">
       <button class="lightbox__close">Fermer</button>        
    </div>
</div>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/minislide.js"></script>
<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/lightbox-infos.js' ?>"></script>
</main><!-- #main -->
<?php
/* get_sidebar(); */
get_footer();
?>
