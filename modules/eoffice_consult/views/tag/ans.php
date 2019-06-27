<?php

echo '';
echo '<h3>';
echo "ผลการค้นหาประมาณ ".count($model).' รายการ'.'<br>';
echo '</h3>';
echo '<h4>';
echo "จากการค้นหาด้วยคำว่า ";
echo '<font color="red">';
for($i = 0 ; $i < count($tag) ; $i++){
  echo ' '.$tag[$i];
}
echo '<br>'.'<br>';
echo '</font>';
echo '</h4>';

foreach ($model as $item) {
  echo '<br>'.$item->detail.'</br>';
}

?>
