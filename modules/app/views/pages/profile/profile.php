<?php
	include('./modules/app/models/profile/profile.php');
?>
	<div id='main' class='container text-center justify-content-center mx-auto'>

		<?php
			if($username=='admin'){
				if(isset($_GET['action']) && $action=='edit_profile'){
					include("./modules/app/views/pages/profile/edit_profile.php");
				}else{
					include("./modules/app/views/pages/profile/admin_view_profile.php");
					echo "<div class='justify-content-center h2 m-5'>Kursna lista</div>";
					include("./modules/app/views/pages/profile/view_currencylist.php");
				}
			}elseif($username!='admin' && $username!=='' ){
				if(isset($_GET['action']) && $action=='edit_profile'){
					include("./modules/app/views/pages/profile/edit_profile.php");
				}elseif(isset($_GET['action']) && $action=='edit_currencylist'){
					include("./modules/app/views/pages/profile/edit_currencylist.php");
				}else{
					if(sessionCheckUser($username,$get_id)){
						include("./modules/app/views/pages/profile/admin_view_profile.php");
						echo "<div class='justify-content-center h2 m-5'>Kursna lista</div>";
						if($list>0){
							if(!checkList($res)) {
								include("./modules/app/views/pages/profile/user_view_currencylist.php");
							} else {
								include("./modules/app/views/pages/profile/user_example_view_currencylist.php");
							}
						}else{
							include("./modules/app/views/pages/profile/user_example_view_currencylist.php");
						}
					}else{
						include("./modules/app/views/pages/profile/user_view_profile.php");
						echo "<div class='justify-content-center h2 m-5'>Kursna lista</div>";
						include("./modules/app/views/pages/profile/view_currencylist.php");
					}
				}
				
			}elseif($user=='anonymous'){
				include("./modules/app/views/pages/profile/user_view_profile.php");
				echo "<div class='justify-content-center h2 m-5'>Kursna lista</div>";
				include("./modules/app/views/pages/profile/view_currencylist.php");

			}
			else{
				include("./modules/app/views/pages/notifications/error.php");
			}
			
			// include("./modules/app/views/pages/profile/chart.php");
			
		?>
		
		<div id="chart_prof" class='text-center'></div>

	</div>
	