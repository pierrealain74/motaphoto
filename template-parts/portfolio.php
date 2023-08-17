<?php

//Recupere un array JSON des portfolios : toutes les photos (defaut), OU que les catégories selectionnées, OU que les tags...

//$data = $args['data'];//recupere le tableau data qui est créé dans home.php

/* 

$data_json = isset($_POST['data']) ? $_POST['data'] : '';
/* $data = json_decode(stripslashes($data_json), true); */
/* 
$data = json_decode($data_json, true); */



$data = $args['data'];
/* var_dump('var dump de data dans portfolio : ', $data); */
$firstFourItems = array_slice($data, 0, 4);// Decoupe en 4 1ers item pour Load More




echo '<div class="container"><section class="gallery">';





$keyImg = 0;


/*********************************************************/
//Lis le tableau JSON images portfolio
foreach($firstFourItems as $item){

    echo '<figure><div class="rolloverImg">';

   
    //Rollover texte Category
    echo '<span class="rolloverImg-category">';
    foreach ($item['category'] as $category) {
        echo $category['name'];
    }

    echo '</span>';

    ////Rollover texte Reference
    echo '<span class="rolloverImg-reference">';
    foreach ($item['tags'] as $tags) {
        echo $tags['name'];
    }

    echo '</span>';

    //ROLLOVER sur image : ICON fullscreen + eye 
    echo '<button class="rolloverImg-fullscreen"></button><a href="infos-photo/?id='.$item['id_post'].'&cat='. $category['name'] .'&index='.$keyImg.'" class="rolloverImg-eye"></a></div>';

    /* IMAGE DE LA GALLERY **************************/
    //Afficher Images portfolio
    echo '<img src="' . $item['thumbnail'] . '" class="img-gallery" alt="' . $item['post_title'] . '" id="'.$item['id_post'].'" data-index="'.$keyImg.'" /></figure>';

    $keyImg++;

}

echo '</section></div><section class="containerLoadMore"><button class="contactImgInfos loadmoreClass" id="btloadMore">Charger +</button></section>';
?>

<!--********************* TEMPLATE LIGHTBOX ********************* -->
<div class="lightbox">    
    <button class="lightbox__next">Suivant</button>
    <button class="lightbox__prev">Précédent</button>
    <div class="lightbox__container">
       <img src="" alt="" id="imgLightboxContainer">
       <div class="lightbox-infos"><span class="lightbox-category">category</span><span class="lightbox-reference">reference</span></div>
       <button class="lightbox__close">Fermer</button>        
    </div>
</div>

<!--********************* JS LOGIQUE *************************************-->
<!-- <script>
    var item = <?php //echo json_encode($data); ?>// charger le json pour les javascript
</script> -->



<!-----LE LOAD MORE DOIT ETRE APPELE VIA SA FONCTION SINON SE LANCE PAS-------->


<!-- <script src="<?php //echo get_stylesheet_directory_uri().'/assets/js/loadMore.js' ?>"></script> -->


<script src="<?php echo get_stylesheet_directory_uri().'/assets/js/lightbox.js' ?>"></script>

