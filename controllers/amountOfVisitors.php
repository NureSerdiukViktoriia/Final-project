<?php
namespace Controllers;
use PDO;
require_once __DIR__ . '/../controllers/visiting.php';
require_once __DIR__ . '/../controllers/log.php';

function visits($pdo, $ip) {
    $stmt = $pdo->prepare("SELECT * FROM visiting WHERE ip = :ip");
    $stmt->execute(['ip' => $ip]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $amount = $result['amount'] + 1;
        $stmt = $pdo->prepare("UPDATE visiting SET amount = :amount WHERE ip = :ip");
        $stmt->execute(['amount' => $amount, 'ip' => $ip]);
    } else {
        $amount = 1;
        $stmt = $pdo->prepare("INSERT INTO visiting (ip, amount) VALUES (:ip, :amount)");
        $stmt->execute(['ip' => $ip, 'amount' => $amount]);
    }

    return $amount;
}

function sum($pdo) {
    $stmt = $pdo->prepare("SELECT SUM(amount) AS all_visits FROM visiting");
    $stmt->execute();
    $new = $stmt->fetch(PDO::FETCH_ASSOC);
    return $new['all_visits'];
}


$visitors = new Visiting();
$pdo = $visitors->open();
function get_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$ip = get_ip();
$amount = visits($pdo, $ip);
$all_visits = sum($pdo);
$visitors->close();

$modelLogging = logging('saving');
$modelLogging(['ip' => $ip, 'amount' => $amount]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Task', 'Visits'],
          ['Current Ip', <?php echo $amount; ?>],
          ['Total Visits', <?php echo $all_visits; ?>]
        ]);

        var options = {
          width: 800,
          legend: { position: 'none' },
          axes: {
            x: {
              0: { side: 'top', label: 'Visiting the site'} 
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>
</head>
<body>
<div id="top_x_div" style="width: 400px; height: 300px; margin-left:370px;"></div>
</body>
</html>

