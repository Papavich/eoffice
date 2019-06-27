<?php
if(isset($chat_msg)) {
    foreach ($chat_msg as $item): // วนลูปรับข้อความทั้งหมดใน DB

        $type = "right";

        echo "<li class='message $type appeared'><div class='avatar'></div><div class='text_wrapper'><div class='text'>{$item['consult_chat_detail_message']}</div></div></li>";
    endforeach;
}