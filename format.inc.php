<?php

function present_header($title, $username) {
    $html = <<<HTML
<header>
<nav><p>
Hey, $username!
<a href="mypage.php">My Page</a>
<a href="dashboard.php">Main Dashboard</a>
<a href="logout.php">Log Out</a></p></nav>
<h1>$title</h1>
</header>
HTML;

    return $html;
}
