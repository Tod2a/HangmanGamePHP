<?php

// Appliquer la déclaration stricte des types.
declare(strict_types=1);

function convert_word(string $word)
{
    $text = "";

    for ($i = 0; $i<strlen($word); $i++)
    {
        $text .= "_";
    };
    return $text;
};

?>