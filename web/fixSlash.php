<?php

ini_set('display_errors', 'on');


// Connection au serveur
try {
    $dns = 'mysql:host=localhost;dbname=android-dev';
    $utilisateur = 'root';
    $motDePasse = 'Okirrchsim1';
    $connection = new PDO($dns, $utilisateur, $motDePasse);
//    $connection->query("SET NAMES utf8");
} catch (Exception $e) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}

$select = $connection->query("SELECT * FROM Article");
$select->setFetchMode(PDO::FETCH_OBJ);
$enregistrements = $select->fetchAll();

foreach ($enregistrements as $enregistrement) {

    $update = $connection->prepare('UPDATE Article SET titre = :titre, sousTitre = :sousTitre, contenu = :contenu WHERE id = :id');
    try {
        // On envois la requète
        $success = $update->execute(array(
            'id' => $enregistrement->id, 
            'titre' => stripslashes($enregistrement->titre),
            'sousTitre' => stripslashes($enregistrement->sousTitre),
            'contenu' => stripslashes($enregistrement->contenu)
                ));

        if ($success) {
            echo "Enregistrement réussi";
        } else {
            print_r($insert->errorInfo()); //#1062 - Duplicate entry for key 'Section' (erreur MySQL)
        }
    } catch (Exception $e) {
        echo 'Erreur de requète : ', $e->getMessage();
    }
}
?>
