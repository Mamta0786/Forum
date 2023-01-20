<?php
session_start();
session_unset();
session_destroy();
header("location:/phpProject/forum2/index.php?loggedin=false");
exit; 

?>