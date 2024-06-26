<?php 
session_start();

$message = "Le genre a été ajouté avec succès.";
if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Effacer le message pour ne pas l'afficher à nouveau
}
ob_start(); ?><!--pour commencer la vue-->

<!--FORMULAIRE POUR RAJOUTER DES GENRES-->
<form action="index.php?action=ajouterGenre" method="post"> 
    <input type="hidden" name="action" value="ajouterGenre">
     <label for="nom_genre">Nom du genre:</label> 
     <input type="text" id="nom_genre" name="nom_genre"> 
     <button type="submit" name="submit">Ajouter le genre</button> </form>

<!--FILTRE POUR VERIFIER LES ENTREES DANS LE FORMULAIRE-->
<?php
$nom_genre = filter_input(INPUT_POST, "nom_genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);    
?>
<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> genres cinématographiques</p>

<!--AFFICHER UN MESSAGE DE SUCCES-->
<?php if($message !== "") { ?>
    <div class="uk-alert-success" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><?= $message ?></p>
    </div>
<?php } ?>

<table class="uk-table uk-table-striped">
   <thead>
        <tr>
            <th>GENRE</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $genre) { ?>
                <tr>
                <td><a href="index.php?action=genre&id=<?= $genre['id_genre'] ?>"><?= $genre['nom_genre'] ?></a></td>
                <td><a href="index.php?action=supprimerGenre&id=<?= $genre['id_genre'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce genre ?')"><button>Supprimer</button></a></td>
    </tr>
                </tr>
        <?php    } ?>
    </tbody>
</table>


<?php
$titre = "Liste des genres cinématographiques";
$titre_secondaire = "Liste des genres cinématographiques";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>

"Dans "template.php", on aura des variables qui vont accueillir les 
éléments provenant des vues.
Dans CHAQUE VUE, il faudra donner une valeur à:
$titre, $contenu et $titre_secondaire*/


