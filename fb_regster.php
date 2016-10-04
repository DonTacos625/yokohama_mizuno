<?php
header("Content-type: text/plain; charset=UTF-8");
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    //ここに何かしらの処理を書く（DB登録やファイルへの書き込みなど）
    echo "OK";
}
else
{
    echo 'The parameter of "request" is not found.';
}
?>