<?php
$N= trim(fgets(STDIN));
if($N>0 && $N<15)
{
for ($i=0; $i <$N ; $i++) { 
	
		$num=trim(fgets(STDIN));
		$t=strlen($num);
		if($t<=10)
		echo validar($num).PHP_EOL;	
		
		else
		{			
			if($t>10 && $t<=17)
			{
				if(strpos($num,"-")==true)
				{	
					$numS=explode("-", $num);				
				 	$tA=count($numS);
					$num="";
					for ($g=0; $g < $tA; $g++) { 
						$num.=$numS[$g];
					}
					echo validar($num).PHP_EOL;	
				}
				else
				{
					$numS=explode(" ", $num);				
				 	$tA=count($numS);
					$num="";
					for ($j=0; $j < $tA; $j++) { 
						$num.=$numS[$j];
					}
					echo validar($num).PHP_EOL;	
				}

			}

		}

}
}
function validar($num)
{
	$tot=0;
	$ban=true;
			for ($c=0; $c <12 ; $c++) { 
				
				if($ban)
				{
					//$tot+=$num[$c]*1;
					$ban=false;
				}
				else{
					//$tot+=$num[$c]*3;
					$ban=true;
				}
			}
			$res=$tot%10;			
			if($res==0)
				$dc=0;
			else
				$dc=10-$res;
			if($dc==$num[12])
				echo 'CORRECTO';
			else
				echo 'INCORRECTO';
				
}
?>