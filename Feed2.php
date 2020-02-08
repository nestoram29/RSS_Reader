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
    $feed = simplexml_load_file('https://www.npr.org/rss/rss.php?id=1007')->channel;
?>

<body style="background-color: #303030;" class="text-white">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="ReaderHome.php">Nes' Reader</a>
        <div id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Feed1.php">Feed 1</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="Feed2.php">Feed 2</a>
                </li>
                <li class="nav-item">
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
                echo "<h2>" . $feed->title . "</h2>";
                echo "<h6>" . $feed->description . "</h6>";
                echo "<a href='" . $feed->link . "'><img style='height:4em;width:4em;'src='" . $feed->image->url . "'></a>";
            ?>
        </div>
        <?php
           
            foreach($feed->item as $item) {
                $encoded = (string)$item->children("content", true)->encoded;
                $creator = (string)$item->children("dc", true)->creator;
                $title = $item->title;

                $article = 
                    "<div class='border-bottom' style='padding-bottom:1em;'>" . 
                        "<a href='" . $item->link . "'>" . "<h4>" . $title . "</h4></a>" .
                        "<h6>" . $item->description . "</h4>" . 
                        "<p>" . $item->pubDate . "</p>" . 
                        "<p>" . $creator . "</p>" . 
                        $encoded . 
                        "<button type='submit' class='btn btn-primary' name='title' value='$title'>Save</button>" . 
                    "</div>";

                echo $article;
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

        foreach($feed->item as $item) {
            if((string)$item->title == $searchItem) {
                $found = dom_import_simplexml($item);

                $save->documentElement->appendChild($save->importNode($found, true));

                break;
            }; 
        };

        $save->save("Saved.xml");
    }
?>