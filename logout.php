<?php
require "includes/init.php";

Auth::Logout();

URL::redirect('/articles.php');
