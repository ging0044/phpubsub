<?php
namespace Connection;

function connect() {
    return new \PDO("pgsql:host=192.168.2.26;dbname=phpubsub", "postgres", "<password>");
}

