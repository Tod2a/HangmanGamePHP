<?php
/*
    Fonction principale du jeu du pendu...

    N'hésitez pas à utiliser d'autres fichiers avec les outils d'importation appropriés.

    Il se peut que vous ayez besoin d'utiliser des fonctions prédéfinies que nous n'avons pas vues.

    Voici quelques fonctions dont vous pourriez avoir besoin : 
        array_rand() : permet de sélectionner une clé de tableau aléatoirement.
        array_search() : permet de vérifier si une valeur existe dans un tableau.
        isset() : permet de vérifier si un élément existe.
        strlen() : permet de connaître le nombre de caractères présent dans une chaîne.
        strpos() : permet de savoir si un caractère est présent dans une chaîne.
        str_repeat() : permet de répéter un nombre défini de fois un même caractère.
        range() : permet de génèrer une séquence de nombres ou de caractères sous forme de tableau.

    https://www.php.net/manual/fr/
*/

// Appliquer la déclaration stricte des types.
declare(strict_types=1);

require_once 'select_word.php';
require_once 'convert_word.php';

function play_game ()
{
    echo "Choississez la catégorie dans laquelle vous voulez jouer : animaux, professions, nourriture ou sciences." . PHP_EOL;
    echo "Si vous voulez plus de challenge, n'en choississez aucune!" . PHP_EOL;
    $choice = readline();

    define ("DS", DIRECTORY_SEPARATOR);

    $cheminFichier = __DIR__ . DS . '..' . DS . 'data' . DS . 'dictionnaire.json';

    $contenuJSON = file_get_contents($cheminFichier);

    //crée le tableau $data avec tout les mots possibles.
    $data = json_decode($contenuJSON, true);

    $word = select_word($choice, $data);
    $answer = $word;

    $maxTry = 15;
    $try = convert_word($word);
    $count = strlen($word);
    $tested = "";

    echo $word;
    do
    {
        echo 'voici le mot à deviner, il vous reste ' . $maxTry . ' tentatives' . PHP_EOL;
        echo $try . PHP_EOL;
        echo 'voici les lettres que vous avez essayées : ' . $tested . PHP_EOL;
        echo 'entrez une lettre';
        $letter = strval(readline());
        $maxTry--;

        while (strpos($word, $letter) > -1)
        {
            $i = strpos($word, $letter);
            $try[$i] = $letter;
            $word[$i] = "_";
            $count--;
        }

        $tested .= ($letter . " ");

        if ($maxTry == 0 && $count != 0)
        {
            echo 'Il ne reste plus d\'essais, vous avez perdu, le mot à deviner était :' . $answer . PHP_EOL;
            break;
        }

    } while ($count > 0);

    if ($count == 0)
    {
        echo "c'est gagné! vous avez trouvé le mot à deviner qui était " . $answer . " en " . (15 - $maxTry) . " essais";
    }
}

?>