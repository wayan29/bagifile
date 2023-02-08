<?php

echo "Enter folder path: ";

$folder = trim(fgets(STDIN));

echo "Enter chunk size in MB: ";

$chunk_size = trim(fgets(STDIN)) * 1024 * 1024;

$files = scandir($folder);

foreach ($files as $file) {

  if ($file == '.' || $file == '..') {

    continue;

  }

  

  $filename = "$folder/$file";

  $handle = fopen($filename, 'rb');

  $i = 0;

  

  while (!feof($handle)) {

    $buffer = fread($handle, $chunk_size);

    $filename_chunk = $filename . '.' . str_pad($i, 4, '0', STR_PAD_LEFT);

    file_put_contents($filename_chunk, $buffer);

    $i++;

  }

  

  fclose($handle);

}

?>

