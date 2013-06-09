<?php

ini_set('display_errors', 'on');

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

$handle = fopen('Article.csv', 'r+');

$csv = fgetcsv($handle, 100000000, ';', '"');
$csv = fgetcsv($handle, 100000000, ';', '"');

while ($csv != false) {
    if ($csv[2] != 3) {
        $sql = 'SELECT id, nom
                FROM Categorie
                WHERE nom =  :nom';
        $sth = $connection->prepare($sql);
        $sth->execute(array(':nom' => $csv[3]));

        $trouve = 0;
        while ($cat = $sth->fetch()) {
            var_dump($cat['nom']);
            var_dump($csv[3]);
            if ($cat['nom'] == $csv[3]) {
                $update = $connection->prepare('UPDATE Article SET Categorie_id = :idCat, Type_id = :idType WHERE id = :id');
                try {
                    // On envois la requète
                    $success = $update->execute(array(
                        'id' => $csv[0],
                        'idCat' => $cat['id'],
                        'idType' => $csv[2]
                    ));
                    $trouve = 1;
                    if ($success) {
                        echo "Enregistrement réussi";
                    } else {
                        print_r($success->errorInfo()); //#1062 - Duplicate entry for key 'Section' (erreur MySQL)
                    }
                } catch (Exception $e) {
                    echo 'Erreur de requète : ', $e->getMessage();
                }
            }
        }
//        if ($trouve == 0) {
//            $insert = $connection->prepare('INSERT INTO Categorie (nom, slug) VALUES(:nom, :slug)');
//            try {
//                // On envois la requète
//                $success = $insert->execute(array(
//                    'nom' => $csv[3],
//                    'slug' => generate_slug($csv[3])
//                ));
//
//                if ($success) {
//                    echo "Enregistrement réussi";
//                } else {
//                    print_r($insert->errorInfo()); //#1062 - Duplicate entry for key 'Section' (erreur MySQL)
//                }
//            } catch (Exception $e) {
//                echo 'Erreur de requète : ', $e->getMessage();
//            }
//        }
//
//
//        $sql = 'SELECT id, nom
//                FROM Categorie
//                WHERE nom =  :nom';
//        $sth = $connection->prepare($sql);
//        $sth->execute(array(':nom' => $csv[3]));
//
//        while ($cat = $sth->fetch()) {
//            if ($cat['nom'] == $csv[2]) {
//                $update = $connection->prepare('UPDATE Article SET Categorie_id = :idCat, Type_id = idType WHERE id = :id');
//                try {
//                    // On envois la requète
//                    $success = $update->execute(array(
//                        'id' => $csv[0],
//                        'idCat' => $cat['id'],
//                        'idType' => $csv[2]
//                    ));
//                    if ($success) {
//                        echo "Enregistrement réussi";
//                    } else {
//                        print_r($success->errorInfo()); //#1062 - Duplicate entry for key 'Section' (erreur MySQL)
//                    }
//                } catch (Exception $e) {
//                    echo 'Erreur de requète : ', $e->getMessage();
//                }
//            }
//        }
    }
    $csv = fgetcsv($handle, 100000000, ';', '"');
}
?>
