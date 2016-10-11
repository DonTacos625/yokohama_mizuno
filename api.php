<?php

// Content-TypeをJSONに指定する
header('Content-Type: application/json');

// $_POST['age']、$_POST['job']をエラーを出さないように文字列として安全に展開する
foreach (['userid'] as $v) {
    $$v = (string)filter_input(INPUT_POST, $v);
}

// 整合性チェック
if ($userid === '') {
    $error = 'しっぱい';
}

if (!isset($error)) {
    // 正常時は 「200 OK」 で {"data":"24歳、学生です"} のように返す
    $data = "あなたのuseridは{$userid}";
    echo json_encode(compact('data'));
} else {
    // 失敗時は 「400 Bad Request」 で {"error":"..."} のように返す
    http_response_code(400);
    echo json_encode(compact('error'));
}
?>