<?php

$db = new PDO('sqlite:workshopDb.sqlite3');


$db->exec('CREATE TABLE IF NOT EXISTS statuses (
                    id INTEGER PRIMARY KEY,
                    user_id INTEGER,
                    status TEXT);');

$db->exec('CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY,
                    username TEXT,
                    first_name TEXT,
                    last_name TEXT,
                    email TEXT);');