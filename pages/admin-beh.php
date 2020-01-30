<div class="container my-5">

	<div class="page-header">
		<h4>Sundhedsinstitution</h4>      
	</div>

	<div class="row py-3">
		<div class="col col-lg col-6 bg-white p-3 m-3">
		<h5>Tilføj en bruger</h5>
		<br><br><br><br>

			<form method="post" action="handlers/insert_u.php" enctype="multipart/form-data">
				<label for="name">Navn</label>
				<input type="text" name="name" class="form-control" required>

				<label for="pw">Adgangskode</label>
				<input type="text" name="pw" class="form-control">

				<label for="mail">Mail</label>
				<input type="text" name="mail" class="form-control">

				<label for="role_id">Rolle</label><br>
				<select name="role_id" class="form-control" required>
					<option disabled selected></option>
					<option value='1'>Administrator</option>
					<option value='2'>Institution</option>
					<option value='3'>Bruger</option>
				</select>
				<br><br>
				
				<div class="form-group">
						<label for="img">Upload foto</label><br>
						<input type="file" id="img" name="img">
				</div>
				<br>
				<input type="submit" name="insert" class="btn btn-primary" style="width:100%" value="Tilføj">
			</form>
			<br>

		</div>
		<div class="col col-lg col-6 bg-white p-3 m-3">
			<h5>Tilret en bruger</h5>

			<form method="post" action="handlers/update_u.php" enctype="multipart/form-data">
				<label for="name">Vælg</label>
				<select name="id" class="form-control selectpicker" value="">
						<option value="">Alle</option>
				</select>
				<br><br>
				
				<label for="u_name">Navn</label>
				<input type="text" name="u_name" class="form-control" value="">

				<label for="pw">Adgangskode</label>
				<input type="password" name="pw" class="form-control" value="">

				<label for="mail">Mail</label>
				<input type="text" name="mail" class="form-control"  value="">

				<label for="role_id">Rolle</label><br>
				<select name="role_id" class="form-control" required value="">
					<option disabled selected></option>
					<option value='1'>Administrator</option>
					<option value='2'>Institution</option>
					<option value='3'>Bruger</option>
				</select>

				<br><br>
				<div class="row">
					<div class="col ">
						<div class="form-group">
							<label for="img">Upload foto</label><br>
							<input type="file" id="img" name="img" value="">
						</div>
					</div>
					<div class="col float-right pb-2">
						<img class="img-thumbnail" src="../uploads/"><br>				
					</div>
				</div>
				<input type="submit" name="insert" class="btn btn-primary" style="width:100%" value="Ret">
			</form>
			<br>

		</div><!-- col -->
	</div><!-- row -->
</div><!-- container -->
