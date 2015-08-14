
<div class="container">
<table class="table table-hover table-striped">
	<tr>
		<th>User Name.</th>
		<th>User Ip.</th>
		<th>Time</th>
		<th>Action</th>
	</tr>

		<?php
	$myfile = fopen("log.txt", "r") or die("Unable to open file!");
	$line =explode("##",fread($myfile,filesize("log.txt"))) ;
	for($i=0;$i<sizeof($line);$i++)
	{	
       
		echo '<tr>';
		
		$word=explode("#",$line[$i]);
			for($j=0;$j<sizeof($word);$j++)
		{
			echo"<td>$word[$j]</td>";
		}
	}
		fclose($myfile);
		?>
	</tr>
</table>
<?php?>