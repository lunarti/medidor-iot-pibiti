<?php


	$pass = $_GET['pass'];
	$mode = $_GET['m'];
	date_default_timezone_set('America/Sao_Paulo');
	$dateserver= date('Y-m-d H:i:s') ;
	$intervalotempobackup = 1;
	//$formatostringdata = "2006/01/01 08:04:20";
	//$formatorequisição = http://localhost/index.php?i=1&c=1.2&m=1&v=1.1&p=code&d=2008/08/06%2008:04:20
	
	// Set password. This is just to prevent some random person from inserting values. Must be consistent with YOUR_PASSCODE in Arduino code.
	$passcode = "code";
	
	// database credentials
	$servername = "localhost";
	$username = "root";
	$dbname = "pibiti";
	$password = "";
	
	// Check if password is right. (If there is no password, assume no data is trying to be entered and skip over this.)
	if(isset($pass) && ($pass == $passcode))
	{
		//verifica se o mode foi selecionado
		if(isset($mode)) 
		{			
			if($mode==1) // idamostra, corrente, tensão, dataserver, dataamostra
			{
				//$date = date('Y-m-d H:i:s',strtotime("+$soma day",strtotime($_GET['d'])));
				$date = date('Y-m-d H:i:s',strtotime($_GET['d']));
				$idamostra = $_GET['i'];
				$current = $_GET['c'];
				$voltage = $_GET['v'];
				$pass = $_GET['p'];
				
				if(isset($current)&&isset($voltage)&&isset($date)&&isset($idamostra))
				{
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					
					if (!$conn) 
					{
						die("Connection failed: " . mysqli_connect_error());
					}
					
					$sql = "INSERT INTO dadosp (date, dateserver, idamostra, current, voltage)
					VALUES ('$date', '$dateserver','$idamostra', '$current', '$voltage')";
					
					if (mysqli_query($conn, $sql)) 
					{
						echo "OK DADOS GRAVADOS mode 1";
					} 
					else 
					{
						echo "Fail: " . $sql . "<br/>" . mysqli_error($conn);
					}
					// Close connection.
					mysqli_close($conn);
				}
			}			
			else if($mode==2) // temperaturas,idamostra, e data(data da página ou 1 valor do rtc e somar os pulos nas próximas temperaturas), envio por variação de estado
			{
				$date = date('Y-m-d H:i:s',strtotime($_GET['d']));
				$idamostra = $_GET['i'];
				$t1 = $_GET['t1'];
				$t2 = $_GET['t2'];
				$t3 = $_GET['t3'];
				$t4 = $_GET['t4'];
				$t5 = $_GET['t5'];
				
				if(isset($t1)&&isset($t2)&&isset($t3)&&isset($t4)&&isset($t5)&&isset($date)&&isset($idamostra))
				{
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					
					if (!$conn) 
					{
						die("Connection failed: " . mysqli_connect_error());
					}
					
					$sql = "INSERT INTO dadostemp (date, dateserver, idamostra, t1, t2, t3, t4, t5)
					VALUES ('$date', '$dateserver','$idamostra', '$t1, '$t2','$t3','$t4','$t5')";
					
					if (mysqli_query($conn, $sql)) 
					{
						echo "OK DADOS GRAVADOS mode 2";
					} 
					else 
					{
						echo "Fail: " . $sql . "<br/>" . mysqli_error($conn);
					}
					// Close connection.
					mysqli_close($conn);
				}
				
			}
			else if($mode==3) // entrada backup - 1 valor do rtc, depois um while inserindo os valores armazenados todos enviando em apenas 1 get(enviando um array) e 1 data
			{
				//http://localhost/index.php?pass=code&m=3&qtdeamostra=2&tmed=1,2&p=2,3&idamostra=1&d=2008/08/06%2008:04:20
				$qtdeamostra = $_GET['qtdeamostra'];
				$tmed = explode(",", $_GET["tmed"]);
				$pot = explode(",", $_GET["p"]);
				$idamostra = $_GET['idamostra'];
				$date = date('Y-m-d H:i:s',strtotime($_GET['d']));
				
				if(count($tmed)!=$qtdeamostra&&count($pot)!=$qtdeamostra)
				{
					echo "Quantidade de amostrar não bate com tamanho de vetores";
					echo  $qtdeamostra . " qtdeamostra " . count($tmed) . " counttmed " . count($pot) . " countpot <br/>";
				}
				else if(isset($tmed)&&isset($pot)&&isset($date)&&isset($qtdeamostra)&&isset($idamostra))
				{
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					
					if (!$conn) 
					{
						die("Connection failed: " . mysqli_connect_error());
					}
					
					for ($x = 0; $x < $qtdeamostra; $x++) 
					{
					$dateenv = date('Y-m-d H:i:s',strtotime("+$x minutes",strtotime($_GET['d'])));
					$potenv = $pot[$x];
					$tmedenv = $tmed[$x];
					$sql = "INSERT INTO backup (idamostra, date, dateserver, pot, tmed)
					VALUES ('$idamostra', '$dateenv', '$dateserver', '$potenv'	, '$tmedenv')";
					
						if (mysqli_query($conn, $sql)) 
						{
							echo "Envio: "
							echo $x+1 . " de " . $qtdeamostra . "<br/>";
						} 
						else
						{
							echo "Fail: "
							echo  $sql . "Valor enviado id:" . $x+1 . " de " . $qtdeamostra ."<br/>" . mysqli_error($conn);
						}
					} 

					// Close connection.
					mysqli_close($conn);
				}
				else
					{
						echo "fail g";
					}
					
				
			}
			else if($mode==4) // variáveis de estado
			{
				
			}	
				
		}
	}
	else{echo "Fail p";}
?>
