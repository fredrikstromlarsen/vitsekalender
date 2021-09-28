<?php
function findCalendar()
{
  $pattern = "/^([0-9]{1,3})$/";
  if (isset($_GET['cc']) && preg_match($pattern, $_GET['cc'])) {
    $code = substr($_GET['cc'], 0, 3);
    setcookie("cc", $code, time() + (86400 * 31), '/');

  } else if (isset($_COOKIE['cc']) && preg_match($pattern, $_COOKIE['cc'])) {
    $code = substr($_COOKIE['cc'], 0, 3);
    
  } else {
    header('location: ../');
  }

  // if (!isset($_COOKIE['cc']) && isset($_COOKIE['od'])) {
  //   unset($_COOKIE['od']);
  //   setcookie('od', null, -1, '/');
  // }

  if (file_exists('./calendar/' . $code . '.json')) {
    displayCalendar($code);
  } else {
    // if (isset($_COOKIE['od'])) {
    //   unset($_COOKIE['od']);
    //   setcookie('od', null, -1, '/');
    // }
    generateCalendar($code);
  }
}
