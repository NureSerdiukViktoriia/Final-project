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
$codes = array(
'07-09' => 'Kyiv region',
'10-13' => 'Zhytomyr region',
'14-17' => 'Chernihiv region',
'18-20' => 'Cherkasy region',
'21-24' => 'Vinnytsia region',
'25-28' => 'Kirovohrad region',
'29-32' => 'Khmelnytskyi region',
'33-35' => 'Rivne region',
'36-39' => 'Poltava region',
'40-42' => 'Sumy region',
'43-45' => 'Volyn region',
'46-48' => 'Ternopil region',
'49-53' => 'Dnipropetrovsk region',
'54-57' => 'Mykolaiv region',
'58-60' => 'Chernivtsi region',
'61-64' => 'Kharkiv region',
'65-68' => 'Odesa region',
'69-72' => 'Zaporizhzhia region',
'73-75' => 'Kherson region',
'76-78' => 'Ivano-Frankivsk region',
'79-82' => 'Lviv region',
'83-87' => 'Donetsk region',
'88-90' => 'Zakarpattia region',
'91-94' => 'Luhansk region',
);
if(isset($_POST['number_code'])) {
    $code = $_POST['number_code'];
    $region = false;
    foreach($codes as $range => $region) {
        list($start, $end) = explode('-', $range);
        if($code >= $start && $code <= $end) {
            $result = "The ZIP code $code belongs to $region";
            $region = true;
            break;
        }
    }
    if(!$region) {
        $result = "There is no such region";
    }
} 


?>

</div>
<div class="code-text">
    <p>Enter ZIP code between 7 and 94</p>
</div>

<form action="" method="post" class="form-code">
    <label for="number_code">ZIP Code:</label>
    <input name="number_code" id="number_code" type="number" pattern="[7-9]|[1-8][0-9]|9[0-4]" required>
    <button type="submit" class="button-submit">Submit</button>
</form>

<?php if (!empty($result)): ?>
    <div class="message-box">
        <?php echo htmlspecialchars($result); ?>
    </div>
<?php endif; ?>


    
</body>
</html>