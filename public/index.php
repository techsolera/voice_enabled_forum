
<html>
  <head>

     <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   	 <script type="text/javascript">
    //   google.load("visualization", "1", {packages:["corechart"]});
    //   google.setOnLoadCallback(drawChart);
    //   function drawChart() {
    //     var data = google.visualization.arrayToDataTable([
    //       ['day', 'Users', 'Posts','Replies'],
    //       ['2004',  1000,      400,100],
    //       ['2005',  200,      4000,1000]
    //     ]);

    //     var options = {
    //       title: 'TCET Performance'
    //     };

    //     var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    //     chart.draw(data, options);
    //   }
    // </script>
    <style>
    	table.table.table-bordered tbody tr td a
    	{
    		text-decoration: none;
    	}
    </style>

  </head>

<?php include'layouts\header.php'; ?>
<?php
// open_database_connection();

// if(count($category)==0)
// {
// 	echo "No category";
// }
// else
// {
?>		
				<div class="table-responsive">
						<table class="table table-bordered">
						<tr>
							<th>#</th><th>Category</th><th>Posts</th><th>Replies</th><th>Last Posted By</th>
						</tr>

							<?php
								open_database_connection();
								$sql="SELECT `cname` FROM `categorie`";
 								$category=execute_query($sql);
								$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
								if ($page <= 0) $page = 1;

								$per_page = 5; // Set how many records do you want to display per page.

								$startpoint = ($page * $per_page) - $per_page;

								$statement = "`categorie` ORDER BY `timedate` ASC"; // Change `records` according to  table name.

								$results = mysql_query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");

								if (mysql_num_rows($results) != 0) {

								// displaying records.
									$i=($page-1)*$per_page+($page-1);
								while ($row = mysql_fetch_array($results)) {


									$sql="SELECT `cid` FROM `categorie` WHERE `cname`='".$row['cname']."'";
									$r=execute_query($sql);
									$c=$r[0]['cid'];
									$sql="SELECT `question_id` FROM `forum_question` WHERE `cid`='".$c."'";
									$r=execute_query($sql);
									$post=count($r);
									$reply=0;
									for ($j=0; $j < count($r); $j++) { 
									$question_id=$r[$j]['question_id'];
									$sql="SELECT `a_id` FROM `forum_answer` WHERE `question_id`='".$question_id."'";
									$r2=execute_query($sql);
									$reply=$reply+count($r2);

									}
									$sql="SELECT max(`datetime`) FROM `forum_question` WHERE `cid`='".$c."'";
									$r3=execute_query($sql);
									$max=$r3[0]['max(`datetime`)'];
									$sql="SELECT `name` FROM `forum_question` WHERE `cid`='".$c."' AND `datetime`='".$max."'";

									$r3=execute_query($sql);
									if(count($r3)==1){
									$name=$r3[0]['name'];
									}
									else{
									$max="No entry";
									$name="No entry";}
									echo '<tr><td>'.($i+1).'</td><td>
										<a href="topic.php?categorie='.$row['cname'].'">'.$row['cname'].'</a>
										</td><td>'.$post.'</td><td>'.$reply.'</td><td>'.$name.' <h6>'.$max.'</h6>'.'</td><tr>';
											$i++;
									}
										

								} else {
								echo "No records are found.";
								}
								close_database_connection();
								// displaying paginaiton.								
							?>	
							</table>
							</div>
							<br>
							<div class"row">
							<div class="col-md-12" style="position:relative;left:-15px;top:-20px;" align="left">
								<div class="input-group">
									<form name="category" action="createcategory.php" method="post">
										<span class="input-group-btn">
										<input type="text" class="form-control" name="category" placeholder="create a category">
										<button class="btn btn-default" type="Submit" name="create" style="width:46px;height:37px;">&nbsp;<span class="glyphicon glyphicon-plus"></span></button>
										</span>
									</form>
								</div>
							</div>
							<div class="col-md-3"></div>	
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12"  align="left">
									<?php echo pagination($statement,$per_page,$page,$url='?');?>		
								</div>
							</div>
						<html>
  
  <!-- Google charts -->
  <div class="container">
  <!-- <div class="jumbotron">
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </div> -->
  </div>
  
</html>
<?php include'layouts\footer.php'; ?>

