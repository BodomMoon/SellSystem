<!DOCTYPE html>
<html>
<title>查詢</title>
<meta charset="utf-8">
<body align="center" bgcolor = "pink">
	<script type="text/javascript">
	function ShowErrorMessage(){
	    document.getElementById("ShowErrorMessage").innerHTML='帳號密碼錯誤';
	}
	function Error(){
		document.getElementById("Error").click();
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

        <p style="font-weight: bold;">你買什麼遊戲的點數?</p>
		
		
		
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

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        	if($sel=="Nexon")
        	{
        		?>
        		<form action="" method="POST">
		        <p style="font-weight: bold;">--Nexon--</p><br>
		        超商繳費代碼: 
				<input type="text" name="sellCode" value="請輸入超商繳費代碼" style="color:#999" onfocus="if (value =='請輸入超商繳費代碼'){value ='';this.style.color='#000';}" onblur="if (value ==''){value='請輸入超商繳費代碼';this.style.color='#999';}">
				<br><br>
				E-mail: 
				<input type="text" name="email" value="請輸入E-mail" style="color:#999" onfocus="if (value =='請輸入E-mail'){value ='';this.style.color='#000';}" onblur="if (value ==''){value='請輸入E-mail';this.style.color='#999';}">
				<br><br>

				<input type="submit" value="查詢" name = "Search_Nexon"> <br><br>
				</form>
				<br><br>
        		<?php
        	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        	if($sel=="BD"){
        		?>
        		<form action="" method="POST">
		        <p style="font-weight: bold;">--黑色沙漠--</p><br>
		        訂單編號: 
				<input type="text" name="ID" value="請輸入訂單編號" style="color:#999" onfocus="if (value =='請輸入訂單編號'){value ='';this.style.color='#000';}" onblur="if (value ==''){value='請輸入訂單編號';this.style.color='#999';}">
				<br><br>
				遊戲帳號: 
				<input type="text" name="Account" value="請輸入遊戲帳號" style="color:#999" onfocus="if (value =='請輸入遊戲帳號'){value ='';this.style.color='#000';}" onblur="if (value ==''){value='請輸入遊戲帳號';this.style.color='#999';}">
				<br><br>

				<input type="submit" value="查詢" name = "Search_BD"> <br><br>
				</form>
				<br><br>
        		<?php
        	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        	if($sel=="SDNE"){
        		?>
        		<form action="" method="POST">
		        <p style="font-weight: bold;">--SDNE--</p><br>
		        訂單編號: 
				<input type="text" name="ID" value="請輸入訂單編號" style="color:#999" onfocus="if (value =='請輸入訂單編號'){value ='';this.style.color='#000';}" onblur="if (value ==''){value='請輸入訂單編號';this.style.color='#999';}">
				<br><br>
				角色名稱: 
				<input type="text" name="gameID" value="請輸入角色名稱" style="color:#999" onfocus="if (value =='請輸入角色名稱'){value ='';this.style.color='#000';}" onblur="if (value ==''){value='請輸入角色名稱';this.style.color='#999';}">
				<br><br>
				<input type="submit" value="查詢" name = "Search_SDNE"> <br><br>
				</form>
				<br><br>
        		<?php
        	}

        ?>
		
        <br><br>
	
		<?php
			//require_once('../include/configure.php');
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpwd = "";
			$dbname = "pay2go";
			
           // $conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);

			//pdo的部分/*
			
			$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);
			mysqli_set_charset($conn, "UTF8");

			if (!$conn) 
			{
				die("Connection failed: " . mysqli_connect_error());
			}


			$sel_SDNE = isset($_POST['Search_SDNE']);
			$sel_BD = isset($_POST['Search_BD']);
			$sel_Search_Nexon = isset($_POST['Search_Nexon']);
			$sel_Sell = isset($_POST['login']);
			$sel_home = isset($_POST['home']);
			$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);
			mysqli_set_charset($conn, "UTF8");
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
			if(isset($_POST['Search_SDNE'])){
				$ID = $_POST['ID'];
				$gameID = $_POST['gameID'];
				$sql = "SELECT * FROM pay2gosdne WHERE gameID = '$gameID' AND ID = '$ID'";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					if($row = mysqli_fetch_assoc($result)) {
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
						
						if($itemOut == '0'){
							print"<br>";
							print"<form action='' method='POST'>";
							print'<table align="center">';
							echo'HELLO ,"'.$Name.'"';
							print"<br><br>";
							echo'This is your information';
							print"<tr><td>訂單編號:</td>	<td><input type='text' name='ID' value = '$ID' readonly></td></tr>";
							print"<tr><td>產品單價:</td>	<td><input type='text' name='price' value = '$price' readonly></td></tr>";
							print"<tr><td>產品數量:</td>  <td><input type='text' name='amount' value = '$amount' ></td></tr>";
							?>
							<tr>
							<td>付款方式:</td>
							<?php
							if($payment == 'familyMarket'){
								?>
								<form action="" method="POST" onchange = submit()>
								<td>
									<select size="1" name="payment">
							            <option value="familyMarket" name = "familyMarket">超商代碼</option>
							            <option value="ATM" name = "ATM">ATM轉帳</option>
							        </select>
								</td>
								</form>
								<?php
							}
							
							elseif($payment == 'ATM'){
								?>
								<form action="" method="POST" onchange = submit()>
								<td>
									<select size="1" name="payment">
							            <option value="ATM" name = "ATM">ATM轉帳</option>
							            <option value="familyMarket" name = "familyMarket">超商代碼</option>
							        </select>
								</td>
								</form>
							<?php
							}
							print"</tr>";
					        
							print"<tr><td>電話:</td>  <td><input type='text' name='phoneNum' value = '$phoneNum' ></td></tr>";
							print"<tr><td>角色名稱:</td>  <td><input type='text' name='gameID' value = '$gameID' ></td></tr>";
							if($payment == 'ATM'){
								print"<tr><td>銀行/郵局帳號:</td>  <td><input type='text' name='sellCode' value = '$sellCode' readonly></td></tr>";
							}
							elseif($payment == 'familyMarket'){
								print"<tr><td>超商代碼:</td>  <td><input type='text' name='sellCode' value = '$sellCode' readonly></td></tr>";
							}
							print"<tr><td>應付金額:</td>  <td><input type='text' name='total' value = '$total' readonly></td></tr>";
							if($isPay == '0'){
								print"<tr><td>付款狀態:</td> <td>尚未付款</td></tr>";
							}
							elseif($isPay == '1'){
								print"<tr><td>付款狀態:</td> <td>已付款</td></tr>";
							}
							print"</table>";
							print"<input type='submit' name='delete_SDNE' value='刪除'>";
							print"<input type='submit' name='save_SDNE' value='儲存'>";
							print"</form>";
						}
						elseif($itemOut == '1')
						{
							echo "您的 ";
							if($price== '160')
							{
								$temp = 5000 * $amount;
								echo $temp;
							}
							else
							{
								$temp = 10000 * $amount;
								echo $temp;
							}
							echo "點 已經儲值完成";
						}
					}
				}
				else {
					echo "無此訂單";
				}
			}
			if(isset($_POST['save_SDNE'])){
				$ID = $_POST['ID'];
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$payment = $_POST['payment'];
				$phoneNum = $_POST['phoneNum'];
				$gameID = $_POST['gameID'];
				$sellCode = $_POST['sellCode'];
				
				$total = $price * $amount;



				$sql = "UPDATE pay2gosdne SET ID = '$ID', price = '$price', amount = '$amount', payment = '$payment', phoneNum = '$phoneNum', gameID = '$gameID',sellCode = '$sellCode', total = '$total' WHERE ID = '$ID'";
				$result = mysqli_query($conn, $sql);
				
				if ($result) {										
					echo "儲存成功!!<br>";
					echo "訂單編號: ".$ID."<br>";
					echo "應付金額: " . $total . "<br>";
					if($payment == 'familyMarket'){
						echo "超商代碼: ".$sellCode."<br>";
					}
					else{
						echo "<br>郵局匯款帳戶 <br>  銀行代碼700 帳號1969 0432 732";
					}
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}

			if(isset($_POST['delete_SDNE'])){
				$ID = $_POST['ID'];
				$gameID = $_POST['gameID'];
				?>
				確定刪除訂單?
				<form action="" method="POST">
				<?php
				print"<tr><td>訂單編號:</td>	<td><input type='text' name='ID' value = '$ID' readonly></td></tr><br><br>";
				print"<tr><td>角色名稱:</td>  <td><input type='text' name='gameID' value = '$gameID' readonly></td></tr><br><br>";
				print"<input type='submit' name='delete_SDNE_yes' value='確定'>";
				?>

				<a href="search.php">
				<?php
				print"<input type='submit' name='delete_SDNE_no' value='取消'>";
				?>
				</a>
				</form>
				<?php
			}

			if(isset($_POST['delete_SDNE_yes'])){
				$delID = $_POST['ID'];
				$delgameID = $_POST['gameID'];
				$sql = "SELECT * FROM pay2gosdne WHERE ID = '$delID' AND gameID = '$delgameID'";
				$result = mysqli_query($conn, $sql);
				
				$sqld = "DELETE FROM pay2gosdne WHERE ID = '$delID' AND gameID = '$delgameID'";
				$result = mysqli_query($conn, $sqld);
				if ($result) {										
					echo "刪除成功!!";
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				
			if(isset($_POST['Search_BD'])){
				$ID = $_POST['ID'];
				$Account = $_POST['Account'];
				$sql = "SELECT * FROM pay2gobd WHERE Account = '$Account' AND ID = '$ID'";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					if($row = mysqli_fetch_assoc($result)) {
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
					
						if($itemOut == '0')
						{
							print"<br>";
							print"<form action='' method='POST'>";
							print'<table align="center">';
							echo'HELLO ,"'.$Name.'"';
							print"<br><br>";
							echo'This is your information';
							print"<tr><td>訂單編號:</td>	<td><input type='text' name='ID' value = '$ID' readonly></td></tr>";
							print"<tr><td>產品單價:</td>	<td><input type='text' name='price' value = '$price' readonly></td></tr>";
							print"<tr><td>產品數量:</td>  <td><input type='text' name='amount' value = '$amount' ></td></tr>";
							?>
							<tr>
							<td>付款方式:</td>
							<?php
							if($payment == 'familyMarket'){
								?>
								<form action="" method="POST" onchange = submit()>
								<td>
									<select size="1" name="payment">
							            <option value="familyMarket" name = "familyMarket">超商代碼</option>
							            <option value="ATM" name = "ATM">ATM轉帳</option>
							        </select>
								</td>
								</form>
								<?php
							}
							
							elseif($payment == 'ATM'){
								?>
								<form action="" method="POST" onchange = submit()>
								<td>
									<select size="1" name="payment">
							            <option value="ATM" name = "ATM">ATM轉帳</option>
							            <option value="familyMarket" name = "familyMarket">超商代碼</option>
							        </select>
								</td>
								</form>
							<?php
							}
							print"</tr>";
					        
							print"<tr><td>電話:</td>  <td><input type='text' name='phoneNum' value = '$phoneNum' ></td></tr>";
							print"<tr><td>帳號:</td>  <td><input type='text' name='Account' value = '$Account' ></td></tr>";
							print"<tr><td>密碼:</td>  <td><input type='text' name='Password' value = '$Password' ></td></tr>";
							if($payment == 'ATM'){
								print"<tr><td>銀行/郵局帳號:</td>  <td><input type='text' name='sellCode' value = '$sellCode' readonly></td></tr>";
							}
							elseif($payment == 'familyMarket'){
								print"<tr><td>超商代碼:</td>  <td><input type='text' name='sellCode' value = '$sellCode' readonly></td></tr>";
							}
							print"<tr><td>應付金額:</td>  <td><input type='text' name='total' value = '$total' readonly></td></tr>";
							if($isPay == '0'){
								print"<tr><td>付款狀態:</td> <td>尚未付款</td></tr>";
							}
							elseif($isPay == '1'){
								print"<tr><td>付款狀態:</td> <td>已付款</td></tr>";
							}
							print"</table>";
							print"<input type='submit' name='delete_pay2gosdne' value='刪除'>";
							print"<input type='submit' name='save_BD' value='儲存'>";
							print"</form>";
						}
						elseif($itemOut == '1')
						{
							echo "您的 ";
							if($price== '160')
							{
								$temp = 5000 * $amount;
								echo $temp;
							}
							else
							{
								$temp = 10000 * $amount;
								echo $temp;
							}
							echo "點 已經儲值完成";
						}
						
					}
				}
				else {
					echo "無此訂單";
				}
			}
			if(isset($_POST['save_BD'])){
				$ID = $_POST['ID'];
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$payment = $_POST['payment'];
				$phoneNum = $_POST['phoneNum'];
				$Account = $_POST['Account'];
				$Password = $_POST['Password'];
				$sellCode = $_POST['sellCode'];
				
				$total = $price * $amount;

				$sql = "UPDATE pay2gobd  SET ID = '$ID', price = '$price', amount = '$amount', payment = '$payment', phoneNum = '$phoneNum', Account = '$Account', Password = '$Password', sellCode = '$sellCode', total = '$total' WHERE ID = '$ID'";


				$result = mysqli_query($conn, $sql);
				
				if ($result) {										
					echo "儲存成功!!<br>";
					echo "訂單編號: ".$ID."<br>";
					echo "應付金額: " . $total . "<br>";
					if($payment == 'familyMarket'){
						echo "超商代碼: ".$sellCode."<br>";
					}
					else{
						echo "<br>郵局匯款帳戶 <br>  銀行代碼700 帳號1969 0432 732";
					}
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}

			if(isset($_POST['delete_BD'])){
				$ID = $_POST['ID'];
				$Account = $_POST['Account'];
				?>
				確定刪除訂單?
				<form action="" method="POST">
				<?php
				print"<tr><td>訂單編號:</td>	<td><input type='text' name='ID' value = '$ID' readonly></td></tr><br><br>";
				print"<tr><td>帳號:</td>  <td><input type='text' name='Account' value = '$Account' readonly></td></tr><br><br>";
				print"<input type='submit' name='delete_BD_yes' value='確定'>";
				?>

				<a href="search.php">
				<?php
				print"<input type='submit' name='delete_BD_no' value='取消'>";
				?>
				</a>
				</form>
				<?php
			}

			if(isset($_POST['delete_BD_yes'])){
				$delID = $_POST['ID'];
				$delAccount = $_POST['Account'];
				$sql = "SELECT * FROM pay2gobd WHERE ID = '$delID' AND Account = '$delAccount'";
				$result = mysqli_query($conn, $sql);
				
				$sqld = "DELETE FROM pay2gobd WHERE ID = '$delID' AND Account = '$delAccount'";
				$result = mysqli_query($conn, $sqld);
				if ($result) {										
					echo "刪除成功!!";
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			if(isset($_POST['Search_Nexon']))
			{
				$sellCode = $_POST['sellCode'];
				$email = $_POST['email'];

				$sql = "SELECT * FROM pay2go WHERE email = '$email' AND sellCode = '$sellCode'";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0)
				{
					if($row = mysqli_fetch_assoc($result))
				    {
						
						//查詢區
						$url = "https://api.pay2go.com/API/QueryTradeInfo";
						$MerchantID = "684131";  //商店編號
						$key = "DeT07t9z5PxBmVN1YBJRtqzhaaZJo2pS"; //商店專屬加密用 Key 值
		 				$iv = "Dp3d8B42dSAV3dS8"; //商店專屬加密用 IV 值
		 				$RespondType= "JSON";
		 				$Amt = $row["total"];
		 				$MerchantOrderNo = $row["ID"];

		 				$CheckValue = strtoupper(hash("sha256", $CheckValue));

						function curl_work($url = "", $parameter = "") {
		 				$curl_options = array(
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
						$return_info = array(
						"url" => $url,
						"sent_parameter" => $parameter,
						"http_status" => $retcode,
						"curl_error_no" => $curl_error,
						"web_info" => $result
							);
		 						return $return_info;
		 				}

		 				
						$post_data_array = array( //post_data 欄位資料
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
		 				$isPay = $value[TradeStatus];				
					}
					//查詢結束
					if($isPay == '0')
					{
						$price = $row["price"];
						$amount = $row["amount"];
						$payment = $row["payment"];
						$Name = $row["Name"];
						$phoneNum = $row["phoneNum"];
						$email = $row["email"];
						$sellCode = $row["sellCode"];
						$total = $row["total"];
						$ID = $row["ID"];
						
						print"<br>";
						print"<form action='' method='POST'>";
						print'<table align="center">';
						echo'HELLO ,"'.$Name.'"';
						print"<br><br>";
						echo'This is your information';
						/*if($isPay == '1'){
						print"<tr><td>訂單編號:</td>	<td><input type='text' name='ID' value = '$ID' readonly></td></tr>";
						print"<tr><td>產品單價:</td>	<td><input type='text' name='price' value = '$price' readonly></td></tr>";
							print"<tr><td>產品數量:</td>  <td><input type='text' name='amount' value = '$amount' readonly></td></tr>";
						}
						else{
							print"<tr><td>訂單編號:</td>	<td><input type='text' name='ID' value = '$ID' readonly></td></tr>";
							print"<tr><td>產品單價:</td>	<td><input type='text' name='price' value = '$price' readonly></td></tr>";
							print"<tr><td>產品數量:</td>  <td><input type='text' name='amount' value = '$amount' ></td></tr>";
						}*/
						print"<tr><td>訂單編號:</td>	<td><input type='text' name='ID' value = '$ID' readonly></td></tr>";
						print"<tr><td>產品單價:</td>	<td><input type='text' name='price' value = '$price' readonly></td></tr>";
						print"<tr><td>產品數量:</td>  <td><input type='text' name='amount' value = '$amount' ></td></tr>";
						?>
						<tr>
						<td>付款方式:</td>
						<?php
						if($payment == 'familyMarket')
						{
							?>
							<form action="" method="POST" onchange = submit()>
							<td>
							<select size="1" name="payment">
						    <option value="familyMarket" name = "familyMarket">超商代碼</option>
						    <option value="ATM" name = "ATM">ATM轉帳</option>
						    </select>
							</td>
							</form>
							<?php
						}
							
						elseif($payment == 'ATM')
						{
							?>
							<form action="" method="POST" onchange = submit()>
							<td>
							<select size="1" name="payment">
					           <option value="ATM" name = "ATM">ATM轉帳</option>
					           <option value="familyMarket" name = "familyMarket">超商代碼</option>
					        </select>
							</td>
							</form>
							<?php
						}
						print"</tr>";
					    print"<tr><td>姓名:</td>  <td><input type='text' name='Name' value = '$Name' ></td></tr>";
						print"<tr><td>電話:</td>  <td><input type='text' name='phoneNum' value = '$phoneNum' ></td></tr>";
						print"<tr><td>E-mail:</td>  <td><input type='text' name='email' value = '$email' ></td></tr>";
						
						if($payment == 'ATM')
						{
						print"<tr><td>銀行/郵局帳號:</td>  <td><input type='text' name='sellCode' value = '$sellCode' readonly></td></tr>";
						}
						elseif($payment == 'familyMarket')
						{
							print"<tr><td>超商代碼:</td>  <td><input type='text' name='sellCode' value = '$sellCode' readonly></td></tr>";
						}
						
						print"<tr><td>應付金額:</td>  <td><input type='text' name='total' value = '$total' readonly></td></tr>";
						
						if($isPay == '0')
						{
							print"<tr><td>付款狀態:</td> <td>尚未付款</td></tr>";
							print"</table>";
							print"<input type='submit' name='delete_Nexon' value='刪除'>";
							print"<input type='submit' name='save_Nexon' value='儲存'>";
							print"</form>";
						}
						elseif($isPay == '1')
						{
							print"<tr><td>付款狀態:</td> <td>已付款</td></tr>";
							//卡號顯示區
						}
					}
					else
					{ 
					////顯示卡號//////////////////////////////////////////////////////////
						$sql = "SELECT * FROM pay2go WHERE email = '$email' AND ID = '$ID'";
						$result = mysqli_query($conn, $sql);
						$row = mysqli_fetch_assoc($result);
						echo '<table border="1" style="width:80%" align="center">';
	                      	echo "<tr>"."<td align='center'>"."點卡編號"."</td>".
	                      "<td align='center'>"."點數面額"."</td>".
	                      "<td align='center'>"."點數序號"."</td>".
	                      "<td align='center'>"."購買人姓名"."</td>".
	                      "</tr>";
						if($result)
						{
							echo "購買人資料載入完成 ";
							$Name = $row["Name"];
                       		$isPay = $row["isPay"];
                       		$price = $row["price"];
                       		$amount = $row["amount"];
                       		$itemOut = $row["itemOut"];
                       		$ID = $row["ID"];
						}
						if($itemOut == '0')
						{
							$test = getDate();
                               $test2 = $test["year"].'-'.$test["mon"].'-'.$test["mday"] ;
							$sql = "UPDATE pay2go set sellDate = 'test2' where ID = '$ID'";
                          		$result = mysqli_query($conn, $sql);
								$sql = "UPDATE pay2go SET itemOut = '1' WHERE ID = '$ID' AND email = '$email'";
                            $result = mysqli_query($conn, $sql);
							for($counter=1 ; $counter <= $amount; $counter++)
							{
								$sql = "SELECT * FROM nexon WHERE isSell = '0' AND cardPrice = '$price' ";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($result);
									
								$cardPrice = $row["cardPrice"];
								$cardNum = $row["cardNum"];
								echo "<tr>"."<td>". $counter."</td>".
                                   "<td>". $cardPrice."</td>".
                                   "<td>". $cardNum."</td>".
                                   "<td>". $Name."</td></tr>";
                                $sql = "UPDATE nexon SET isSell = '1', buyMan = '$Name', BuyID = '$ID' WHERE cardPrice = '$cardPrice' AND cardNum = '$cardNum'";
                                $result = mysqli_query($conn, $sql);
                                if($result)
                                {
                                	echo "修改完成";
                                }
							}
						}
						else
						{
							$sql = "SELECT * FROM nexon WHERE buyMan = '$Name' AND BuyID = '$ID'";
							$result = mysqli_query($conn, $sql);
							for($counter=1 ; $counter <= $amount; $counter++)
							{
								
								$row = mysqli_fetch_assoc($result);
									
								$cardPrice = $row["cardPrice"];
								$cardNum = $row["cardNum"];
								echo "<tr>"."<td>". $counter."</td>".
                                   "<td>". $cardPrice."</td>".
                                   "<td>". $cardNum."</td>".
                                   "<td>". $Name."</td></tr>";                                
							}
						}
					}	
				}
				else
				{	
					echo "無此訂單";
				}
			}
			if(isset($_POST['save_Nexon'])){
				$ID = $_POST['ID'];
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$payment = $_POST['payment'];
				$Name = $_POST['Name'];
				$phoneNum = $_POST['phoneNum'];
				$email = $_POST['email'];
				$sellCode = $_POST['sellCode'];
				
				$total = $price * $amount;

				$sql = "SELECT amount FROM pay2go WHERE email = '$email' AND ID = '$ID'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$OldAmount = $row["amount"];

				if($amount != $OldAmount)
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
					echo "購買數量有所變更,請牢記您新的超商代碼<br><br>";
				}


				$sql = "UPDATE pay2go SET ID = '$ID', price = '$price', amount = '$amount', payment = '$payment', Name = '$Name', phoneNum = '$phoneNum', email = '$email',sellCode = '$sellCode', total = '$total' WHERE ID = '$ID'";
				$result = mysqli_query($conn, $sql);
				
				if ($result) {										
					echo "儲存成功!!<br>";
					echo "訂單編號: ".$ID."<br>";
					echo "應付金額: " . $total . "<br>";
					if($payment == 'familyMarket')
					{
							echo "超商代碼為: ".$sellCode."<br>";
					}
					else{
						echo "<br>郵局匯款帳戶 <br>  銀行代碼700 帳號1969 0432 732";
					}
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}

			if(isset($_POST['delete_Nexon'])){
				$ID = $_POST['ID'];
				$email = $_POST['email'];
				?>
				確定刪除訂單?
				<form action="" method="POST">
				<?php
				print"<tr><td>訂單編號:</td>	<td><input type='text' name='ID' value = '$ID' readonly></td></tr><br><br>";
				print"<tr><td>E-mail:</td>  <td><input type='text' name='email' value = '$email' readonly></td></tr><br><br>";
				print"<input type='submit' name='delete_Nexon_yes' value='確定'>";
				?>

				<a href="search.php">
				<?php
				print"<input type='submit' name='delete_Nexon_no' value='取消'>";
				?>
				</a>
				</form>
				<?php
			}

			if(isset($_POST['delete_Nexon_yes'])){
				$delID = $_POST['ID'];
				$delemail = $_POST['email'];
				$sql = "SELECT * FROM pay2go WHERE ID = '$delID' AND email = '$delemail'";
				$result = mysqli_query($conn, $sql);
				
				$sqld = "DELETE FROM pay2go WHERE ID = '$delID' AND email = '$delemail'";
				$result = mysqli_query($conn, $sqld);
				if ($result) {										
					echo "刪除成功!!";
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if(isset($_POST['home'])){
				echo '<meta http-equiv="refresh" content="0; url=index.php">';
			}

			if(isset($_POST['login'])){


				$Account = $_POST['SellAccount'];
				$Password = $_POST['SellPassword'];
				//$sql = "SELECT * FROM seller WHERE Account = '$Account' AND Password = '$Password'";

				$sql = "SELECT `Account`, `Password` FROM `seller` " . "WHERE `Account` = :username LIMIT 1";

				$login = $dbh->prepare($sql); 
				$login->bindParam(":username", $Account); 
				$login->execute();
				$user = $login->fetch();
				if ($user && $user['Password'] == $Password )
				{
	
						session_start();
						$_SESSION['var1']=$Account;
						$_SESSION['var2']=$Password;
						echo '<meta http-equiv="refresh" content="0; url=sell.php">';
				}
				else
				{
					?>
					<script>
					window.setInterval('ShowErrorMessage()',10);
					</script>
					<id="Error" onclick="ShowErrorMessage()">
					<?php
				}
			}
				//$sth->bindParam('$Account', '$Password');
				//$sth->bindParam('$Account', '$Password', PDO::PARAM_STR);


				
				/*$result = mysqli_query($conn, $sql);    舊版
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
					window.setInterval('ShowErrorMessage()',10);
					</script>
					<id="Error" onclick="ShowErrorMessage()">
					<?php
				}*/
				
			

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			mysqli_close($conn);
		?>       
    </div>
    
</body>
</html>