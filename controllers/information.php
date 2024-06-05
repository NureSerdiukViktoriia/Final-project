<?php
namespace Controllers;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
   echo "<link rel='stylesheet' href='../css/style.css'>";
    $t = "<h3 class='personal-auth'>Personal </h3>";
?>
<div class="personal-auth">
<?php
    $new_t = preg_replace('/<[^>]*>/', '', $t);
    echo $new_t;

    $file = file_get_contents('test.txt');
    $res = htmlspecialchars($file);
    echo $res;
    ?>
   </div>
    
<div class="browser-information">
<?php
$inf = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/Firefox/i', $inf)) {
    echo 'Browser: Firefox';
}
else if (preg_match('/Edge/i', $inf)) {
    echo 'Browser: Microsoft Edge';
}
else if (preg_match('/Chrome/i', $inf)) {
    echo 'Browser: Google Chrome';
}
else if (preg_match('/Opera/i', $inf)) {
    echo 'Browser: Opera';
}else{
    echo 'Unknown browser';
}

$os = strtoupper(substr(PHP_OS, 0, 3));
if ($os === 'WIN') {
    echo '<br>Operating system: Windows';
}
else if ($os === 'DAR') {
    echo '<br>Operating system: MacOs';
}
else if ($os === 'LIN') {
    echo '<br>Operating system: Linux';
}else{
    echo 'Unknown operating system';
}
?>
</div>
<?php
echo "<table border='1' class='table-auth'>";
echo "<tr><th>Назва</th><th>Значення</th></tr>";
echo "<tr><td>Загальні характеристики браузера та комп'ютера користувача</td><td>$inf</td></tr>";
echo "</table>";

?>
</body>
</html>