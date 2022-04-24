<?php
    include "components/header.php";
?>
<main class="columns is-centered">
    <div class="column is-half">
        <?php
            $song->showLyrics($_GET["query"]);
        ?>
    </div>

</main>


<?php
    include "components/footer.php";
?>