<?php 

/**Creation des select */

/* echo '<div class="container">'; // Container des Select */
echo '<div class="filters">'; // Container des Select








/************************ SELECT CATEGORIE **********************************************/

echo '<select id="categorySelect">';
echo '<option value="" selected>CATEGORIES</option>';

$data = $args['data'];// Le json complet de tous portfolio par defaut
$arrayAllCategory = [];

//Creation du tableau des categories uniques (toutes les cat uniques de portfolio par defaut)
foreach ($data as $item) {

    $categories = $item['category'];

    foreach ($categories as $category) {

        $cat = $category['name'];

        //Créer tableau simples
        $arrayAllCategory[] = $cat;

        //Créer tableau d'objets
        /* $arrayAllCategory[] = [
            'category' => $cat,
        ]; */
    
    }
}
/* $reindexedArray = array_values($arrayAllCategory); */
$arrayUniqueCategory = array_values(array_unique($arrayAllCategory));//unique = dedoublonne - arrayvalue = réordonne correctement les index

for ($i = 0; $i <= count($arrayUniqueCategory)-1; $i++){

    echo '<option value="'. $arrayUniqueCategory[$i] .'">' . $arrayUniqueCategory[$i] . '</option>';

}

echo '</select>';





/* var_dump($arrayAllCategory);
var_dump($arrayUniqueCategory); */

/**************************** SELECT TAGS (FORMAT) ********************************************/

echo '<select id="formatSelect">';
echo '<option value="" selected>FORMATS</option>';
echo '<option value="portrait">Portrait</option>';
echo '<option value="paysage">Paysage</option>';
echo '</select>';

/****************************** SELECT RECENT SORT ********************************************/

echo '<select id="sortSelect" style="float: right; margin-right:0">';
echo '<option value="" selected>TRIER PAR</option>';
echo '<option value="recent">Plus récent</option>';
echo '<option value="ancien">Plus ancien</option>';
echo '</select></div>';

?>


