<?php

require "connection.php";

$con = Connection\connect();

$text = $_POST['text'] ?? die;

$statement = $con->prepare(<<<SQL
INSERT INTO messages (text) VALUES (:text);
SQL
);

$statement->execute([":text" => $text]);

$con->exec('NOTIFY "hullo"');

