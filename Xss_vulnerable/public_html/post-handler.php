<?php
$commentsFilepath = __DIR__ . '/comments.json';
$comments = json_decode(file_get_contents($commentsFilepath));

// Sanitize and escape the user input before storing
$sanitizedComment = sanitize($_POST['comment']);
$comments[] = $sanitizedComment;
file_put_contents($commentsFilepath, json_encode($comments));

header('Location: /');
