<?php
    $fname =  $_POST['fname'];
    $lname =  $_POST['lname'];
    $email =  $_POST['email'];

    $mysql = new mysqli('127.0.0.1', 'root', 'root', 'new-tasks');

    $mysql->query("INSERT INTO `users` (`first_name`, `last_name`, `email`) VALUES('$fname', '$lname', '$email')");



    $user = $mysql->query("SELECT * FROM `users` WHERE `email`='$email'");
    $user_id =  mysqli_fetch_assoc($user)['id'];

    $sum = 0;
    foreach($_COOKIE as $k => $v) {
        $str = (explode("_", $_COOKIE[$k]));
        $price = $mysql->query("SELECT * FROM `products` WHERE `id`='$str[0]'");
        $price1 = mysqli_fetch_assoc($price)['price'];

        $sum = $sum + $str[1] * $price1;

    }
    $mydate=getdate(date("U"));
    $mydate[hours] = $mydate[hours] + 1;
    $date = "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year], $mydate[hours]:$mydate[minutes]:$mydate[seconds]";

    $mysql->query("INSERT INTO `orders` (`user_id`, `sum`, `order_date`) VALUES('$user_id', '$sum', '$date')");



    $order = $mysql->query("SELECT * FROM `orders` ORDER BY id DESC LIMIT 1");
    $orders_id =  mysqli_fetch_assoc($order);
    $order_id = $orders_id['id'];
    foreach($_COOKIE as $k => $v) {
        $str = (explode("_", $_COOKIE[$k]));
        $mysql->query("INSERT INTO `order_products` (`order_id`, `product_id`, `qty`) VALUES('$order_id', '$str[0]', '$str[1]')");
    }
    $mysql->close();


    foreach($_COOKIE as $k => $v) {
        setcookie($k, $_COOKIE[$k], time() - 2);
    }


    header('Location: http://last/browser/buy.php');

    exit();
?>