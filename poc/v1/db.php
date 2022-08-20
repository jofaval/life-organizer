<?php

function create_mysql_connection(): \mysqli
{
    global $conn;

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    if (!$conn) die('Could not connect:');

    init_db($conn);

    return $conn;
}
$conn = create_mysql_connection();

function init_db(\mysqli $conn): bool
{
    $result = mysqli_query($conn, "CREATE Table If Not Exists life_organizer_v1_journal(
        `id` Int Primary Key AUTO_INCREMENT,
        `day` Date Not Null,
        `text` Text Not Null,
        `created_at` DateTime Not Null,
        `updated_at` DateTime Not Null
    )");

    if ($result === FALSE) die('Could not initialize the Database');

    return true;
}
