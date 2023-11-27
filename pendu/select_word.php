<?php

// Appliquer la déclaration stricte des types.
declare(strict_types=1);

define ("DS", DIRECTORY_SEPARATOR);

$cheminFichier = __DIR__ . DS . '..' . DS . 'data' . DS . 'dictionnaire.json';

$contenuJSON = file_get_contents($cheminFichier);

//crée le tableau $data avec tout les mots possibles.
$data = json_decode($contenuJSON, true);


function select_word(string $category, array $data)
{
    $answer = $category;
    if($category != 'nourriture' && $category != 'animaux' && $category != 'professions' && $category != 'sciences')
    {
        $answer = array_rand($data);
    }
    $rand = array_rand($data[$answer]);
    return $data[$answer][$rand];
};

?>