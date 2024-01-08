<?php

function lis_questions_json($fichier_json)
{
    $json = file_get_contents($fichier_json);
    $json = json_decode($json, true);
    return $json;
}

function lis_questions_csv($fichier_csv)
{
    $fichier = fopen($fichier_csv, 'r');
    $questions = [];
    while ($ligne = fgetcsv($fichier)) {
        $questions[] = $ligne;
    }
    fclose($fichier);
    return $questions;
}


?>

