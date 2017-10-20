<!DOCTYPE html>
<html>
<title>賣家空間</title>
<meta charset="utf-8">
<body align="center" bgcolor = "pink">

    <div  style="text-align:right">
        <form action="" method="POST">
            賣家
            <?php

                $dbhost = "localhost";
                $dbuser = "root";
                $dbpwd = "";
                $dbname = "pay2go";;
                $conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);
                mysqli_set_charset($conn, "UTF8");

                session_start(); 
                $Account = $_SESSION['var1'];
                $Password = $_SESSION['var2'];
                $sql = "SELECT * FROM seller WHERE Account = '$Account' AND Password = '$Password'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $Name = $row["Name"];
                echo''.$Name.' 您好';
            ?>
            <input type="submit" value="登出" name="logout">
        </form>
    </div>
            
    <div style="text-align:center">
        <h1 style="font-weight: bold;">商品目錄</h1>

        <p style="font-weight: bold;">選擇遊戲種類</p>
     
        <form action="" method="POST" onchange = submit()>
        <select size="1" name="test">
            <option value="1" name = "1"></option>
            <option value="Nexon" name = "Nexon">Nexon</option>
            <option value="BD" name = "BD">黑色沙漠</option>
            <option value="SDNE" name = "SDNE">SDNE</option>
        </select>
        </form>
        <HR>
        <?php
            $sel = isset($_POST['test']) ? $_POST['test'] : false;
            
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////         
           if($sel == 'Nexon'){

                $sql = "SELECT * FROM pay2go ORDER BY ID DESC";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    echo "<center>"."-- Nexon 訂單 --"."</center>";
                    echo '<table border="1" style="width:90%" align="center">';
                    echo "<tr>"."<td align='center'>"."編號"."</td>".
                                "<td align='center'>"."點數"."</td>".
                                "<td align='center'>"."數量"."</td>".
                                "<td align='center'>"."姓名"."</td>".
                                "<td align='center'>"."電話"."</td>".
                                "<td align='center'>"."E-mail"."</td>".
                                "<td align='center'>"."應付金額"."</td>".
                                "<td align='center'>"."付款方式"."</td>".
                                "<td align='center'>"."銀行帳號/超商代碼"."</td>".
                                "<td align='center'>"."是否付款"."</td>".
                                "<td align='center'>"."是否出貨"."</td>".
                                "</tr>";
                   // $count = 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        $price = $row["price"];
                        $amount = $row["amount"];
                        $payment = $row["payment"];
                        $Name = $row["Name"];
                        $phoneNum = $row["phoneNum"];
                        $email = $row["email"];
                        $sellCode = $row["sellCode"];
                        $total = $row["total"];
                        $ID = $row["ID"];
                        $isPay = $row["isPay"];
                        $itemOut = $row["itemOut"];
                        
                       
                        echo "<tr>"."<td>". $ID."</td>".
                                    "<td>". $price."</td>".
                                    "<td>". $amount."</td>".
                                    "<td>". $Name."</td>".
                                    "<td>". $phoneNum."</td>".
                                    "<td>". $email."</td>".
                                    "<td>". $total."</td>";
                        if($row["payment"] == 'familyMarket'){
                            echo "<td>".'超商繳費'."</td>";
                        }
                        elseif($row["payment"] == 'ATM'){
                            echo "<td>".'ATM轉帳'."</td>";
                        }
                        echo "<td>".$sellCode."</td>";
                        if($isPay == '1')
                        {
                            $payDate = $row["payDate"];
                            echo "<td>".$payDate." 已付款</td>";
                        }
                        else
                        {
                            print"<form action='' method='POST'>";
                            print"<td><input type='submit' name='".$ID."' value = '變更為已付款'></td>";
                            print"</form>";
                        }
                        if($itemOut == '1')
                        {
                            $sellDate = $row["sellDate"];
                            echo "<td>".$sellDate." 已提卡</td>";
                        }
                        else
                        {
                            echo "<td>未提卡</td></tr>";
                        }
                       // $count = $count+1;
                    }
                    
                }
                else {
                    echo "沒有訂單";
                }

                print"<br><form action='' method='POST'>";
                print"<input type='submit' name='upload' value = '上傳代碼'>";
                print"</form><br>";
               
            }

            for($counter = 1 ; $counter <= 1000 ; $counter++){
                    if(isset($_POST[$counter]))
                    {
                        $sql = "UPDATE pay2go SET isPay = '1' WHERE ID = '$counter'";
                        $result = mysqli_query($conn, $sql);

                        if($result)
                        {

                            $test = getDate();
                            $test2 = $test["year"].'-'.$test["mon"].'-'.$test["mday"] ;

                            $sql = "UPDATE pay2go set payDate = '$test2' where ID = '$counter'";
                            $result = mysqli_query($conn, $sql);


                            echo "第";
                            echo $counter;
                            echo "號Nexon訂單已被確認為付款狀態";
                            echo "<br><br>";
                            $sql = "SELECT * FROM pay2go where ID = $counter";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);

                            echo "以下是該訂單的詳細資料";
                            //  表格-------------------------------------------------
                            echo '<table border="1" style="width:80%" align="center">';
                            echo "<tr>"."<td align='center'>"."編號"."</td>".
                                        "<td align='center'>"."點數"."</td>".
                                        "<td align='center'>"."數量"."</td>".
                                        "<td align='center'>"."姓名"."</td>".
                                        "<td align='center'>"."電話"."</td>".
                                        "<td align='center'>"."E-mail"."</td>".
                                        "<td align='center'>"."應付金額"."</td>".
                                        "<td align='center'>"."付款方式"."</td>".
                                        "<td align='center'>"."銀行帳號/超商代碼"."</td>".
                                        "<td align='center'>"."是否付款"."</td>".
                                        "</tr>";

                            
                            $price = $row["price"];
                            $amount = $row["amount"];
                            $payment = $row["payment"];
                            $Name = $row["Name"];
                            $phoneNum = $row["phoneNum"];
                            $email = $row["email"];
                            $sellCode = $row["sellCode"];
                            $total = $row["total"];
                            $ID = $row["ID"];
                            $isPay = $row["isPay"];
                            
                                
                               
                            echo "<tr>"."<td>". $ID."</td>".
                                            "<td>". $price."</td>".
                                            "<td>". $amount."</td>".
                                            "<td>". $Name."</td>".
                                            "<td>". $phoneNum."</td>".
                                            "<td>". $email."</td>".
                                            "<td>". $total."</td>";
                            if($row["payment"] == 'familyMarket')
                            {
                                    echo "<td>".'超商繳費'."</td>";
                            }
                            elseif($row["payment"] == 'ATM'){
                                echo "<td>".'ATM轉帳'."</td>";
                            }
                            echo "<td>".$sellCode."</td>";
                            if($isPay == '1')
                            {
                                $payDate = $row["payDate"];
                                echo "<td>".$payDate."</td>";
                            }
                             else
                            {
                                 echo "<td>".'未繳費'."</td>";
                             }
                        }
                    break;
                    }
            }            
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////             
            if($sel == 'BD'){
                $sql = "SELECT * FROM pay2gobd ORDER BY ID DESC";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    echo "<center>"."-- 黑色沙漠 訂單 --"."</center>";
                    echo '<table border="1" style="width:80%" align="center">';
                    echo "<tr>"."<td align='center'>"."編號"."</td>".
                                "<td align='center'>"."點數"."</td>".
                                "<td align='center'>"."數量"."</td>".
                                "<td align='center'>"."姓名"."</td>".
                                "<td align='center'>"."電話"."</td>".
                                "<td align='center'>"."帳號"."</td>".
                                "<td align='center'>"."密碼"."</td>".
                                "<td align='center'>"."應付金額"."</td>".
                                "<td align='center'>"."付款方式"."</td>".
                                "<td align='center'>"."銀行帳號/超商代碼"."</td>".
                                "<td align='center'>"."是否付款"."</td>".
                                "<td align='center'>"."是否出貨"."</td>".
                                "</tr>";
                   // $count = 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        $price = $row["price"];
                        $amount = $row["amount"];
                        $payment = $row["payment"];
                        $Name = $row["Name"];
                        $phoneNum = $row["phoneNum"];
                        $sellCode = $row["sellCode"];
                        $total = $row["total"];
                        $ID = $row["ID"];
                        $isPay = $row["isPay"];
                        $Account = $row["Account"];
                        $Password = $row["Password"];
                        $itemOut = $row["itemOut"];
                       
                        echo "<tr>"."<td>". $ID."</td>".
                                    "<td>". $price."</td>".
                                    "<td>". $amount."</td>".
                                    "<td>". $Name."</td>".
                                    "<td>". $phoneNum."</td>".
                                    "<td>". $Account."</td>".
                                    "<td>". $Password."</td>".
                                    "<td>". $total."</td>";
                        if($row["payment"] == 'familyMarket'){
                            echo "<td>".'超商繳費'."</td>";
                        }
                        elseif($row["payment"] == 'ATM'){
                            echo "<td>".'ATM轉帳'."</td>";
                        }
                        echo "<td>".$sellCode."</td>";
                        if($isPay == '1')
                        {
                            $payDate = $row["payDate"];
                            echo "<td>".$payDate." 已付款</td>";
                        }
                        else
                        {
                            $ID = $ID*100;
                            print"<form action='' method='POST'>";
                            print"<td><input type='submit' name='".$ID."' value = '變更為已付款'></td>";
                            print"</form>";
                            $ID = $ID/100;
                        }

                         if($itemOut == '1')
                        {
                            $sellDate = $row["sellDate"];
                            echo "<td>".$sellDate." 儲值完成</td>";
                        }
                        else
                        {
                            $ID = $ID*100;
                            print"<form action='' method='POST'>";
                            print"<td><input type='submit' name='".$ID."' value = '通知儲值完成'></td></tr>";
                            print"</form>";
                            $ID = $ID/100;
                        }
                       // $count = $count+1;
                        
                    }
                }
                else {
                    echo "沒有訂單";
                }
                
            }
            for($counter = 1 ; $counter <= 99 ; $counter++)
            {   

                    $counter = $counter*100;
                    if(isset($_POST[$counter]))
                    {   
                        $counter = $counter/100;

                        if($result)
                        {
                                
                                

                                $sql = "SELECT * FROM pay2gobd where ID = $counter";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                
                                $isPay = $row["isPay"];
                                echo "第";
                                echo $counter;
                                if($isPay == 0)
                                {   
                                    $test = getDate();
                                    $test2 = $test["year"].'-'.$test["mon"].'-'.$test["mday"] ;
                                    $sql = "UPDATE pay2gobd set payDate = '$test2' where ID = '$counter'";
                                    $result = mysqli_query($conn, $sql);                      
                                    $sql = "UPDATE pay2gobd SET isPay = '1' WHERE ID = '$counter'";
                                    $result = mysqli_query($conn, $sql);
                                    echo "號黑色沙漠訂單已被確認為付款狀態";
                                }
                                else
                                {   
                                    $test = getDate();
                                    $test2 = $test["year"].'-'.$test["mon"].'-'.$test["mday"] ;
                                    $sql = "UPDATE pay2gobd set sellDate = '$test2' where ID = '$counter'";
                                    $result = mysqli_query($conn, $sql);
                                    echo "號黑色沙漠訂單已被更改為儲值完成";
                                    $sql = "UPDATE pay2gobd SET itemOut= '1' WHERE ID = '$counter'";
                                    $result = mysqli_query($conn, $sql);
                                    $itemOut = 1;
                                }
                                echo "<br><br>";


                                echo "以下是該訂單的詳細資料";
                                //  表格-------------------------------------------------
                                echo '<table border="1" style="width:80%" align="center">';
                                echo "<tr>"."<td align='center'>"."編號"."</td>".
                                            "<td align='center'>"."點數"."</td>".
                                            "<td align='center'>"."數量"."</td>".
                                            "<td align='center'>"."姓名"."</td>".
                                            "<td align='center'>"."電話"."</td>".
                                            "<td align='center'>"."帳號"."</td>".
                                            "<td align='center'>"."密碼"."</td>".
                                            "<td align='center'>"."應付金額"."</td>".
                                            "<td align='center'>"."付款方式"."</td>".
                                            "<td align='center'>"."銀行帳號/超商代碼"."</td>".
                                            "<td align='center'>"."是否付款"."</td>".
                                            "<td align='center'>"."是否出貨"."</td>".
                                            "</tr>";

                                $sql = "SELECT * FROM pay2gobd where ID = $counter";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $price = $row["price"];
                                $amount = $row["amount"];
                                $payment = $row["payment"];
                                $Name = $row["Name"];
                                $phoneNum = $row["phoneNum"];
                                $Account = $row["Account"];
                                $Password = $row["Password"];
                                $sellCode = $row["sellCode"];
                                $total = $row["total"];
                                $ID = $row["ID"];
                                $isPay = $row["isPay"];
                                $itemOut = $row["itemOut"];
                                   
                                echo "<tr>"."<td>". $ID."</td>".
                                                "<td>". $price."</td>".
                                                "<td>". $amount."</td>".
                                                "<td>". $Name."</td>".
                                                "<td>". $phoneNum."</td>".
                                                "<td>". $Account."</td>".
                                                "<td>". $Password."</td>".
                                                "<td>". $total."</td>";
                                if($row["payment"] == 'familyMarket'){
                                        echo "<td>".'超商繳費'."</td>";
                                }
                                elseif($row["payment"] == 'ATM'){
                                    echo "<td>".'ATM轉帳'."</td>";
                                }
                                echo "<td>".$sellCode."</td>";
                                if($isPay == '1')
                                {
                                    $payDate = $row["payDate"];
                                    echo "<td>".$payDate." 已付款</td>";
                                }
                                else
                                {
                                     echo "<td>".'未繳費'."</td>";
                                }
                                if($itemOut == '1')
                                {
                                    $sellDate = $row["sellDate"];
                                    echo "<td>".$sellDate." 儲值完成</td>";
                                }
                                else
                                {
                                    echo "<td>尚未儲值</td>";
                                }

                        }
                        break;
                    }
                    $counter = $counter/100;
             }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                
            if($sel == 'SDNE'){
                $sql = "SELECT * FROM pay2gosdne ORDER BY ID ASC";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    echo "<center>"."-- SDNE 訂單 --"."</center>";
                    echo '<table border="1" style="width:80%" align="center">';
                    echo "<tr>"."<td align='center'>"."編號"."</td>".
                                "<td align='center'>"."點數"."</td>".
                                "<td align='center'>"."數量"."</td>".
                                "<td align='center'>"."姓名"."</td>".
                                "<td align='center'>"."電話"."</td>".
                                "<td align='center'>"."角色名稱"."</td>".
                                "<td align='center'>"."應付金額"."</td>".
                                "<td align='center'>"."付款方式"."</td>".
                                "<td align='center'>"."銀行帳號/超商代碼"."</td>".
                                "<td align='center'>"."是否付款"."</td>".
                                "<td align='center'>"."是否出貨"."</td>".
                                "</tr>";
                   // $count = 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        $price = $row["price"];
                        $amount = $row["amount"];
                        $payment = $row["payment"];
                        $Name = $row["Name"];
                        $phoneNum = $row["phoneNum"];
                        $sellCode = $row["sellCode"];
                        $total = $row["total"];
                        $ID = $row["ID"];
                        $isPay = $row["isPay"];
                        $gameID = $row["gameID"];
                        $itemOut = $row["itemOut"];
                       
                        echo "<tr>"."<td>". $ID."</td>".
                                    "<td>". $price."</td>".
                                    "<td>". $amount."</td>".
                                    "<td>". $Name."</td>".
                                    "<td>". $phoneNum."</td>".
                                    "<td>". $gameID."</td>".
                                    "<td>". $total."</td>";
                        if($row["payment"] == 'familyMarket'){
                            echo "<td>".'超商繳費'."</td>";
                        }
                        elseif($row["payment"] == 'ATM'){
                            echo "<td>".'ATM轉帳'."</td>";
                        }
                        echo "<td>".$sellCode."</td>";
                        if($isPay == '1')
                        {
                            $payDate = $row["payDate"];
                            echo "<td>".$payDate." 已付款</td>";
                        }
                        else
                        {
                            $ID = $ID*10000;
                            print"<form action='' method='POST'>";
                            print"<td><input type='submit' name='".$ID."' value = '變更為已付款'></td>";
                            print"</form>";
                            $ID = $ID/10000;
                        }
                        if($itemOut == '1')
                        {
                            $sellDate = $row["sellDate"];
                            echo "<td>".$sellDate." 儲值完成</td>";
                        }
                        else
                        {
                            $ID = $ID*10000;
                            print"<form action='' method='POST'>";
                            print"<td><input type='submit' name='".$ID."' value = '通知儲值完成'></td></tr>";
                            print"</form>";
                            $ID = $ID/10000;
                        }
                       // $count = $count+1;
                        
                    }
                }
                else {
                    echo "沒有訂單";
                }
                
            }
            for($counter = 1 ; $counter <= 99 ; $counter++){
                    $counter = $counter*10000;
                    if(isset($_POST[$counter]))
                    {
                        
                    $counter = $counter/10000;
                        $sql = "SELECT * FROM pay2gosdne where ID = $counter";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $isPay = $row["isPay"];;

                        if($result){
                            echo "第";
                            echo $counter;
                            
                            if($isPay == '0')
                            {   
                                $test = getDate();
                                $test2 = $test["year"].'-'.$test["mon"].'-'.$test["mday"] ;             
                                $sql = "UPDATE pay2gosdne set payDate = '$test2' where ID = '$counter'";
                                $result = mysqli_query($conn, $sql);

                                $sql = "UPDATE pay2gosdne SET isPay = '1' WHERE ID = '$counter'";
                                $result = mysqli_query($conn, $sql);
                                echo "號SDNE訂單已被確認為付款狀態";
                            }
                            else
                            {   
                                $test = getDate();
                                $test2 = $test["year"].'-'.$test["mon"].'-'.$test["mday"] ;
                                $sql = "UPDATE pay2gosdne set sellDate = '$test2' where ID = '$counter'";
                                $result = mysqli_query($conn, $sql);
                                echo "號SDNE訂單已被更改為儲值完成";
                                $sql = "UPDATE pay2gosdne SET itemOut= '1' WHERE ID = '$counter'";
                                $result = mysqli_query($conn, $sql);
                                $itemOut = 1;
                            }

                            echo "<br><br>";
                            

                            echo "以下是該訂單的詳細資料";
                            //  表格-------------------------------------------------
                            echo '<table border="1" style="width:80%" align="center">';
                            echo "<tr>"."<td align='center'>"."編號"."</td>".
                                        "<td align='center'>"."點數"."</td>".
                                        "<td align='center'>"."數量"."</td>".
                                        "<td align='center'>"."姓名"."</td>".
                                        "<td align='center'>"."電話"."</td>".
                                        "<td align='center'>"."角色名稱"."</td>".
                                        "<td align='center'>"."應付金額"."</td>".
                                        "<td align='center'>"."付款方式"."</td>".
                                        "<td align='center'>"."銀行帳號/超商代碼"."</td>".
                                        "<td align='center'>"."是否付款"."</td>".
                                        "<td align='center'>"."是否出貨"."</td>".
                                        "</tr>";

                           
                            $sql = "SELECT * FROM pay2gosdne where ID = $counter";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $price = $row["price"];
                            $amount = $row["amount"];
                            $payment = $row["payment"];
                            $Name = $row["Name"];
                            $phoneNum = $row["phoneNum"];
                            $gameID = $row["gameID"];
                            $sellCode = $row["sellCode"];
                            $total = $row["total"];
                            $ID = $row["ID"];
                            $isPay = $row["isPay"];
                            $itemOut = $row["itemOut"];
                            $sellDate = $row["sellDate"];
                            $payDate = $row["payDate"];
                                
                               
                            echo "<tr>"."<td>". $ID."</td>".
                                            "<td>". $price."</td>".
                                            "<td>". $amount."</td>".
                                            "<td>". $Name."</td>".
                                            "<td>". $phoneNum."</td>".
                                            "<td>". $gameID."</td>".
                                            "<td>". $total."</td>";
                            if($row["payment"] == 'familyMarket'){
                                    echo "<td>".'超商繳費'."</td>";
                            }
                            elseif($row["payment"] == 'ATM'){
                                echo "<td>".'ATM轉帳'."</td>";
                            }
                            echo "<td>".$sellCode."</td>";
                            if($isPay == '1')
                            {
                                $payDate = $row["payDate"];
                                echo "<td>".$payDate." 已付款</td>";
                            }
                            else
                            {
                                echo "<td>".'未繳費'."</td>";
                            }
                            if($itemOut == '1')
                            {
                                $sellDate = $row["sellDate"];
                                echo "<td>".$sellDate." 儲值完成</td>";
                            }
                            else
                            {
                                echo "<td>尚未儲值</td>";
                            }
                        }
                    break;
                    }
                    $counter = $counter/10000;
            }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////             
            if(isset($_POST['logout'])){
                echo '<meta http-equiv="refresh" content="0; url=index.php">';
            }

            

            if(isset($_POST['upload'])){
                ?>
                <p>--Nexon 點卡--<br></p>
        
                <form action="" method="POST">
                <table  align="center">

                <tr>
                <td><br></td><td>-----------------第一筆-------------------<br></td>
                </tr>

                <tr>
                <td>產品單價:</td>
                    <td>    
                            <input type="radio" name="cardPrice" value="155">155元  (5000  點)
                            <input type="radio" name="cardPrice" value="300">300元 (10000 點)
                    </td><span id="ShowErrorPrice"></span>
                </tr>
                
                <tr>
                <td>卡號:</td> <td> <input type=text name='cardNum'></td>
                </tr>


                <tr>
                <td>                   <br></td><td>-<br>----------------第二筆-------------------<br></td>
                </tr>

                <tr>
                <td>產品單價:</td>
                    <td>    
                            <input type="radio" name="cardPrice2" value="155">155元  (5000  點)
                            <input type="radio" name="cardPrice2" value="300">300元 (10000 點)
                    </td><span id="ShowErrorPrice"></span>
                </tr>  

                <tr>
                <td>卡號:</td> <td> <input type=text name='cardNum2'></td>
                </tr>


                <tr>
                <td>                   <br></td><td>-<br>----------------第三筆-------------------</td>
                </tr>

                <tr>
                <td>產品單價:</td>
                    <td>    
                            <input type="radio" name="cardPrice3" value="155">155元  (5000  點)
                            <input type="radio" name="cardPrice3" value="300">300元 (10000 點)
                    </td><span id="ShowErrorPrice"></span>
                </tr>  

                <tr>
                <td>卡號:</td> <td> <input type=text name='cardNum3'></td>
                </tr>


                </table>
                <br>
                <input type="submit" name="upload_Nexon" value="Click">
                </form>
                <?php
            }
            if (isset($_POST['upload_Nexon']) && !empty($_POST["cardPrice"])  && !empty($_POST['cardNum']))
            {
                $cardPrice = $_POST['cardPrice'];
                
                $cardNum = $_POST['cardNum'];
                

                $sql = "SELECT ID FROM Nexon ORDER BY ID DESC";
                $result = mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($result);
                
                $ID=($row['ID']+1);

                $sql = "INSERT INTO Nexon(cardPrice, cardNum, ID) VALUES ('$cardPrice', '$cardNum', '$ID');";
                $result = mysqli_query($conn, $sql);
                

                if ( !empty($_POST["cardPrice2"]) && !empty($_POST['cardNum2'])) 
                {
                    $ID++;
                    $cardPrice2 = $_POST['cardPrice2'];
                    $cardNum2 = $_POST['cardNum2'];
                    $sql = "INSERT INTO Nexon(cardPrice, cardNum, ID) VALUES ('$cardPrice2', '$cardNum2', '$ID');";
                    $result = mysqli_query($conn, $sql);


                }

                if ( !empty($_POST["cardPrice3"]) && !empty($_POST['cardNum3']) ) 
                {
                    $ID++;
                    $cardPrice3 = $_POST['cardPrice3'];
                    $cardNum3 = $_POST['cardNum3'];
                    $sql = "INSERT INTO Nexon(cardPrice, cardNum, ID) VALUES ('$cardPrice3', '$cardNum3', '$ID');";
                    $result = mysqli_query($conn, $sql);


                }

                if ($result) {
                    echo "上傳成功!!";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
          
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            mysqli_close($conn);
        ?>
     </div>
    
</body>
</html>