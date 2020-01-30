<div class="container my-5" ng-controller="mainCtrl">
<h3>Min klinik</h3>      
	<div class="row py-3">
		
		<div class="col col-lg col-12 p-3 m-3 bg-white">	
			<h5><strong>Tilret behandler</strong></h5>
			
      <input type="text" class="form-control" id="searchText" placeholder="Søg på behandler" ng-model="search" ng-click="toogle()">
			<br>
			<input type="text" class="form-control" id="searchCity" placeholder="Søg på postnummer" ng-model="searchCity">
			<br>
      <div ng-init="practiceOptions()">
        <select class="form-control selectpicker" id="searchPractice" ng-model="searchPractice" ng-options="x as x.p_name for x in optionPractices track by x.practice_id">
          <option value="">Vælg kategori</option>
        </select>
      </div>
			<br>
      <div ng-init="show_results()">
        <table class="table-striped tbl_result">
          <tr class="tr_result" dir-paginate="x in results | filter: {i_name:search} | filter: {zip_id:searchCity} | filter: {practice_id:searchPractice.practice_id}:true | itemsPerPage:20">
            <td class="td_result1"><a ng-href="#single/{{x.i_id}}">{{x.i_name}}</a></td>
            <td class="td_result5">{{x.s_avg}}</td>
          </tr>
        </table>      
      </div>
      
			<br>
      <div ng-init="show_inst()">
        
        <div class="tr_result" ng-repeat="x in inst_results | filter: searchInst | limitTo:1">
          <form class="pb-3" ng-submit="update_inst(x.id, new_name, new_practice_id.id, new_street, new_zip_id.zip_id, new_tel, new_email, new_web, new_owner_id.id)">
						
            <label for="newName">Navn</label>
            <input type="text" ng-model="new_name" ng-init="new_name = x.name" id="newName" class="form-control">

            <label>Praksis kategori</label>
            <div ng-init="practiceOptions()">
              <select class="form-control selectpicker" ng-model="new_practice_id" ng-init="new_practice_id.id = x.practice_id" ng-options="p as p.name for p in optionPractices track by p.id" required>
                <option value="">Vælg..</option>
              </select>
            </div>
						
						<label>Adresse</label>
						<input type="text" class="form-control" ng-model="new_street" ng-init="new_street = x.street" required>

						<label>By</label>
            <div ng-init="cityOptions()">
              <select class="form-control selectpicker" ng-model="new_zip_id" ng-init="new_zip_id.zip_id = x.zip_id" ng-options="c as c.city for c in optionCities track by c.zip_id" required>
                <option value="">Vælg..</option>
              </select>
            </div>

						<label>Telefon</label>
						<input type="text" class="form-control" ng-model="new_tel" ng-init="new_tel = x.tel">

						<label>Email</label>
            <input type="text" class="form-control" ng-model="new_email" ng-init="new_email = x.mail">
						
						<label>Hjemmeside</label>
						<input type="text" class="form-control" ng-model="new_web" ng-init="new_web = x.web">

						<label>Ejerskab</label>
						<div ng-init="ownerOptions()">
							<select class="form-control selectpicker" ng-model="new_owner_id" ng-init="new_owner_id.id = x.owner_id" ng-options="o as o.owner for o in optionOwners track by o.id" required>
								<option value="">Vælg..</option>
							</select>
						</div>

						<br>
            <input type="submit" class="btn btn-primary" style="width:100%" value="Ret behandler">
            {{response}}
          </form>
					
          <form class="pb-3" ng-submit="delete_inst(x.id)">
            <input type="submit" class="btn btn-warning" style="width:100%" value="Slet behandler">
            {{response}}
          </form>		
					
				</div>
			</div>
		</div><!-- col -->
	</div><!-- row -->
</div><!-- container -->