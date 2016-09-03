<?php header('Content-Type: application/json'); ?>


<?=json_encode(['title'=>'Végzetes hiba','data'=>$users,'error'=>'Az Ön által kért adat nem található']);?>