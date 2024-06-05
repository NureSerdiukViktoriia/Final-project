<?php 
namespace Controllers;
use Models\Db3;
use Models\Db;
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

require_once __DIR__ . '/../controllers/code.php';
require_once __DIR__ . '/../models/db2.php';
require_once __DIR__ . '/../models/Db3.php';


if(isset($_SESSION["user"])){
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    if (preg_match('/^[a-zA-Zа-яА-ЯїЇєЄіІёЁ\s?!.,]+$/u', $comment)) {
    try {
        $db3 = new Db3();
        $conn = $db3->getConnection();
        $conn->query("USE comments");
        $comment = $_POST['comment'];
        $request = $conn->prepare("INSERT INTO comments (user_name, comment) VALUES (:user_name, :comment)");
        $user_name = $_SESSION['user'];
        $request->execute([
            ':user_name' => $user_name,
            ':comment' => $comment
        ]);
        
        ?>
        <!-- <div class="added-comment">Comment added successfully!</div> -->
        <?php
        echo "<br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $db3->close();
    }
}else{
    ?>
    <div class="text-c">
<p>
Only text can be used
</p>
    </div>
    <?php
}
}
}


?>

<form action="" method="post">
    <?php if(isset($_SESSION['user'])): ?>
        <input type="hidden" name="user_name" value="<?php echo htmlspecialchars($_SESSION['user']); ?>">
    <?php else: ?>
       <p class="comment-t">Please log in or register to leave a comment</p>
    <?php endif; ?>
    <textarea name="comment" placeholder="Comment" required class="comment-textarea"></textarea><br>
    <button type="submit" class="save-button">Save</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment']) && isset($_SESSION["user"])) {
   ?>
    <div class="added-comment">Comment added successfully!</div>
    <?php
}

?>




</body>
</html>