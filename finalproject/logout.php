<?php
require "includes/init.php";

Auth::Logout();

header("Location: index.php");
