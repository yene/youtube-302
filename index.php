<?php
require_once "apiKey.php";

if (isset($_GET["q"]) && !empty($_GET["q"])) {
  $apiURL = "https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=1&order=viewCount&type=video&key=" . $apiKey . "&q=" . urlencode($_GET["q"]);
  $apiResult = file_get_contents($apiURL);
  $json = json_decode($apiResult, true);

  if (count($json["items"]) == 1) {
    $videoID = $json["items"][0]["id"]["videoId"];
    $url = "https://www.youtube.com/watch?v=" . $videoID;
    header("Location: " . $url);
    die();
  } else {
    die("Error: no video found");
  }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Youtube search</title>
  <!-- Normalize.css is a customisable CSS file that makes browsers render all elements more consistently and in line with modern standards. -->
  <link rel="stylesheet" media="screen" href="https://raw.github.com/necolas/normalize.css/master/normalize.css">
  <link rel="stylesheet" type="text/css" href="//yegor256.github.io/tacit/tacit.min.css"/>
  </style>
</head>
<body>
  <section>
    <article>
      <h1>Youtube 302</h1>
      <form method="get" action="">
        <fieldset>
          <label for="q">Search for a youtube video and get redirected to the first result:</label>
          <input name="q" type="text" id="q" size="25" placeholder="Rick Astley" autofocus/>
          <button type="submit">Play First Result</button>
        </fieldset>
      </form>
      <p><small>You can add <code>?q=rick+astley</code> to the URL for an instant redirect.</small></p>
    </article>
    <footer>
        <nav>
          <ul>
            <li>
              <small>Made by <a href="http://yannickweiss.com">Yannick Weiss</a></small>
            </li>
          </ul>
        </nav>
    </footer>
  </section>
</body>
</html>
