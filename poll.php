<?php

require "connection.php";

$con = Connection\connect();

$con->exec('LISTEN "hullo"');

$recent = $_GET['id'] ?? 0;

while (1) {
    $result = "";

    $result = $con->pgsqlGetNotify(PDO::FETCH_ASSOC, 10000);

    if ($result) {
        $statement = $con->prepare(<<<SQL
SELECT * FROM messages WHERE id > :id
SQL
);

        $statement->execute([":id" => $recent]);
        $data = $statement->fetchAll();

        header("X-Accel-Buffering: no");
        header("Content-Type: application/json");
        header("Cache-Control: no-cache");

        echo json_encode($data);
        break;
    }
}

