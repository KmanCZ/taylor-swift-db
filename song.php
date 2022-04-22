<?php
    include "components/header.php";
?>

<div class="columns is-centered is-2">
    <div class="column is-5 has-text-centered">
        <?php
            $song->showSong($_GET["songid"]);
        ?>
    </div>
    <div class="column is-5">
        <?php
            $song->showVideo($_GET["songid"]);
        ?>
    </div>

</div>



<?php
    include "components/footer.php";
?>