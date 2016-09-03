<?php header('Content-Type: application/json'); ?>

<?=json_encode(['title'=>$params['title'],'data'=>$params['model']]);?>