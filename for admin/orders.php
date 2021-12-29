<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <table>
        <tr>
            <th>order id</th>
            <th>order date</th>
            <th>firstname</th>
            <th>lastname</th>
            <th>email</th>
            <th>product name</th>
            <th>description</th>
            <th>price</th>
            <th>Quantity</th>
            <th>total price</th>
        </tr>
        <?php
            $mysql = new mysqli('127.0.0.1', 'root', 'root', 'new-tasks');
            $orders = $mysql->query("SELECT * FROM `orders`"); // ordera get date
            while ($row = mysqli_fetch_assoc($orders)) {
                $userId = $row[user_id];
                $users =  $mysql->query("SELECT * FROM `users` WHERE `id` = $userId"); //users info
                $userInfo = mysqli_fetch_assoc($users);
                $productIn =  $mysql->query("SELECT * FROM `order_products` WHERE `order_id` = $row[id]"); //products included in order
                $prod = mysqli_fetch_assoc($productIn);
                $productId = $prod[product_id];
                $info =  $mysql->query("SELECT * FROM `products` WHERE `id` = $productId"); //product info
                $productInfo = mysqli_fetch_assoc($info);
                
                ?>
                <tr>
                    <th><?php echo($row[id]) ?></th>
                    <th><?php echo($row[order_date]) ?></th>
                    <th><?php echo($userInfo[first_name]) ?></th>
                    <th><?php echo($userInfo[last_name]) ?></th>
                    <th><?php echo($userInfo[email]) ?></th>
                    <th><?php echo($productInfo[name]) ?></th>
                    <th><?php echo($productInfo[description]) ?></th>
                    <th><?php echo($productInfo[price]) ?></th>
                    <th><?php echo($prod[qty]) ?></th>
                    <th><?php echo($productInfo[price] * $prod[qty]) ?></th>
                </tr>

                <?php
                while ($row1 = mysqli_fetch_assoc($productIn)) {
                    $userId1 = $row1[user_id];
                    $users1 =  $mysql->query("SELECT * FROM `users` WHERE `id` = $userId1"); //users info
                    // $userInfo1 = mysqli_fetch_assoc($users1);
                    $productIn1 =  $mysql->query("SELECT * FROM `order_products` WHERE `order_id` = $row1[id]"); //products included in order
                    $prod1 = mysqli_fetch_assoc($productIn1);
                    $productId1 = $row1[product_id];
                    $info1 =  $mysql->query("SELECT * FROM `products` WHERE `id` = $productId1"); //product info
                    $productInfo1 = mysqli_fetch_assoc($info1);
                    ?>
                    

                    <tr>
                        <th><?php echo($userId1); ?> </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><?php echo($productInfo1[name]) ?></th>
                        <th><?php echo($productInfo1[description]) ?></th>
                        <th><?php echo($productInfo1[price]) ?></th>
                        <th><?php echo($row1[qty]) ?></th>
                        <th><?php echo($productInfo1[price] * $row1[qty]) ?></th>
                    </tr>
                    <?php
                }
            }

        ?>
    </table>
</body>
</html>



