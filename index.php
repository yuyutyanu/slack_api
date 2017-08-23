<form action="#" method="post">
    <input type="text" name="message">
    <input type="submit">
</form>

<?php
require_once __DIR__.'/.env.php';
function postToSlack($message)
{
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($message),
        )
    );
    $response = file_get_contents(WEB_HOOK_URL, false, stream_context_create($options));
    return $response === 'ok';
}

if (!empty($_POST["message"])) {
    $message = array(
        'username' => 'Bot',
        'text' => htmlspecialchars($_POST["message"])
    );
    postToSlack($message);
}
