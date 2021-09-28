<?php
function generateCalendar($code)
{
  if (!is_dir("./calendar")) {
    mkdir("./calendar", 0755, true);
  }
  $month = date('m');

  // Number of days per month
  $months = [
    "01" => 31,
    "02" => 28,
    "03" => 31,
    "04" => 30,
    "05" => 31,
    "06" => 30,
    "07" => 31,
    "08" => 31,
    "09" => 30,
    "10" => 31,
    "11" => 30,
    "12" => 31
  ];
  $max = ceil($months[$month] / 10);
  $json = "";
  $json .= "[{\n";
  $c = 0;
  for ($i = 0; $i < $max; $i++) {
    // This is needed because each and 
    // every joke is surrounded by --lines--
    $calContent = explode("----------------------------------------------", preg_replace('/\r|\n/', '<br>', str_replace('"', '\'', file_get_contents('https://v2.jokeapi.dev/joke/Any?format=txt&type=single&amount=10'))));
    for ($n = 0; $n <= count($calContent) - 1; $n++) {
      $c++;
      if (substr($calContent[$n], 0, 8) == "<br><br>") {
        $calContent[$n] = substr($calContent[$n], 8);
      }
      $json .= "\"" . $c . "\":\"" . $calContent[$n] . "\",";
    }
    // Whoever runs the joke-database
    // does not like me being too needy.
    sleep(0.2);
  }
  $json = rtrim($json, ",");
  $json .= "\n}]";
  $jsonFopen = fopen('./calendar/' . $code . '.json', 'w') or die('Can\'t open/make file calendar/' . $code . '.json<br>Please try again, or contact the administrator.');
  fwrite($jsonFopen, $json);
  displayCalendar($code);
  // header('location: ../');
}
