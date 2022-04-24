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
            echo '<div class="has-text-centered searched-result py-2 is-size-5">';
            if (!empty($line["lyrics_prev"])) {
                echo $line["lyrics_prev"] . "<br>";
            }
            echo $line["lyrics_text"] . "<br>";
            print_r($this->highlightWord($line["lyrics_text"], $query));
            if (!empty($line["lyrics_next"])) {
                echo $line["lyrics_next"] . "<br>";
            }

            echo '<div class="pt-1"><span class="searched-result-name">'.$line["songs_name"].', <span class="is-italic">'.$line["albums_name"].'</span></span></div>';
            echo "</div>";
        }

        
    }


    //returns string with word highlighted by span
    //TODO: Zvýzarňovač slov
    private function highlightWord($line, $word) {
        $pattern = "/\b(?i)".$word."\b/";
        preg_match_all($pattern, $line, $matches, PREG_OFFSET_CAPTURE);

        
        foreach($matches[0] as $find) {
            $start = $find[1];
            $end = $start + strlen($word);


        }
        
        return $matches;
    }

    //returns number of songs stored in array
    private function numberOfSongs($arr) {
        $usedSongs = array();
        $numOfSongs = 0;

        foreach($arr as $line) {
            if(!in_array($line["songs_name"], $usedSongs)) {
                $numOfSongs++;
                array_push($usedSongs, $line["songs_name"]);
            }
        }

        return $numOfSongs;
    }

    //returns number of used lyrics
    private function numberOfWordUse($arr, $word) {
        $count = null;
        foreach ($arr as $line) {
            preg_match_all("/\b(?i)".$word."\b/", $line["lyrics_text"], $match);
            $count += count($match[0]) * $line["lyrics_multi"];
        }
        return $count;
    }
}