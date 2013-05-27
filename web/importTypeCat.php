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

$select = $connection->query("SELECT * FROM Article2");
$select->setFetchMode(PDO::FETCH_OBJ);
$enregistrements = $select->fetchAll();

foreach ($enregistrements as $enregistrement) {
    
    $insert = $connection->prepare('INSERT INTO Article (id, titre, sousTitre, contenu, created, updated, Type_id, Auteur_id) VALUES(:id, :titre, :sousTitre, :contenu, :created, :updated, :type, :auteur)');
    try {
        // On envois la requète
        $success = $insert->execute(array(
            'id' => $enregistrement->id,
            'titre' => $enregistrement->titre,
            'sousTitre' => $enregistrement->description,
            'contenu' => $enregistrement->contenu,
            'created' => $enregistrement->dateCreation,
            'updated' => $enregistrement->dateModification,
            'type' => $enregistrement->type_id,
            'auteur' => 1
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
