<?php

$file = 'sitemap-0.xml'; // Replace with the path to your XML file

if (file_exists($file)) {
    $sitemap = simplexml_load_file($file);

    $output = fopen('sitemap2.csv', 'w');
    fputcsv($output, array('URL')); // Column Header

    foreach ($sitemap->url as $url) {
        fputcsv($output, array((string)$url->loc));
    }

    fclose($output);
    echo "CSV file has been created.\n";
} else {
    exit('Failed to open the XML file.');
}