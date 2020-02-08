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
    $feed = simplexml_load_file('https://www.reddit.com/.rss');
?>

<body style="background-color: #303030;" class="text-white">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="ReaderHome.php">Nes' Reader</a>
        <div id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="Feed1.php">Feed 1</a>
                </li>
                <li class="nav-item">
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
            <?php
                echo "<div class='border-bottom'><h2>" . $feed->title . "</h2></div>";

                foreach($feed->entry as $entry) {
                    $author = $entry->author->name;
                    $author = trim($author, '/u/');

                    $post = 
                    "<div class='border-bottom' style='margin-bottom:8px;padding:5px'>" .
                        "<h4>" . $entry->title . "</h4>" .
                        $entry->content . "<br />" .
                        "<button type='submit' class='btn btn-primary' value='$author' name='author'>Save</button>" .
                    "</div>";

                    echo $post;
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

        $author = $_GET["author"];
        $author = "/u/" . $author;

        foreach($feed->entry as $entry) {
            if($entry->author->name == $author) {
                $found = dom_import_simplexml($entry);

                $save->documentElement->appendChild($save->importNode($found, true));

                break;
            }; 
        };

        $save->save("Saved.xml");
    }
?>