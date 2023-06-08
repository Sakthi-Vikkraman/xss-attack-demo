<?php
$commentsFilepath = __DIR__ . '/comments.json';

// Load existing comments
$comments = [];
if (file_exists($commentsFilepath)) {
    $comments = json_decode(file_get_contents($commentsFilepath), true);
}

// Handle new comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $newComment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
    $comments[] = $newComment;
    file_put_contents($commentsFilepath, json_encode($comments));
    header('Location: /');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>XSS Safe Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="/xss-attack.jpg" />

    <h2>Comments</h2>
    <form method="POST" action="/post-handler.php">
        <textarea name="comment"></textarea>
        <input type="submit" />
    </form>

    <div class="comments">
        <?php
        foreach ($comments as $index => $comment) {
            $humanCounter = $index + 1;
            $commentText = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
            echo "<p>Comment {$humanCounter}: " . nl2br($commentText) . "</p>";
        }
        ?>
    </div>
</body>
</html>
