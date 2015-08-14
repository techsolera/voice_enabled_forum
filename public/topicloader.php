
	<?php
								open_database_connection();
								
								$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
								if ($page <= 0) $page = 1;

								$per_page = 5; // Set how many records do you want to display per page.

								$startpoint = ($page * $per_page) - $per_page;

								$statement = "`forum_question`  WHERE `cid`='$cid' ORDER BY `datetime` ASC"; // Change `records` according to  table name.

								$results = mysql_query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
								if (mysql_num_rows($results) != 0) {

								// displaying records.
									$i=$startpoint;
								while ($row = mysql_fetch_array($results)) {
									$tid=$row['tid'];
									$sql="SELECT `tname` FROM `topic` WHERE `tid`='$tid'";
									$name=execute_query($sql);
									$qid=$row['question_id'];
									echo '<tr>';
									echo '<td>'.($i+1).'</td>';
									echo '<td>';
									echo '<a href="view.php?question='.$qid."&topic=".$tid.'">';
									echo $name[0]['tname'];
									echo '</td>';
									echo '</a>';
									echo '<td>'.$row['view'].'</td>';
									echo '<td>'.$row['reply'].'</td>';
									echo '</tr>'; 
									$i++;	

									}
										

								} else {
									echo '<tr>
									<td colsapn="4">No topics</td>
									</tr>';
								}
								close_database_connection();
								// displaying paginaiton.
								
							?>
			              