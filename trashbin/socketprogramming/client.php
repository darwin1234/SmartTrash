<html>
    <body>
        <div alignment='center'></div>
        <form method='POST'>
            <table>
                <tr>
                    <td><label>Enter a message</label>
                        <input type="text" name="txtMessage">
                        <input type="submit" name="btnSend" value="Send">
                     </td>   
                </tr>
                <?php
                    $host = "127.0.0.1";
                    $port = "20205";

                    if(isset($_POST['btnSend'])){
                        $msg = $_REQUEST['txtMessage'];
                        $sock = socket_create(AF_INET, SOCK_STREAM, 0);
                        socket_connect($sock, $host, $port);

                        socket_write($sock, $msg, strlen($msg));

                        $reply = socket_read($sock, 1924);
                        $reply = trim($reply);
                        $reply = "server says:\t".$reply;

                    }

                    if(isset($_GET['type'])){
                        $type = $_GET['type'];
                        
                        if ($type == 1){
                            $level_Bio = $_GET['level'];
                            echo "Biogradable";

                        }
                        if ($type == 2){
                            $level_NonBio = $_GET['level'];
                            echo "non biogradable";
                        }
                        if ($type == 3){
                            $level_Recy = $_GET['level'];
                            echo "recycable";
                        }
                    }
                ?>
                <tr>
                    <td>
                        <textarea rows='10' col='30'><?php echo @$reply;?>
                        </textarea>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>