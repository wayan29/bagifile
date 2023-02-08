<?php

echo "Enter file name: ";
$filename = trim(fgets(STDIN));
echo "Enter chunk size in MB: ";
$chunk_size = trim(fgets(STDIN)) * 1024 * 1024;

$i = 0;
$handle_merged = fopen($filename, 'wb');

while (true) {
    $filename_chunk = $filename . '.' . str_pad($i, 4, '0', STR_PAD_LEFT);
    if (!file_exists($filename_chunk)) {
        break;
    }

    $handle_chunk = fopen($filename_chunk, 'rb');
    while (!feof($handle_chunk)) {
        $buffer = fread($handle_chunk, $chunk_size);
        fwrite($handle_merged, $buffer);
    }

    fclose($handle_chunk);
    unlink($filename_chunk);
    $i++;
}

fclose($handle_merged);

?>
