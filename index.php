<!DOCTYPE html>
<html>
<title>首頁</title>
<meta charset="utf-8">
<body align="center" bgcolor = "pink">
	<script type="text/javascript">
	function ShowErrorMessage(){
	    document.getElementById("ShowErrorMessage").innerHTML='帳號密碼錯誤';
	}
	function Error(){
		document.getElementById("Error").click();
	}
	function ShowErrorPrice(){
	    document.getElementById("ShowErrorMessage").innerHTML='未填寫價格';
	}
    NewImg = new Array ("000.jpg","001.jpg","002.jpg"); 
	var ImgNum = 0; 
	var ImgLength = NewImg.length - 1; 
	var delay = 3000; 
	var lock = false; 
	var run; 
	function chgImg(direction) { 
	        if (document.images) { 
	                ImgNum = ImgNum + direction; 
	            if (ImgNum > ImgLength) { 
	                ImgNum = 0; 
	            } 
	            if (ImgNum < 0) { 
	                ImgNum = ImgLength; 
	            } 
	            document.slideshow.src = NewImg[ImgNum]; 
	        } 
	}       
	function auto() { 
	        if (lock == true) { 
	                lock = false; 
	                window.clearInterval(run); 
	        } 
	        else if (lock == false) { 
	            lock = true; 
	            run = setInterval("chgImg(1)", delay); 
	        } 
	} 
    </script>
	
	<div  style="text-align:right">
		<form action="" method="POST">
			<input type="submit" value="回首頁" name="home">
			賣家登入  
				帳號:
				<input type="text" name="SellAccount">
				密碼:
				<input type="password" name="SellPassword">
				<input type="submit" value="login" name = "login">
		</form>
		<span id="ShowErrorMessage"></span>
	</div>
    <div style="text-align:center">
        <h1 style="font-weight: bold;">Hello, welcome to pay to go.</h1>
        <HR>

        <marquee  onMouseOver="this.stop()" onMouseOut="this.start()"> Nexon神祭超絕UP中  黑色沙漠 和 SDNE 二一者購買10萬送1萬</marquee>

		<form action="" method="POST">
        <p style="font-weight: bold;">顯示Nexon點卡庫存</p>
        <input type="submit" value="Click" name = "submit">
		</form>
		
        
		
		<p style="font-weight: bold;">查詢/修改訂單/領取點卡</p>
		<a href="search.php">
        <input type="submit" value="Click"> 
		</a>
		<HR>


		<p style="font-weight: bold;">你要買什麼遊戲的點數?</p>
		<form action="" method="POST" onchange = submit()>
        <select size="1" name="test">
            <option value="1" name = "1"></option>
            <option value="Nexon" name = "Nexon">Nexon</option>
            <option value="BD" name = "BD">黑色沙漠</option>
            <option value="SDNE" name = "SDNE">SDNE</option>
        </select>
		</form>

		
        <br><br>
        <script>
            var imgnumber = Math.floor(Math.random()*3);
            var imgurl = [
                '000.jpg',
                '001.jpg',
                '002.jpg',
            ];
            document.write('<img id="image" src="'+imgurl[imgnumber]+'" name="slideshow"  height="300px">');
            auto();
        </script>
		
		<?php
			function curl_work($url = "", $parameter = "") 
			 {
		 		$curl_options = array
		 		(
					CURLOPT_URL => $url,
					CURLOPT_HEADER => false,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_USERAGENT => "Google Bot",
					//CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_SSL_VERIFYPEER => FALSE,
					CURLOPT_SSL_VERIFYHOST => FALSE,
					CURLOPT_POST => "1",
					CURLOPT_POSTFIELDS => $parameter
				);

				$ch = curl_init();
				curl_setopt_array($ch, $curl_options);
				$result = curl_exec($ch);
				$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				$curl_error = curl_errno($ch);
				curl_close($ch);
				$return_info = array
				(
					"url" => $url,
					"sent_parameter" => $parameter,
					"http_status" => $retcode,
					"curl_error_no" => $curl_error,
					"web_info" => $result,
				);
		 		return $return_info;
		 	}

			//require_once('../include/configure.php');

			$dbhost = "localhost";
			$dbuser = "root";
			$dbpwd = "";
			$dbname = "pay2go";
			$sel = isset($_POST['test']) ? $_POST['test'] : false;


			$sel = isset($_POST['test']) ? $_POST['test'] : false;

			$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);
			mysqli_set_charset($conn, "UTF8");

			if (!$conn) 
			{
				die("Connection failed: " . mysqli_connect_error());
			}


			
			if(isset($_POST['submit']))
			{
				?>
				<script>document.getElementById("image").height="0px";</script>
				<?php
				$sql = "SELECT * FROM nexon WHERE isSell = '0' ORDER BY cardPrice ASC";
				$result = mysqli_query($conn, $sql);
				echo "<center>"."--剩餘點卡--"."</center>";
				echo "<HR>";
				echo '<table border="1" style="width:50%" align="center">';
				echo "<tr>"."<td align='center'>"."編號"."</td>"."<td align='center'>"."點數"."</td>"."</tr>";
				$count = 1;
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>"."<td>". $count."</td>"."<td>". $row['cardPrice']."</td>"."</tr>";
					$count = $count+1;
				}
			} 

			
			if($sel=="Nexon"){
				?>
				<script>document.getElementById("image").height="0px";</script>
				<HR>
				<H3><p>--Nexon 點數--</p></H3>
				<p>有*者為必填項目</p><br>
        
				<form action="" method="POST">
				<table  align="center">
				<tr>
				<td>*產品單價:</td>
					<td>    
							<input type="radio" name="price" value="155">155元  (5000  點)
							<input type="radio" name="price" value="300">300元 (10000 點)
					</td><span id="ShowErrorPrice"></span>
				</tr>
				<tr>
				<td>*產品數量</td> <td> <input type=text name='amount'></td>
				</tr>
				<tr>
				<td>*付款方式:</td> <td>    <input type="radio" name="payment" value="familyMarket">超商繳費  <input type="radio" name="payment" value="ATM">ATM轉帳</td>

				</tr>
				<tr>
				<td>*姓名:</td> <td> <input type=text name='Name'></td>
				</tr>
				<tr>
				<td>電話:</td> <td> <input type=text name='phoneNum'></td>
				</tr>
				<tr>
				<td>*E-mail:</td> <td> <input type=text name='email'></td>
				</tr>
				</table>
				<input type="submit" name="mysubmit_Nexon" value="Click">
				</form>
				<?php
			}
			
			if(isset($_POST['mysubmit_Nexon']) && !empty($_POST["price"]) && !empty($_POST["payment"])  && !empty($_POST["amount"]) && !empty($_POST["Name"]) )
			{
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$payment = $_POST['payment'];
				$Name = $_POST['Name'];
				$phoneNum = $_POST['phoneNum'];
				$email = $_POST['email'];

				

				?>
				<script>document.getElementById("image").height="0px";</script>
				<?php

				//SELECT MAX(ID) FROM pay2go
				$sql = "SELECT ID FROM pay2go ORDER BY ID DESC";
				$result = mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				
				$ID=($row['ID']+1);
				
				if($payment == 'familyMarket')
				{
					
					//開始去建立代馬
					$url = "https://api.pay2go.com/MPG/mpg_gateway";
					$MerchantID = "684131";  //商店編號
					$key = "DeT07t9z5PxBmVN1YBJRtqzhaaZJo2pS"; //商店專屬加密用 Key 值
			 		$iv = "Dp3d8B42dSAV3dS8"; //商店專屬加密用 IV 值
			 		$RespondType= "JSON";
			 		$Amt = ($price*$amount+30);
			 		$MerchantOrderNo = $ID;
			 		$CheckValue="IV=$iv&Amt=$Amt&MerchantID=$MerchantID&$MerchantOrderNo=$MerchantOrderNo&Key=$key";
			 		$CheckValue = strtoupper(hash("sha256", $CheckValue));

			 		

		 			$post_data_array = array
		 			( //post_data 欄位資料
						"RespondType" => $RespondType,
						"Amt" => ($price*$amount+30),
						"MerchantID" =>$MerchantID,
						"MerchantOrderNo" =>$ID,
						"TimeStamp" => time(),
						"CheckValue" =>$CheckValue,
						"Version" => "1.2",
						"ItemDesc" => "點卡",
						"EmailModify" => "0",
						"Email" => "BodomMoon@gmail.com",
						"LoginType" => "0",
						"PaymentType" => "CVS",
					);

					$post_data_str = http_build_query($post_data_array);
		 			$result = curl_work($url, $post_data_str); //背景送出訂單建立完成
					
				}
				elseif ($payment == 'ATM') 
				{
					$sellCode='1969 0432 732';
				}
				$total = $price * $amount;
				echo "訂單編號: ".$ID."<br>";
				echo "應付金額: " . $total . "<br>";
				if($payment == 'familyMarket')
				{
					//取得代碼
					$url = "https://api.pay2go.com/API/QueryTradeInfo";
					$MerchantID = "684131";  //商店編號
					$key = "DeT07t9z5PxBmVN1YBJRtqzhaaZJo2pS"; //商店專屬加密用 Key 值
		 			$iv = "Dp3d8B42dSAV3dS8"; //商店專屬加密用 IV 值
		 			$RespondType= "JSON";
		 			//$Amt = 直接用;
		 			//$MerchantOrderNo 直接用
	 				$CheckValue = strtoupper(hash("sha256", $CheckValue));
					

					$post_data_array = array
					( //post_data 欄位資料
						"RespondType" => $RespondType,
						"Amt" => $Amt,
						"MerchantID" =>$MerchantID,
						"MerchantOrderNo" =>$MerchantOrderNo,
						"TimeStamp" => time(),
						"CheckValue" =>$CheckValue,
						"Version" => "1.1",
					);


					$post_data_str = http_build_query($post_data_array);
	 				$result = curl_work($url, $post_data_str); //背景送出
		 			$value = json_decode($result[web_info],TRUE); //以 json_decode 把內容解為變數陣列
					//echo "回傳狀態:".$value[Status]."<br>";
					//echo "支付狀態:".$value[TradeStatus]."<br>"; //支付狀態
		 			//$isPay = $row["isPay"];
		 			$sellCode = $value[PayInfo];		
				
					//查詢結束
					echo "超商代碼: ".$sellCode."<br>";
				}
				else
				{
					echo "<br>郵局匯款帳戶 <br>  銀行代碼700 帳號1969 0432 732";
				}


				$sql = "INSERT INTO pay2go(price, amount, payment, Name, phoneNum, email, sellCode, total, ID) VALUES ('$price', '$amount', '$payment','$Name', '$phoneNum', '$email', '$sellCode', '$total', '$ID');";
				$result = mysqli_query($conn, $sql);

				if ($result) 
				{
					?>
					<br><br><font size="5">請牢記您的</font><b><font size="10">超商繳費代碼</font></b>,<font size="5">以便繳費及提取卡號時供系統確認</font>
					<?php
				} 
				
			}
		

			elseif(isset($_POST['mysubmit_Nexon']) && ( empty($_POST["price"]) || empty($_POST["payment"]) || empty($_POST["amount"]) || empty($_POST["Name"]) || empty($_POST["email"]) ) )
			{

				?>
				<script>document.getElementById("image").height="0px";</script>
				<?php
				echo "請重新下單,並輸入必填項目";
			}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if($sel=="BD"){
				?>
				<script>document.getElementById("image").height="0px";</script>
				<HR>
				<H3><p>--黑色沙漠 點數--</p></H3>
				<p>有*者為必填項目</p><br>
        
				<form action="" method="POST">
				<table  align="center">
				<tr>
				<td>*產品單價:</td>
					<td>    
							<input type="radio" name="price" value="160">160元 (5000  點)
							<input type="radio" name="price" value="315">315元 (10000 點)
					</td>
				</tr>
				<tr>
				<td>*產品數量</td> <td> <input type=text name='amount'></td>
				</tr>
				<tr>
				<td>*付款方式:</td> <td>    <input type="radio" name="payment" value="familyMarket">超商繳費  <input type="radio" name="payment" value="ATM">ATM轉帳</td>
				</tr>
				<tr>
				<td>*姓名:</td> <td> <input type=text name='Name'></td>
				</tr>
				<tr>
				<td>電話:</td> <td> <input type=text name='phoneNum'></td>
				</tr>
				<tr>
				<td>*遊戲帳號:</td> <td> <input type=text name='Account'></td>
				</tr>
				<tr>
				<td>*遊戲密碼:</td> <td> <input type=text name='Password'></td>
				</tr>
				</table>
				<input type="submit" name="mysubmit_BD" value="Click">
				</form>
				<?php
			}
			
			
			if(isset($_POST['mysubmit_BD'])  && !empty($_POST["price"]) && !empty($_POST["payment"])  && !empty($_POST["amount"]) && !empty($_POST["Name"])  && !empty($_POST["Account"]) && !empty($_POST["Password"])    ){
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$payment = $_POST['payment'];
				$Name = $_POST['Name'];
				$phoneNum = $_POST['phoneNum'];
				$Account = $_POST['Account'];
				$Password = $_POST['Password'];

				?>
				<script>document.getElementById("image").height="0px";</script>
				<?php
				
				$sql = "SELECT ID FROM pay2gobd ORDER BY ID DESC";
				$result = mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				
				$ID=($row['ID']);
				$ID=($row['ID'])+1;

				if($payment == 'familyMarket')
				{
					$sql = "SELECT sellCode FROM paycode where amount = '1' and price = '$price' ";
					$result = mysqli_query($conn, $sql);
					$row=mysqli_fetch_assoc($result);
					$sellCode = $row["sellCode"];
				}
				elseif ($payment == 'ATM') {
					$sellCode="1969 0432 732";
				}
				$total = $price * $amount;
				echo "訂單編號: ".$ID."<br>";
				echo "應付金額: " . $total . "<br>";
				if($payment == 'familyMarket')
				{
					echo "超商代碼: ".$sellCode."<br>";
				}
				else
				{
					echo "<br>郵局匯款帳戶 <br>  銀行代碼700 帳號1969 0432 732";
				}

				$sql = "INSERT INTO pay2gobd(price, amount, payment, Name, phoneNum, Account, Password, sellCode, total, ID) VALUES ('$price', '$amount', '$payment','$Name', '$phoneNum', '$Account', '$Password', '$sellCode', '$total', '$ID');";
				$result = mysqli_query($conn, $sql);

				if ($result) {
						?>
					<br><br><font size="5">請牢記您的</font><b><font size="10">訂單編號</font></b>,<font size="5">以便提取卡號時供系統確認</font>
					<?php
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}

			elseif( isset($_POST['mysubmit_BD']) && ( empty($_POST["price"]) || empty($_POST["payment"]) || empty($_POST["amount"]) || empty($_POST["Name"]) || empty($_POST["Account"]) || empty($_POST["Password"]) ) )
			{

				?>
				<script>document.getElementById("image").height="0px";</script>
				<?php
				echo "請重新下單,並輸入必填項目";
			}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			if($sel=="SDNE"){
				?>
				<script>document.getElementById("image").height="0px";</script>
				<HR>
				<H3><p>--SDNE 點數--</p></H3>
				<p>有*者為必填項目</p><br>
        		
				<form action="" method="POST">
				<table  align="center">
				<tr>
				<td>*產品單價:</td>
					<td>    
							<input type="radio" name="price" value="160">160元 (5000  點)
							<input type="radio" name="price" value="315">315元 (10000 點)
					</td>
				</tr>
				<tr>
				<td>*產品數量</td> <td> <input type=text name='amount'></td>
				</tr>
				<tr>
				<td>*付款方式:</td> <td>    <input type="radio" name="payment" value="familyMarket">超商繳費  <input type="radio" name="payment" value="ATM">ATM轉帳</td>
				</tr>
				<tr>
				<td>*姓名:</td> <td> <input type=text name='Name'></td>
				</tr>
				<tr>
				<td>電話:</td> <td> <input type=text name='phoneNum'></td>
				</tr>
				<tr>
				<td>*角色名稱:</td> <td> <input type=text name='gameID'></td>
				</tr>
				</table>
				<input type="submit" name="mysubmit_SDNE" value="Click">
				</form>
				<?php
			}
			
			
			if(isset($_POST['mysubmit_SDNE']) && !empty($_POST["price"]) && !empty($_POST["payment"])  && !empty($_POST["amount"]) && !empty($_POST["Name"])  && !empty($_POST["gameID"]) ){
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$payment = $_POST['payment'];
				$Name = $_POST['Name'];
				$phoneNum = $_POST['phoneNum'];
				$gameID = $_POST['gameID'];
				
				?>
				<script>document.getElementById("image").height="0px";</script>
				<?php

				$sql = "SELECT ID FROM pay2gosdne ORDER BY ID DESC";
				$result = mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result);
				
				$ID=($row['ID']+1);

				
				if($payment == 'familyMarket')
				{
					if($amount == 1)
					{
						$sql = "SELECT sellCode FROM paycode where amount = '1' and price = '$price' ";
						$result = mysqli_query($conn, $sql);
						$row=mysqli_fetch_assoc($result);
						$sellCode = $row["sellCode"];
					}
					else
					{
						$sql = "SELECT sellCode FROM paycode where amount = '2' and price = '$price' ";
						$result = mysqli_query($conn, $sql);
						$row=mysqli_fetch_assoc($result);
						$sellCode = $row["sellCode"];
					}
				}
				elseif ($payment == 'ATM') 
				{
					$sellCode='1969 0432 732';
				}
				$total = $price * $amount;
				echo "訂單編號: ".$ID."<br>";
				echo "應付金額: " . $total . "<br>";
				if($payment == 'familyMarket')
				{
					echo "超商代碼: ".$sellCode."<br>";
				}
				else
				{
					echo "<br>郵局匯款帳戶 <br>  銀行代碼700 帳號1969 0432 732";
				}

				$sql = "INSERT INTO pay2gosdne(price, amount, payment, Name, phoneNum, gameID, sellCode, total, ID) VALUES ('$price', '$amount', '$payment','$Name', '$phoneNum', '$gameID', '$sellCode', '$total', '$ID');";
				$result = mysqli_query($conn, $sql);

				if ($result) {
					?>
					<br><br><font size="5">請牢記您的</font><b><font size="10">訂單編號</font></b>,<font size="5">以便提取卡號時供系統確認</font>
					<?php
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}

			elseif(isset($_POST['mysubmit_SDNE']) && ( empty($_POST["price"]) || empty($_POST["payment"]) || empty($_POST["amount"]) || empty($_POST["Name"]) || empty($_POST["gameID"]) ) )
			{

				?>
				<script>document.getElementById("image").height="0px";</script>
				<?php
				echo "請重新下單,並輸入必填項目";
			}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			if(isset($_POST['login'])){
				$Account = $_POST['SellAccount'];
				$Password = $_POST['SellPassword'];
				$sql = "SELECT * FROM seller WHERE Account = '$Account' AND Password = '$Password'";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0){
					if($result){
						session_start();
						$_SESSION['var1']=$Account;
						$_SESSION['var2']=$Password;
						echo '<meta http-equiv="refresh" content="0; url=sell.php">';
					}
				}
				else{
					?>
					<script>
					window.setInterval('ShowErrorMessage()',0);
					</script>
					<id="Error" onclick="ShowErrorMessage()">
					<?php
				}
				
			}
			if(isset($_POST['home'])){
				echo '<meta http-equiv="refresh" content="0; url=index.php">';
			}
			
			mysqli_close($conn);
		?>        
    </div>
    
</body>
</html>