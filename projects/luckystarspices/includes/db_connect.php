<!-- Local host connection for testing -->
<!-- Created 3/8/23 -->

<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $dbc = new mysqli('localhost', 'root', '', 'lss_test_db');
    $dbc->set_charset('utf8mb4');
    