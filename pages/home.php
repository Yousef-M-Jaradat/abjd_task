<?php
session_start();

$userName = $_SESSION['username'];

echo '<h1>' . $userName . '</h1>';
