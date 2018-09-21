<?php

require "connection.php";

$con = Connection\connect();

$text = $_POST['text'] ?? die;

if ($text) {
    $statement = $con->prepare(<<<SQL
INSERT INTO messages (text) VALUES (:text);
SQL
);

    $statement->execute([":text" => $text]);

    $con->exec('NOTIFY "hullo"');
}

