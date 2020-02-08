<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
</head>

<?php 
    $feed = simplexml_load_file("https://www.youtube.com/feeds/videos.xml?channel_id=UCBa659QWEk1AI4Tg--mrJ2A");
?>

<body style="background-color: #303030;" class="text-white">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="ReaderHome.php">Nes' Reader</a>
        <div id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Feed1.php">Feed 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Feed2.php">Feed 2</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="Feed3.php">Feed 3</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Saved.php">Saved</a>
                </li>
            </ul>
        </div>
    </nav>

    <form method="get">
    <div class="container-fluid">
        <div class="border-bottom">
            <?php
                echo "<h2>Youtube channel: <a href='" . $feed->author->uri . "'>". $feed->title . "</a></h2>";
            ?>
        </div>
        <?php
            foreach($feed->entry as $entry) {
                $group = $entry->children("media", true)->group;
                $url = (string)$group->children("media", true)->content->attributes()->url;
                $url = str_replace("v/", "embed/", $url);
                $description = (string)$group->children("media", true)->description;
                $views = $group->children("media", true)->community;
                $views = (string)$views->children("media", true)->statistics->attributes()->views;
                $title = $entry->title;
                
                $video =
                    "<div class='border-bottom' style='padding-bottom:1em;'>" . 
                        "<h4>" . $title . "</h4>" . 
                        "<h6>" . "Views: " . $views . "</h6>" . 
                        "<div style='max-height:360px; max-width:640px;' class='embed-responsive embed-responsive-16by9'><iframe src='" . $url . "'  class='embed-responsive-item' allowfullscreen></iframe></div>" .  
                        "<div style='max-width:67%'><p>" . $description . "</p></div>" . 
                        "<button type='submit' class='btn btn-primary' name='title' value='$title'>Save</button>" .
                    "</div>";

                echo $video;
            }
        ?>
    </div>
    </form>

</body>

</html>

<?php
    if(!empty($_GET)) {
        $save = new DOMDocument();
        $save->load("Saved.xml");

        $searchItem = $_GET["title"];

        foreach($feed->entry as $item) {
            if((string)$item->title == $searchItem) {
                $found = dom_import_simplexml($item);

                $save->documentElement->appendChild($save->importNode($found, true));

                break;
            }; 
        };

        $save->save("Saved.xml");
    }
?>