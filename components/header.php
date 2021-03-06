<?php
    include_once "includes/class-autoload.inc.php";
    $song = new SongsView();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset=" UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:title" content="Taylor Swift Database" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="img/thumbnail.png" />

    <meta name="twitter:title" content="Taylor Swift Database">
    <meta name="twitter:description" content="Database and search engine for Taylor's lyrics!">
    <meta name="twitter:image" content="img/thumbnail.png">
    <meta name="twitter:card" content="summary_large_image">

    <title>Taylor Swift Database</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="styles/bulma.css">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body class="mb-5 mx-3">
    <header>
        <div class="columns is-centered">
            <h1 class="title is-1 is-half logo"><a href="index.php">Taylor Swift Database</a> </h1>
        </div>

        <form action="search.php" method="GET" class="mb-4">
            <div class="field is-grouped is-grouped-centered">
                <div class="control">
                    <?php
                    echo '<input value="'.$_GET["query"].'" type="text" name="query" onfocus="this.select()" placeholder="Search lyrics" class="input is-rounded is-dark">';
                ?>
                </div>
                <div class="control">
                    <button type="submit" class="button is-rounded">
                        <span class="icon has-text-dark">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                            </svg>
                        </span>
                    </button>
                </div>

            </div>
        </form>
    </header>