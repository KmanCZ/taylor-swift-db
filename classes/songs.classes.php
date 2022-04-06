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
        $sql = "SELECT albums.albums_name, songs.songs_name, songs.songs_order FROM songs INNER JOIN albums ON albums.albums_id=songs.albums_id WHERE albums.albums_id=? ORDER BY songs.songs_order ASC;";
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
}