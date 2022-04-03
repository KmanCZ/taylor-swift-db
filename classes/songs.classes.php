<?php

class Songs extends Dbh {

    protected function getAlbumName($album_id) {
        $stmt = $this->connect()->prepare("SELECT albums.albums_name FROM albums WHERE albums.albums_id=?;");

        if(!$stmt->execute(array($album_id))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=albumnotfound");
            exit();
        }

        $album = $stmt->fetch();
        return $album;
    }
}