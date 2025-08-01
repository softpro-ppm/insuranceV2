<?php
session_start();
session_destroy();
echo "Session cleared. <a href='/login'>Try login again</a>";
?>
