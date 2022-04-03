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
            echo $song["songs_order"] . ". " . $song["songs_name"];
            echo "<br>";
        }
    }
}