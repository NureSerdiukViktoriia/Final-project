<?php
class Log {
    public static function log($result) {
        $file = __DIR__ . '/log.txt'; 
        file_put_contents($file, $result . PHP_EOL, FILE_APPEND);
    }
}
function logging(callable $func) {
    return function($result) use ($func) {
        Log::log('Model logging: ' . json_encode($result));
        return $func($result);
    };
}

function saving($result){
}
?>
