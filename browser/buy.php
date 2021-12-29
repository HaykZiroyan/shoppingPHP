<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>online shop</title>
    <link rel="icon" href="/images/download.png">
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <div id = "card" class="card-container">
        <?php
            
            $mysql = new mysqli('127.0.0.1', 'root', 'root', 'new-tasks');
        
            $result = $mysql->query("SELECT * FROM `products`");
            // $rows = $result->fetch_assoc();
            $array = array();
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($array, ["id"=>$row["id"], "price"=> $row["price"], "description"=> $row["description"], "name"=> $row["name"]]); 
            }
            $array1 = array();
            for ($i = 0; $i < ceil(mysqli_num_rows($result)/5); $i++) {
                array_push($array1, array());
                for ($j = 0; $j < 5; $j++) {
                    $k = 5*$i + $j;
                    array_push($array1[$i], $array[$k]);
                    

                    if ($k+1 == count($array)) {
                            break;
                        }
                }
            }
            for ($i = 0; $i < count($array1); $i++) {
          
                    ?>
                
                    <div class="cont">

                    <?php
                    
                    $curr_cont_cards  =   $array1[$i];
                    foreach ($curr_cont_cards as $card){
                    ?>
                            <form class="card" action="newfunc.php" method="post">
                                <h3><?=$card["name"];?></h3>
                                <p><?=$card["description"];?></p>
                                <h2 class="price"><?=$card["price"];?></h2>
                                <input type="hidden" name="id" value="<?= $card[id] ?>">
                                <input type = "number" value='1' name="count">
                                <button class="set-busket" type="submit">add to busket</button>
                            </form>
                    <?php } ?>
                        </div> 
               <?php  
            }

            
    
        ?>
    </div>
    <a href="karzina.php" class="karzina scrollKar">
        <img src="/images/basket.png" alt="">
        <div id="New" class="num">
            <p>0</p>
        </div>
    </a>
    
    
    
</body>
</html>
<?php
    $mysql->close();
?>