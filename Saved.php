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
    $saved = simplexml_load_file('Saved.xml');
?>

<body style="background-color: #303030"  class="text-white">
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
                <li class="nav-item">
                    <a class="nav-link" href="Feed3.php">Feed 3</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="Saved.php">Saved</a>
                </li>
            </ul>
        </div>
    </nav>

    <form method="get">
    <div class="container-fluid">
        <div class="border-bottom">
            <h2>Saved Items</h2>
        </div>
        <?php
            foreach($saved->entry as $entry) {
                if(isset($entry->category)) {
                    $author = $entry->author->name;
                    $author = trim($author, '/u/');

                    $post = 
                    "<div class='border-bottom' style='margin-bottom:8px;padding-bottom:5px;'>" .
                        "<h4>" . $entry->title . "</h4>" .
                        $entry->content . "<br />" .
                    "</div>";

                    echo $post;
                }
                else {
                    $group = $entry->children("media", true)->group;
                    $url = (string)$group->children("media", true)->content->attributes()->url;
                    $url = str_replace("v/", "embed/", $url);
                    $description = (string)$group->children("media", true)->description;
                    $views = $group->children("media", true)->community;
                    $views = (string)$views->children("media", true)->statistics->attributes()->views;
                    $title = $entry->title;
                
                    $video =
                        "<div class='border-bottom' style='margin-bottom:8px;'>" . 
                            "<h4>" . $title . "</h4>" . 
                            "<h6>" . "Views: " . $views . "</h6>" . 
                            "<div style='max-height:360px; max-width:640px;' class='embed-responsive embed-responsive-16by9'><iframe src='" . $url . "'  class='embed-responsive-item' allowfullscreen></iframe></div>" .  
                            "<div style='max-width:67%'><p>" . $description . "</p></div>" . 
                        "</div>";

                    echo $video;
                }
            }
            foreach($saved->item as $item) {
                $encoded = (string)$item->children("content", true)->encoded;
                $encoded = str_replace("<img src='https://media.npr.org/include/images/tracking/npr-rss-pixel.png?story=675661414' />", "", $encoded);
                $creator = (string)$item->children("dc", true)->creator;
                $title = $item->title;

                $article = 
                    "<div class='border-bottom' style='margin-bottom:8px;'>" . 
                        "<a href='" . $item->link . "'>" . "<h4>" . $title . "</h4></a>" .
                        "<h6>" . $item->description . "</h4>" . 
                        "<p>" . $item->pubDate . "</p>" . 
                        "<p>" . $creator . "</p>" . 
                        $encoded .  
                    "</div>";

                echo $article;
            }
        ?>
    </div>
    </form>

</body>

</html>