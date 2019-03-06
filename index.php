
<?php
require 'admin/database.php';
$db = Database::connect();


$firstname = $name = $phone = "";



if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $firstname = verifyInput($_POST['firstname']);
    $name = verifyInput($_POST['name']);
    $phone = verifyInput($_POST['phone']);
    $isSucess = True;    

}

$req = $db->prepare("INSERT INTO formulaire (firstname, name, phone) VALUES (:firstname, :name, :phone)");
$req->execute(array(
            ':firstname'=>$firstname,
            ':name'=>$name,
            ':phone'=>$phone)
);


function isPhone($var)
{
    return preg_match("/^[0-9 ]*$/", $var);
}


function verifyInput($var)
{
    $var = trim($var);
    $var = stripcslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
<body>
<form id="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="boxInput">
  First name: <input type="text" name="firstname"><br>
  Last name: <input type="text" name="name"><br><br>
  Phone: <input type="phone" name="phone"><br><br>
  <input type="button" onclick="myFunction()" value="submit form">
</form>

<script>
function myFunction() {
  document.getElementById("myForm").submit();
}
</script>

</body>
</html>
