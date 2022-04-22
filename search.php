<?php
    include "components/header.php";
?>

<?php
    $song->showLyrics($_GET["query"]);
?>

<?php
    include "components/footer.php";
?>