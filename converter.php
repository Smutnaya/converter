<html>
    <head>
    </head>
    <body>
        <form>
            <label>BYN: </label>
            <input name="cash" size="6" type="text"/>
            <label>-> </label>
            <select name="to" id="to">
                <option value="0">USD</option>
                <option value="1">EUR</option>
                <option value="2">RUB</option>
            </select>
            <input type="submit" value="Ok" name="go">
            <br/>
            <br/>
            <label><span id="result" class="result"></span></label>
        </form>
		
		<?php

		  //$string = file_get_contents("https://www.nbrb.by/api/exrates/rates/145");
		//echo($string);
		
		if ($_GET["go"]) {
			$date_today = date("m/d/Y"); // вычисляем сегодняшнюю дату
			$xml_kurs = 'http://www.nbrb.by/Services/XmlExRates.aspx?ondate='.$date_today;
			$xml = simplexml_load_file($xml_kurs);
			if($_GET["cash"] != null)
			{
				if($_GET["to"]==0){
					foreach ($xml->Currency as $Currency) {
						switch((string) $Currency['Id']) { 
					case '145': //USD
						$usd = $Currency->Rate;
						break;
						}
					}
					
					$result = $_GET["cash"] / $usd;	
					echo($_GET["cash"].' BYN = '.round($result,2).' USD');
				}
				
				if($_GET["to"]==1){
					foreach ($xml->Currency as $Currency) {
					switch((string) $Currency['Id']) { 

					case '292':  //EUR
						$eur = $Currency->Rate;
						break;
						}
					}
					
					$result = $_GET["cash"] / $eur;	
					echo($_GET["cash"].' BYN = '.round($result,2).' EUR');
				}
				
				if($_GET["to"]==2){
					foreach ($xml->Currency as $Currency) {
					switch((string) $Currency['Id']) { 
					case '298':  //EUR
						$rub = $Currency->Rate;
						break;
						}
					}
					$result = (100/ $rub) * $_GET["cash"];	
					$res = $_GET["cash"].' BYN = '.round($result,0).' RUB';
					echo($res);
					setcookie("conv",$res);
				}
				
				echo('<br><a href="pdf.php">PDF</a>');
				}

			}			
		
		?> 

	</body>
</html>
