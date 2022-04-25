<?php

class Songs extends Dbh {

    protected function getAlbumName($album_id) {
        $sql = "SELECT albums.albums_name FROM albums WHERE albums.albums_id=?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($album_id))) {
            $stmt = null;
            header("location: index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: 404.php?error=albumnotfound");
            exit();
        }

        $album = $stmt->fetch();
        return $album;
    }

    protected function getAlbumSongs($album_id) {
        $sql = "SELECT albums.albums_name, songs.songs_name, songs.songs_order, songs.songs_id FROM songs INNER JOIN albums ON albums.albums_id=songs.albums_id WHERE albums.albums_id=? ORDER BY songs.songs_order ASC;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($album_id))) {
            $stmt = null;
            header("location: index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: 404.php?error=albumnotfound");
            exit();
        }

        $album = $stmt->fetchAll();
        return $album;
    }

    protected function getSong($song_id) {
        $sql = "SELECT albums.albums_name, songs.songs_name, songs.songs_lyrics, songs.albums_id FROM songs INNER JOIN albums ON albums.albums_id=songs.albums_id WHERE songs.songs_id=?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($song_id))) {
            $stmt = null;
            header("location: index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: 404.php?error=songnotfound");
            exit();
        }

        $song = $stmt->fetch();
        return $song;
    }

    protected function getVideo($song_id) {
        $sql = "SELECT songs_video FROM songs WHERE songs_id=?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($song_id))) {
            $stmt = null;
            header("location: index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: 404.php?error=songnotfound");
            exit();
        }

        $video = $stmt->fetch();
        return $video;
    }

    protected function getLyrics($query) {
        $sql = 'SELECT lyrics.lyrics_id, lyrics.lyrics_text, lyrics.lyrics_prev, lyrics.lyrics_next, lyrics.lyrics_multi, lyrics.songs_id, songs.songs_name, albums.albums_name FROM lyrics INNER JOIN albums ON albums.albums_id=lyrics.albums_id INNER JOIN songs ON songs.songs_id=lyrics.songs_id WHERE lyrics.lyrics_text RLIKE CONCAT("[[:<:]]",?,"[[:>:]]") ORDER BY lyrics.lyrics_id ASC;';
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($query))) {
            $stmt = null;
            header("location: index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            return false;
            exit();
        }

        $lyrics = $stmt->fetchAll();
        return $lyrics;
    }

    //returns string with word highlighted by span
    protected function highlightWord($line, $word) {
        $pattern = "/\b(?i)".$word."\b/";
        
        $final = preg_replace_callback($pattern, function ($matches) {
            return '<span class="searched-highlight">'.$matches[0].'</span>';
        }, $line);

        return $final;        
    }

    //returns number of songs stored in array
    protected function numberOfSongs($arr) {
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
    protected function numberOfWordUse($arr, $word) {
        $count = null;
        foreach ($arr as $line) {
            preg_match_all("/\b(?i)".$word."\b/", $line["lyrics_text"], $match);
            $count += count($match[0]) * $line["lyrics_multi"];
        }
        return $count;
    }
}