<?php

class SongsView extends Songs {
    
    public function showAlbumName($album_id) {
        $result = $this->getAlbumName($album_id);
        print_r($result["albums_name"]);
    }

    public function showAlbumSongs($album_id) {
        $result = $this->getAlbumSongs($album_id);
        
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

    public function showLyrics($query) {
        $result = $this->getLyrics($query);

        if(!$result) {
            echo "No such song was found!";
        }

        print_r($result);
    }
}