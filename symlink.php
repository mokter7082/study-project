<?php
$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/zone_data/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
symlink($targetFolder,$linkFolder);
echo 'Symlink process successfully completed';