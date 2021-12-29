<?php 
    $name =  $_POST['name']; 
    $description =  $_POST['description']; 
    $price = trim($_POST['price']); 
    // print_r($name . '<br>' . $description . '<br>' . $price);

    $mysql = new mysqli('127.0.0.1', 'root', 'root', 'new-tasks');
    $mysql->query("INSERT INTO `products` (`name`, `description`, `price`) VALUES('$name', '$description', '$price')");
            
    $mysql->close();
    
    header('Location: http://last/browser/addProducts.php');
    exit();
?>
<!-- object ev zangvac
reference types
for and while
js types
let const var 
lexikal scopes -->