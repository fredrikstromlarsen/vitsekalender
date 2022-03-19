<?php
ini_set('display_errors', 1);
error_reporting(~0);
include './php/findCalendar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="3600; url=./">

  <title>Joke Calendar</title>

  <link rel="stylesheet" href="/fonts.css">
  <link href="./css/style.css" as="stylesheet">
  <link href="./css/font/product-sans/ProductSans-Regular.woff2" as="font" crossorigin type="font/woff2">
  <link href="./css/font/product-sans/stylesheet.css" as="stylesheet" crossorigin>

  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script> -->
  <!-- <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js" defer></script> -->
  <script src="./js/colcade.js" defer></script>
  <script src="./js/main.js" defer></script>

  <link rel="stylesheet" href="./css/style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/font/product-sans/stylesheet.css">
  <link rel="shortcut icon" href="./img/favicon/present.png" type="image/x-icon">
</head>

<body>
  <?php

  include './php/hasCalendar.php';
  include './php/displayCalendar.php';
  include './php/generateCalendar.php';

  hasCalendar();

  // TODO:
  // Fix Animations on hover
  // Set correct timezone in findCalendar when setting cookie
  // Normalize.css
  ?>

</body>

</html>