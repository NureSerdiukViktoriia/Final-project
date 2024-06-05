<?php
function start_processor($parser, $name, $attributes){
   echo "<tr>";
}

function stop_processor($parser, $name){
    echo "</tr>";
}

function main_processor($parser, $data){
    echo "<td>$data</td>";
}
$parser = xml_parser_create();

xml_set_element_handler($parser, "start_processor", "stop_processor");
xml_set_character_data_handler($parser, "main_processor");

echo"<table>";
$result = "<tr><td>Загальні характеристики браузера та комп'ютера користувача</td><td>Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36</td></tr>";
xml_parse($parser, $result);
echo "</table>";
xml_parser_free($parser);

$dom = new DOMDocument();
$file = 'text.xml';
if(file_exists($file)){
    $dom->load($file);
}else{
    $r = $dom->createElement('users');
    $dom->appendChild($r);
}

echo $dom->saveXML();



?>
