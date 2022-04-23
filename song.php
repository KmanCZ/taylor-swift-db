<?php
    include "components/header.php";
?>

<main class="columns is-centered is-2">
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

</main>



<?php
    include "components/footer.php";
?>