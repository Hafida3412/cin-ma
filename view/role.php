<?php 

ob_start(); ?><!--pour commencer la vue-->

<?php

$role = $requeteRole->fetch(); 
echo "- Rôle: ".$role["nom_role"];
echo "<br>";

$detailRole = $requeteDetailRole->fetchAll(); 
foreach($detailRole as $film) { 
    echo " - Acteur : " . $film["acteur"];  
    echo "<br>";
    echo "- Film : " . $film["film"]  . "<br> "; 
    echo "- Année de sortie en France: ". $film["annee_sortie_france"];
    echo "<br>";
    echo "- Note: ". $film["note"];
    echo "<br>";
    echo "<br>";
}



$titre = "Détail des rôles : " . $role["nom_role"];
$titre_secondaire = "Détail des rôles";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>*/