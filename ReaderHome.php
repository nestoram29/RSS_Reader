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

<body style="background-image: url('https://wallpapercave.com/wp/u42UMQT.jpg')">
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
        <li class="nav-item">
          <a class="nav-link" href="Saved.php">Saved</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container" style="margin-top:75px">
    <div class="jumbotron jumbotron-inverse" style="background-color: rgba(22, 28, 34, .70); text-align:center">
      <h1 style="color:white">Welcome to Nes' RSS Reader</h1>
      <p style="color:white">Click on one of the following to view the feed.
    </div>
  </div>

  <div class="container">
    <div class="card-deck">

      <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-header">Feed 1</div>
        <div class="card-body">
          <h5 class="card-title">Reddit</h5>
          <p class="card-text">The front page of the internet. This feed displays the current top posts of Reddit.</p>
          <a href="Feed1.php" class="btn btn-primary">Go</a>
        </div>
      </div>

      <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-header">Feed 2</div>
        <div class="card-body">
          <h5 class="card-title">Wired</h5>
          <p class="card-text">American tech magazine. This feed displays the most recent/most popular articles by
            Wired.com.</p>
          <a href="Feed2.php" class="btn btn-primary">Go</a>
        </div>
      </div>


      <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-header">Feed 3</div>
        <div class="card-body">
          <h5 class="card-title">Mental Floss</h5>
          <p class="card-text">Get your daily dose of facts. Mental floss is a great website to learn something new.</p>
          <a href="Feed3.php" class="btn btn-primary">Go</a>
        </div>
      </div>

      <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-header">Saved</div>
        <div class="card-body">
          <h5 class="card-title">Your saved items</h5>
          <p class="card-text">Click this card to view your saved items.</p>
          <a href="Saved.php" class="btn btn-primary">Go</a>
        </div>
      </div>

    </div>
  </div>
</body>

</html>