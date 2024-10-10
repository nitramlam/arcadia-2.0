<?php
session_start();
session_unset();
session_destroy();
header("Location: ../connexion/logout-success.php");
exit();