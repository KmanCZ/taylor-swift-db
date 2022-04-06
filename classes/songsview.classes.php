<?php

class SongsView extends Songs {
    
    public function showAlbumName($album_id) {
        $result = $this->getAlbumName($album_id);
        print_r($result["albums_name"]);
    }

    public function showAlbumSongs($album_id) {
        $result = $this->getAlbumSongs($album_id);
        
        echo '<h2 class="title">' . $result[0]["albums_name"] . '</h2>';

        foreach ($result as $song) {
            echo '<a href="song.php?songid='. $song["songs_id"] . '" >'  . $song["songs_order"] . ". " . $song["songs_name"] . "</a>";
            echo "<br>";
        }
    }

    public function showSong($song_id) {
        $result = $this->getSong($song_id);

        $lyrics = str_replace(PHP_EOL,"\n", $result["songs_lyrics"]);
        
        echo '<h2 class="title">' . $result["songs_name"] . '</h2>';
        echo '<h3 class="subtitle"><a href="album.php?albumid='. $result["albums_id"] . '">' . $result["albums_name"] . '</a></h3>';

        echo "<p>" . nl2br($lyrics) . "</p>";
        
    }
}