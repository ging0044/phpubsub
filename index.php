<?php
require "connection.php";

$con = Connection\connect();

$sql = <<<SQL
SELECT * FROM messages;
SQL;

$messages = $con->query($sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="/index.js"></script>
  </head>
  <body>
    <ul id="messages">
      <?php foreach ($messages as $message): ?>
        <li data-id="<?= $message['id'] ?>"><?= $message['text'] ?></li>
      <?php endforeach ?>
    </ul>
    <form name="message">
      <input type="text" name="text" />
      <input type="submit" />
    </form>
  </body>
</html>
