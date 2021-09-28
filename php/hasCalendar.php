<?php
function hasCalendar()
{
  $pattern = "/^([0-9]{1,3})$/";

  if ((isset($_GET['cc']) && preg_match($pattern, $_GET['cc'])) || (isset($_COOKIE['cc']) && preg_match($pattern, $_COOKIE['cc']))) {
    findCalendar();
  } else {
?>
    <div class="col-center">
      <form action="" method="GET" autocomplete="off" class="box no-gap">
        <input type="number" name="cc" class="input-number" placeholder="Choose a 1-3 digit code" autofocus="true" required="true" min="0" max="999" oninput="codeUrl(this.value)">
        <a id="codeUrl"></a>
      </form>
      <div class="box">
        <p>When you have typed a number of your choosing, hit Enter/Return to submit, or alternatively click the link above.</p>
      </div>
      <div class="box">
        <p>To organize the joke calendars best I have implemented a code-based system where you choose whatever number you like between 0 and 999, this will become the ID of your unique calendar of jokes.</p>
        <b>NB: Calendars and codes are reset every month.</b>
      </div>
    </div>
<?php
  }
}
?>