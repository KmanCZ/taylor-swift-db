<?php
    include "components/header.php";
?>

<?php
    include "includes/class-autoload.inc.php";
    $song = new SongsView();
    $song->showSong($_GET["songid"]);
?>


<?php
    include "components/footer.php";
?>