<?php 
	include('./modules/app/models/profile/edit_profile.php');	
?>
<body>
	<div id='main' class='container text-center justify-content-center mx-auto'>
		<form id='form1' method='POST'  action='index.php?page=profile&id=<?php echo $exchange_office_id;?>&action=edit_profile' class='col-12'>
			<div class='form-row text-center justify-content-center mt-5'>
				<div class='col-2'></div>
				<div class='form-group col-5 m-2 border'>
					<div class='row m-2'>
						<div class='input-group my-2'>	
							<input type='text' id='name_office' name='name_office' placeholder='Naziv menjacnice' 
							value='<?php echo isset($_POST['save_profile']) ? $_POST['name_office'] : '' ?>' class='form-control'>
						</div>	
					</div>
					<div id='add_location' class='row m-2'>
						<div class='input-group my-2'>	
							<input type='text' id='location0' name='location0' placeholder='Lokacija menjacnice' 
							value='<?php echo isset($_POST['save_profile']) ? $_POST['location0'] : '' ?>' class='form-control mr-2'>
							<input type="button" name="btn-l" value='Dodaj' id='btn-location' class='btn btn-sm btn-outline-dark'>
						</div>
					</div>
					<div id='add_phone' class='row m-2'>
						<div class='input-group my-2'>	
							<div class='input-group-prepend'>
          						<span class='input-group-text bg-dark text-warning' id='inputGroupPrepend'>+381</span>
        					</div>	
							<input type='text' id='phone0' name='phone0' placeholder='telefon' 
							value='<?php echo isset($_POST['save_profile']) ? $_POST['phone0'] : '' ?>' class='form-control' >
							<!--<input type="button" name="btn-p" value='Dodaj' id='btn-phone' class='btn'>-->
						</div>
					</div>	
					<div id='add_email' class='row m-2'>
						<div class='input-group my-2'>	
							<input type='email' id='email0' name='email0' placeholder='E-mail' 
							value='<?php echo isset($_POST['save_profile']) ? $_POST['email0'] : '' ?>' class='form-control'>
							<!--<input type="button" name="btn-m" value='Dodaj' id='btn-email' class='btn'>-->
						</div>	
					</div>
					<div class='form-group mt-2'>
					<div id='errors' class='col-12 ml-5'>
						<div id='error' class='input-group invalid-feedback mb-2 ml-5'>	
							
								<?php 
									if(isset($errors) && count($errors)!=0){
										foreach($errors as $key => $value){
											echo $errors[$key].'<br>';
											unset($errors[$key]);
										}
									}
		
								?>
						
						</div>	
					</div>
					</div>	
					<div class='form-group col-12 mt-4'>
						<div class='row justify-content-center'>
							<button type='submit' id='save' name='save_profile' class='btn btn-dark text-warning' value='Sacuvaj'>Sacuvaj</button> 
						</div>
					</div>
				</div>
				<div class='col-2'></div>
			</div>
		</form>
</div>
		