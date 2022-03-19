<?php
function displayCalendar($code)
{
  $date = date('d');
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
  $contentJSON = file_get_contents("calendar/$code.json");
  $content = json_decode($contentJSON, true);

?>
  <div class="cal" id="calendar">
    <div class="colcade-col colcade-col--1"></div>
    <div class="colcade-col colcade-col--2"></div>
    <div class="colcade-col colcade-col--3"></div>
    <div class="colcade-col colcade-col--4"></div>

    <?php

    for ($day = 1; $day <= $months[$month]; $day++) {
      if ($day < 10) {
        $dayFormatted = '0' . $day;
      } else {
        $dayFormatted = $day;
      }
      if ($day <= $date) {
        if ($day == $date) {
          $isToday = 'today';
        } else {
          $isToday = '';
        }
        if (isset($_COOKIE["od"])) {
          $odArray = explode(",", $_COOKIE["od"]);
        } else {
          $odArray = "";
        }
        if (is_array($odArray) && in_array($day, $odArray)) $odOut = 'dooropen';
        else $odOut = 'doorclosed';

    ?>
        <div class="cal-wrapper cal-openable <?php echo $isToday; ?>" onmouseenter="openCalendar('entry-id-<?=$day?>')">
          <div class="cal-container">
            <div class="cal-closed">
              <p><?php echo $day; ?></p>
            </div>
            <div class="cal-opened <?=$odOut?>" id="entry-id-<?=$day?>">
              <div>
                <span>Today's joke:</span>
                <span><?php echo "$dayFormatted/" . date('m') . "/" . date('Y'); ?></span>
              </div>
              <p class="cal-content"><?php echo $content[0][$day]; ?></p>
            <?php
          } else {
            $lockedContent = "";
            $words = str_word_count($content[0][$day], 1);

            for ($i = 0; $i < str_word_count($content[0][$day], 0); $i++) {
              if ($words[$i] != "br") {
                $lockedContent .= substr(
                  str_shuffle(
                    str_repeat(
                      " 0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ",
                      1
                    )
                  ),
                  0,
                  strlen($words[$i])
                ) . " ";
              }
            }

            ?>
              <div class="cal-wrapper cal-unopenable" id="<?php echo $day; ?>">
                <div class="cal-container">
                  <div class="cal-closed">
                    <p class="cal-date"><?php echo $day; ?></p>
                  </div>
                  <div class="cal-opened doorclosed">
                    <div>
                      <span>Locked joke:</span>
                      <span><?php echo "$dayFormatted/$month/" . date('Y'); ?></span>
                    </div>
                    <p class="cal-content"><?php echo "$lockedContent"; ?></p>
                  <?php
                } ?>
                  </div>
                </div>
              </div>
            <?php
          }
            ?>
            </div>
          <?php
        }
