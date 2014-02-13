<?php

//var_dump($_GET['billet']);

if (isset($_GET['billet']) and isset($_GET['titre']))
{
$redirig="http://www.android-dev.fr/web/blog/voir/".$_GET['billet']."?titre=".$_GET['titre'];


header("Status: 301 Moved Permanently", false, 301);
header("Location: ".$redirig);
exit();
}
else {

header("Location: http://www.android-dev.fr/web/blog");
}
?>
