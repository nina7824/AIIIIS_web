<?php
session_start();
$_SESSION['test'] = 'Session is working!';
echo "Session test: " . $_SESSION['test'];
echo "<br>Session save path: " . session_save_path();
echo "<br>Session ID: " . session_id();
?>