<?php
function findCalendar()
{
  if (isset($_GET['cc'])) {
    $code = substr($_GET['cc'], 0, 3);

    if (date('m') + 1 < 13) {
      $nextMonth = date('m') + 1;
      $year = date('Y');
    } else {
      $nextMonth = 1;
      $year = date('Y') + 1;
    }

    // Set correct timezone
    $expiryDate = strtotime("$year-$nextMonth-01 00:00:00");
    
    setcookie("cc", $code, [
      'samesite' => 'Lax',
      'path' => '/',
      'expires' => $expiryDate
    ]);
  } else if (isset($_COOKIE['cc'])) {
    $code = substr($_COOKIE['cc'], 0, 3);
  } else {
    header('location: ../');
  }

  if (!isset($_COOKIE['cc']) && isset($_COOKIE['od'])) {
    unset($_COOKIE['od']);
    setcookie('od', null, -1, '/');
  }

  if (file_exists('./calendar/' . $code . '.json')) {
    displayCalendar($code);
  } else {
    if (isset($_COOKIE['od'])) {
      unset($_COOKIE['od']);
      // setcookie('od', null, -1, '/');
    }
    generateCalendar($code);
  }
}
