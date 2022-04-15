<?php
    include "components/header.php";
?>

<div class="columns is-centered is-2">
    <div class="column is-5 has-text-centered">
        <?php
            include "includes/class-autoload.inc.php";
            $song = new SongsView();
            $song->showSong($_GET["songid"]);
        ?>
    </div>
    <div class="column is-5 ">
        <iframe class="video" width="640" height="480" src="https://www.youtube.com/embed/GkD20ajVxnY"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>

</div>



<?php
    include "components/footer.php";
?>