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

		$j_kurs = 'https://www.nbrb.by/api/exrates/rates?periodicity=0';
		$json = json_decode(file_get_contents($j_kurs));
				
		if ($_GET["go"]) {

			if($_GET["cash"] != null)
			{
				if($_GET["to"]==0){					
					$kurs = ($json[4]->Cur_OfficialRate);					
					$result = $_GET["cash"] / $kurs;	
					$res = ($_GET["cash"].' BYN = '.round($result,2).' USD');
					echo($res);
					setcookie("conv",$res);
				}
				
				if($_GET["to"]==1){ //EUR
					$kurs = ($json[5]->Cur_OfficialRate);					
					$result = $_GET["cash"] / $kurs;	
					$res = ($_GET["cash"].' BYN = '.round($result,2).' EUR');
					echo($res);
					setcookie("conv",$res);
				}
				
				if($_GET["to"]==2){					
					$kurs = ($json[16]->Cur_OfficialRate);
					$result = (100/ $kurs) * $_GET["cash"];	
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
