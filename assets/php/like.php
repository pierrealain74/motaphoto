<?php
//Crée un tableau de portoflio de la categorie donnée
function createPortfolioCategorized($data, $categoryNameToSearch) {
    $data_categorized = [];

    foreach ($data as $item) {
        $categories = $item['category'];

        foreach ($categories as $category) {
            if ($category['name'] === $categoryNameToSearch) {
                $thumbnail = $item['thumbnail'];
                $reference = $item['id_post'];
                $post_title = $item['post_title'];
                $id_post = $item['id_post'];
                $tags = $item['tags'];
                $cat2 = $item['category'];

                $data_categorized[] = [
                    'thumbnail' => $thumbnail,
                    'reference' => $reference,
                    'post_title' => $post_title,
                    'id_post' => $id_post,
                    'tags' => $tags,
                    'category' => $cat2,
                ];
                break;
            }
        }
    }

    return $data_categorized;
}

//Supprimer la photo principale (deja affichée en haut de la page) du tableau $thumbnailsWithReferences
//
function filterOutItemById($array, $idToRemove) {
    $filteredArray = [];

    foreach ($array as $item) {
        if (isset($item['id_post']) && $item['id_post'] != $idToRemove) {
            $filteredArray[] = $item;
        }
    }

    return $filteredArray;
}
?>