<?php
//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);

/* INSTER DB - DEBUGGING VARIABLES
tep_db_perform('test_callback', [
    'body' => 'TEST ---->'
]);
tep_db_perform('test_callback', [
    'body' => json_encode($_POST)
]);
tep_db_perform('test_callback', [
    'body' => json_encode($_GET)
]);
*/


return json_encode(array(
    'status_code' => 200,
    'payload' => array(
        'status' => 'ok',
    ),
));