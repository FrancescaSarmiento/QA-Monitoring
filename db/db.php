 <?php

        $db = new mysqli("localhost", "root", "", "ntu_monitoring");
        // Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
?>