<?php
require_once("db_connection.php");


$del = filter_input(INPUT_GET, 'del');

$target_dir = "uploads/";

while ($affichage = $imageChap5->fetch()) {

    if (file_exists($target_dir . $affichage['nomMedia'])) {
        echo '<div class="col-sm-5">';
        echo '<div class="panel panel-default">';

        if ($affichage['typeMedia'] == "video") {
            echo "<div class='panel-thumbnail'><video width='100%' controls autoplay muted loop><source src='uploads/" . $affichage['nomMedia'] . "'></video></div>";
        } else if ($affichage['typeMedia'] == "audio") {
            echo "<div class='panel-thumbnail'><audio controls><source src='uploads/" . $affichage['nomMedia'] . "'></audio></div>";
        } else {
            echo "<div class='panel-thumbnail'><img src='uploads/" . $affichage['nomMedia'] . "' class='img-responsive'></div>";
        }

        echo '<div class="panel-body">';
        // echo '<p> class="lead">Urbanization</p>';
        echo "<p>Date de création: " . $affichage['creationDate'] . " </p>";

        echo '<p><img src="assets/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px"></p>';
        echo '</div>';
        echo '<a style="color: red;" href="index.php?del=' . $affichage['idMedia'] . '">Delete</a>';
        echo '<br/>';
        echo '<br/>';
        echo '<a style="color: blue;" href="post.php?edit=' . $affichage['idMedia'] . '">Edit</a>';


        if ($del == $affichage['idMedia']) {
            unlink($target_dir . $affichage['nomMedia']);
            $deleteContent->execute(array($affichage['idMedia']));
            header('Location: index.php');
        }

        // if($edit == $affichage['idMedia']){

        // if($edit == $affichage['idMedia']){
        //     unlink($target_dir . $affichage['nomMedia']);
        //     $modifMedia->execute(array($affichage['idMedia']));
        //     header('Location: index.php');
        // }

        if (!empty($_GET['edit'])) {
            unlink($target_dir . $affichage['nomMedia']);
            $modifMedia->execute(array($affichage['idMedia']));
            header('Location: index.php');
        }
        echo '</div>';

        echo '</div>';
    }
}
