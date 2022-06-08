<?php
if (function_exists('exif_read_data')) {
    echo "php exif module is installed";
} else {
    echo "php exif module is NOT installed";
}
?>

<?php
$exif_data = exif_read_data('picture.jpg');
print_r($exif_data);
?>