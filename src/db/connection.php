<?php

namespace App\db\connection;

use SQLite3;

function createConnection()
{
    $dbPath = __DIR__ . '/../../db.sqlite';
    if (file_exists($dbPath) === true) {
        $db = null;
        $db = new SQLite3($dbPath);
    } elseif (file_exists($dbPath) === false) {
        $db = null;
        $db = new SQLite3($dbPath);
        touch($dbPath);
    }


    //TODO: Create connection to Sqlite DB

    return $db;
}
