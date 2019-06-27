<?php
if(isset($chat_msg)) {

    foreach ($chat_msg as $item):
        if ($item['chat_detail_name'] == "นักศึกษา") {
            $type = "right";
        } else {
            $type = "left";
        }
        echo "<li class='message $type appeared'><div class='avatar'></div><div class='text_wrapper'><div class='text'>{$item['chat_detail_message']}</div></div></li>";
        $last_id = $item['chat_detail_id'];
    endforeach;
}
