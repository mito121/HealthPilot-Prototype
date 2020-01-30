<div class="container my-5" ng-controller="searchCtrl" ng-init="show_results();">
    <div class="row">
        <!-- filter selects -->
        <div class="col col-3">
            <h5>Søg på behandler</h5>
					<div class="search-delete-box">
            <input type="text" ng-model="search" class="form-control" placeholder="" id="searchText">
						<a href="" title="Slet søgning" class="search-delete" ng-click="clear_search()">X</a>
					</div>
					
          <br>
          <h5>Vælg en by</h5>
          <div ng-init="cityOptions()">
              <select class="form-control selectpicker" ng-model="selectedCity" ng-init="selectedCity.c_zip_id = selected_city_zip" 
                      ng-options="cityOption as cityOption.city for cityOption in optionCities track by cityOption.c_zip_id">
                  <option value="">Alle</option>
              </select>
          </div>
          <br>
          <div ng-init="practiceOptions()">
              <h5>Vælg behandlingstype</h5>
              <select class="form-control selectpicker" ng-model="selectedPractice" ng-init="selectedPractice.practice_id = selected_practice_id" 
                      ng-options="practiceOption as practiceOption.name for practiceOption in optionPractices track by practiceOption.practice_id">
                  <option value="">Alle</option>
              </select>
          </div>
      </div>
      <!-- results -->
        <div class="col col-9">
            <table class="tbl_result">
							<tr class="tr_result_header">
                <td class="table_header" ng-click="sort('i_name')">Valgte behandlere
									<div ng-class="class('i_name')"></div>
                </td>
                <td class="table_header" ng-click="sort('p_name')">Kategori
									<div ng-class="class('p_name')"></div>
                </td>
                <td class="table_header" ng-click="sort('c_name')">By
									<div ng-class="class('c_name')"></div>
                </td>
                <td class="table_header" colspan="2" align="center" ng-click="sort('s_avg')">Score
									<div ng-class="class('s_avg')"></div>
                </td>
              </tr>
							
                <tr class="tr_result" dir-paginate="x in results | filter: {zip_id : selectedCity.c_zip_id}:true | filter: {practice_id : selectedPractice.practice_id}:true | orderBy:sortKey:reverse | filter:search | itemsPerPage:30">
                    <td class="td_result1"><a target="_self" href="#single/{{x.i_id}}">{{x.i_name}}</a></td>
                    <td class="td_result2">{{x.p_name}}</td>
                    <td class="td_result3">{{x.c_name}}</td>
                    <td class="td_result4">
                      <div class="health_score_spec_row">
                        <i class="fa fa-heart avg_1" ng-if="x.s_avg >= 0.5"></i>
                        <i class="fa fa-heart avg_1" ng-if="x.s_avg >= 1.5"></i>
                        <i class="fa fa-heart avg_1" ng-if="x.s_avg >= 2.5"></i>
                        <i class="fa fa-heart avg_1" ng-if="x.s_avg >= 3.5"></i>
                        <i class="fa fa-heart avg_1" ng-if="x.s_avg >= 4.5"></i>
                        <i class="fa fa-heart avg_1" ng-if="x.s_avg >= 5.5"></i>
                        <i class="fa fa-heart avg_1" ng-if="x.s_avg >= 6.5"></i>
                        <i class="fa fa-heart avg_1" ng-if="x.s_avg >= 7.5"></i>
                        <i class="fa fa-heart avg_1" ng-if="x.s_avg >= 8.5"></i>
                        <i class="fa fa-heart avg_1" ng-if="x.s_avg >= 9.5"></i>
                        <i class="fa fa-heart avg_0" ng-if="x.s_avg < 0.5"></i>
                        <i class="fa fa-heart avg_0" ng-if="x.s_avg < 1.5"></i>
                        <i class="fa fa-heart avg_0" ng-if="x.s_avg < 2.5"></i>
                        <i class="fa fa-heart avg_0" ng-if="x.s_avg < 3.5"></i>
                        <i class="fa fa-heart avg_0" ng-if="x.s_avg < 4.5"></i>
                        <i class="fa fa-heart avg_0" ng-if="x.s_avg < 5.5"></i>
                        <i class="fa fa-heart avg_0" ng-if="x.s_avg < 6.5"></i>
                        <i class="fa fa-heart avg_0" ng-if="x.s_avg < 7.5"></i>
                        <i class="fa fa-heart avg_0" ng-if="x.s_avg < 8.5"></i>
                        <i class="fa fa-heart avg_0" ng-if="x.s_avg < 9.5"></i>
											</div>
                    </td>
                    <td class="td_result5">{{x.s_avg}}</td>
                </tr>
            </table>
					<br>
          <!-- pagination controls -->
          <dir-pagination-controls
              max-size="14"
              direction-links="true"
              boundary-links="false">
          </dir-pagination-controls>
      </div>
    </div>
</div>
