<?php

ini_set('display_errors', 'on');


// Connection au serveur
try {
    $dns = 'mysql:host=localhost;dbname=android-dev';
    $utilisateur = 'root';
    $motDePasse = 'Okirrchsim1';
    $connection = new PDO($dns, $utilisateur, $motDePasse);
    $connection->query("SET NAMES utf8");
} catch (Exception $e) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}

function generate_slug($str)
{
    $maxlen = 42;  //Modifier la taille max du slug ici
    $slug = strtolower($str);

    $slug = strtr($slug, 'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝ', 'AAAAAACEEEEEIIIINOOOOOUUUUY');
    $slug = strtr($slug, 'áàâäãåçéèêëíìîïñóòôöõúùûüýÿ', 'aaaaaaceeeeiiiinooooouuuuyy');
    $slug = preg_replace("/[^a-z0-9\s-]/", "", $slug);
    $slug = trim(preg_replace("/[\s-]+/", " ", $slug));
    $slug = preg_replace("/\s/", "-", $slug);

    return $slug;
}

$select = $connection->query("SELECT * FROM Article");
$select->setFetchMode(PDO::FETCH_OBJ);
$enregistrements = $select->fetchAll();

foreach ($enregistrements as $enregistrement) {

    $update = $connection->prepare('UPDATE Article SET slug = :slug WHERE id = :id');
    try {
        // On envois la requète
        $success = $update->execute(array(
            'id' => $enregistrement->id,
            'slug' => generate_slug($enregistrement->titre)
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
