<?php

include_once("databases/Migration.php");

    $mg = new Migration();
    $mg->migrate();
?>