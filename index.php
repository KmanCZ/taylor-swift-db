<?php
    include "components/header.php";
?>

<h1 class="title is-1">Taylor Swift Database</h1>

<?php
    include "includes/class-autoload.inc.php";
    $song = new SongsView();
    $song->showAlbumName(9);
?>

<?php
    include "components/footer.php";
?>