<?php
    $host = "127.0.0.1";
    $port = "20205";
    set_time_limit(0);

    $sock = socket_create(AF_INET, SOCK_STREAM, 0) or die ("could not create socket\n");
    $result = socket_bind($sock, $host, $port) or die ("could not bind socket.\n");

    $result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
    echo "listening for connections";

    class chat{
        function readline()
        {
            return rtrim(fgets(STDIN));
        }
    }
    do{
        $accept = socket_accept($sock) or die ("could not accepting incoming connection.");
        $msg = socket_read($accept, 1024) or die ("could not read input\n");

        $msg = trim($msg);
        echo "client says:\t".$msg."\n\n";  

        $line = new Chat();
        echo "Enter reply:\t";
        $reply = $line->readline();

        socket_write($accept, $reply, strlen($reply)) or die("could not write output\n");
    }while (true);

    socket_close($accept, $sock);
?>