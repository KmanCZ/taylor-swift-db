<?php
    include "components/header.php";
?>

<?php
    $song->showAlbumSongs($_GET["albumid"]);
?>

<?php
    include "components/footer.php";
?>