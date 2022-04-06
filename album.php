<?php
    include "components/header.php";
?>

<?php
    include "includes/class-autoload.inc.php";
    $song = new SongsView();
    $song->showAlbumSongs($_GET["albumid"]);
?>

<?php
    include "components/footer.php";
?>