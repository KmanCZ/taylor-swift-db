<?php

class SongsView extends Songs {
    
    public function showAlbumName($album_id) {
        $result = $this->getAlbumName($album_id);
        print_r($result["albums_name"]);
    }

    public function showAlbumSongs($album_id) {
        $result = $this->getAlbumSongs($album_id);
        echo "<main>";
        echo '<h2 class="title album-name has-text-centered">' . $result[0]["albums_name"] . '</h2>';

        echo '<div class="columns">';
        echo '<div class="column is-offset-1">';
        foreach ($result as $song) {
            echo '<a href="song.php?songid='. $song["songs_id"] . '" class="song-name">'  . $song["songs_order"] . ". " . $song["songs_name"] . "</a>";
            echo "<br>";
        }
        echo "</div>";
        echo '<div class="column">';
        echo '<img src="img/'.$album_id.'.jpg" class="album-page-img">';
        echo "</div>";
        echo "</div>";
        echo "</main>";
    }

    public function showSong($song_id) {
        $result = $this->getSong($song_id);

        $lyrics = str_replace(PHP_EOL,"\n", $result["songs_lyrics"]);
        
        echo '<h2 class="title song-name-lyrics">' . $result["songs_name"] . '</h2>';
        echo '<h3 class="subtitle album-name-lyrics"><a href="album.php?albumid='. $result["albums_id"] . '">' . $result["albums_name"] . '</a></h3>';

        echo '<p class="lyrics">' . nl2br($lyrics) . "</p>";
        
    }

    public function showVideo($song_id) {
        $result = $this->getVideo($song_id);
        
        echo '<iframe class="video" width="640" height="480" src="https://www.youtube.com/embed/'.$result["songs_video"].'"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>';
    }

    //TODO: Přidat odkazy na stránky songu
    public function showLyrics($query) {
        $result = $this->getLyrics($query);

        if(!$result) {
            echo "No such song was found!";
            exit();
        }

        $wordCount = $this->numberOfWordUse($result, $query);
        $songCount = $this->numberOfSongs($result);

        echo '<div class="has-text-centered searched-numbers mb-3">';
        echo "Found " . $wordCount . " usages in " . $songCount . " songs";
        echo "</div>";

        foreach ($result as $line) {
            echo '<a href="song.php?songid='.$line["songs_id"].'" class="searched-link">';
            echo '<div class="has-text-centered searched-result py-2 is-size-5">';
            if (!empty($line["lyrics_prev"])) {
                echo $line["lyrics_prev"] . "<br>";
            }
            echo $this->highlightWord($line["lyrics_text"], $query) . "<br>";
            if (!empty($line["lyrics_next"])) {
                echo $line["lyrics_next"] . "<br>";
            }

            echo '<div class="pt-1"><span class="searched-result-name">'.$line["songs_name"].', <span class="is-italic">'.$line["albums_name"].'</span></span></div>';
            echo "</div>";
            echo "</a>";
        }

    }

}