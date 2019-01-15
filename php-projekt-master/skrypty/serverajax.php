<?php
session_write_close();
ignore_user_abort(false);
set_time_limit(25);
try {
    if (!isset($_COOKIE['lastUpdate'])) {
        setcookie('lastUpdate', 0);
        $_COOKIE['lastUpdate'] = 0;
    }

    $lastUpdate = $_COOKIE['lastUpdate'];
    $file = '../blogi/'.$_GET['blognazwa']."/wiadomosci";
    if (!file_exists($file)) {
        throw new Exception('chatConversationData Does not exist');
    }

    while(true){
        $fileModifyTime = filemtime($file);
        if ($fileModifyTime > $lastUpdate) {

            sleep(0.5);

            $file = file_get_contents($file);
            setcookie('lastUpdate', $fileModifyTime);

            //exit( $file);
            exit(json_encode([
                'status' => true,
                'time' => $fileModifyTime,
                'content' => $file
            ]));

        }
        clearstatcache();
        sleep(0.5);

    }



} catch (Exception $e) {

    exit(
    json_encode(
        array (
            'status' => false,
            'error' => $e -> getMessage()
        )
    )
    );

}

?>