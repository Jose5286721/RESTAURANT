<div class="container">
	<div class="row">
		<div class="col-lg-4">
		 <br>
		 <div class="mesas">
		  <h3>Seleccionar Una Mesa</h3>
		  <br>
			 <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
			   <!--  <div class="btn-group mr-2" role="group" aria-label="First group"> -->
				<a href="mesa1" class="btn btn-success">MESA 1</a>
				<a href="mesa2" class="btn btn-danger">MESA 2</a>
				<a href="mesa3" class="btn btn-primary">MESA 3</a>
				<br><br>
				<a href="mesa4" class="btn btn-success">MESA 4</a>
				<a href="mesa5" class="btn btn-danger">MESA 5</a>
				<a href="mesa6" class="btn btn-primary">MESA 6</a>
				<br><br>
				<a href="mesa7" class="btn btn-success">MESA 7</a>
				<a href="mesa8" class="btn btn-danger">MESA 8</a>
				<a href="mesa9" class="btn btn-primary">MESA 9</a>
				<br><br>
				<a href="mesa10" class="btn btn-success">MESA10</a>
				<a href="mesa11" class="btn btn-danger">MESA11</a>
				<a href="mesa12" class="btn btn-primary">MESA12</a>
				<br><br>
				<a href="mesa13" class="btn btn-success">MESA13</a>
				<a href="mesa14" class="btn btn-danger">MESA14</a>
				<a href="mesa15" class="btn btn-primary">MESA15</a>
				<br><br>
				<a href="mesa16" class="btn btn-success">MESA16</a>
				<a href="mesa17" class="btn btn-danger">MESA17</a>
				<a href="mesa18" class="btn btn-primary">MESA18</a>
				<br><br>
				<a href="mesa19" class="btn btn-success">MESA19</a>
				<a href="mesa20" class="btn btn-danger">MESA20</a>
				<a href="mesa21" class="btn btn-primary">MESA21</a>
				<br><br>
				<a href="mesa22" class="btn btn-success">MESA22</a>
				<a href="mesa23" class="btn btn-danger">MESA23</a>
				<a href="mesa24" class="btn btn-primary">MESA24</a>
				<br><br>
				<a href="mesa25" class="btn btn-success">MESA25</a>
				<a href="principalVentas" class="btn btn-warning">Salir de las Mesas</a>
			<!-- </div> -->
		</div>
	  </div>
	  	<br><br>
	 </div>
		<div class="col-lg-8">
		   <?php 
             if (isset($_GET['action'])) {
             	if ($_GET['action']== 'mesa1') {
             		include 'mesas/mesa1.php';
             	}else if($_GET['action']== 'mesa2'){
             		include 'mesas/mesa2.php';
             	}else if($_GET['action']== 'mesa3'){
             		include 'mesas/mesa3.php';
             	}else if($_GET['action']== 'mesa4'){
             		include 'mesas/mesa4.php';
             	}else if($_GET['action']== 'mesa5'){
             		include 'mesas/mesa5.php';
             	}else if($_GET['action']== 'mesa6'){
             		include 'mesas/mesa6.php';
             	}else if($_GET['action']== 'mesa7'){
             		include 'mesas/mesa7.php';
             	}else if($_GET['action']== 'mesa8'){
             		include 'mesas/mesa8.php';
             	}else if($_GET['action']== 'mesa9'){
             		include 'mesas/mesa9.php';
             	}else if($_GET['action']== 'mesa10'){
             		include 'mesas/mesa10.php';
             	}else if($_GET['action']== 'mesa11'){
					include 'mesas/mesa11.php';
				}else if($_GET['action']== 'mesa12'){
					include 'mesas/mesa12.php';
				}else if($_GET['action']== 'mesa13'){
					include 'mesas/mesa13.php';
				}else if($_GET['action']== 'mesa14'){
					include 'mesas/mesa14.php';
				}else if($_GET['action']== 'mesa15'){
					include 'mesas/mesa15.php';
				}else if($_GET['action']== 'mesa16'){
					include 'mesas/mesa16.php';
				}else if($_GET['action']== 'mesa17'){
					include 'mesas/mesa17.php';
				}else if($_GET['action']== 'mesa18'){
					include 'mesas/mesa18.php';
				}else if($_GET['action']== 'mesa19'){
					include 'mesas/mesa19.php';
				}else if($_GET['action']== 'mesa20'){
					include 'mesas/mesa20.php';
				}else if($_GET['action']== 'mesa21'){
					include 'mesas/mesa21.php';
				}else if($_GET['action']== 'mesa22'){
					include 'mesas/mesa22.php';
				}else if($_GET['action']== 'mesa23'){
					include 'mesas/mesa23.php';
				}else if($_GET['action']== 'mesa24'){
					include 'mesas/mesa24.php';
				}else if($_GET['action']== 'mesa25'){
					include 'mesas/mesa25.php';
				}else{
	             echo '<br><img src="assets/img/foto1.jpg" width="700" height="348" >';
             	}

             	
             }
		    ?>
	   </div>
	  
</div>
</div>