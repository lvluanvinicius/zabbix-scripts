<?php 


$file_name="pmOurinhos.geojson";

$json_file = fopen($file_name, "r") or die("\nImpossível abrir o arquivo $file_name\n");
$file_data = json_decode(fread($json_file, filesize($file_name)));



foreach ($file_data->features as $datas) {
    if ($datas->properties->key == $argv[1]) {
        print_r(json_encode($datas));
    }
}