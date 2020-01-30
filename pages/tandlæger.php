<div ng-controller="mainCtrl" ng-init="show_results(); show_highscore_institutions()" style="background-color:#F3F6E0">
	<div class="container pt-5">
		<div class="row pb-2 mb-5">
			<div class="col-8">
        <h1>Tandlæger</h1>
			</div>
			<div class="col-4 right">
          <img class='img-practice' src="../uploads/dentist-150x150.jpg">
      </div>
		</div>
	</div>
  	
	<div class="container mb-5">
		<div class="row mx-1 pt-5 result-box">
			<div class="col">
				<div class="search-delete-box">
					<input type="text" class="form-control" id="searchText" placeholder="Søg på behandler" ng-model="search" ng-click="toogle()">
					<a href="" title="Slet søgning" class="search-delete" ng-click="clear_search()">X</a>
				</div>
			</div>
			
			<div class="col-lg-1">
				<p class="og-eller">eller</p>
			</div>
			<div class="col">
				<div class="search-delete-box">
					<input type="text" class="form-control" id="searchCity" placeholder="Søg på postnummer" ng-model="searchCity">
					<a href="" title="Slet by" class="search-delete" ng-click="clear_city_search()">X</a>
				</div>
			</div>
			
			<!-- results -->
			<div class="col-12 my-3">
				<div class="row">
					<div class="col-12 pt-3">
						<table class="table-striped tbl_result">
							<tr class="tr_result_header">
								<th class="table_header" ng-click="sort('i_name')">Behandler
									<span ng-class="class('i_name')"></span>
								</th>
								<th class="table_header" ng-click="sort('c_name')">By
									<span ng-class="class('c_name')"></span>
								</th>
								<th class="table_header" colspan="2" ng-click="sort('--s_avg')">Healthscore
									<span ng-class="class('--s_avg')"></span>
								</th>
							</tr>

							<tr class="tr_result" dir-paginate="x in results | filter: {i_name : search} | filter: {zip_id : searchCity} | filter: {practice_id : '17'}:true | orderBy:sortKey:reverse | itemsPerPage : searchNumber">
								<td class="td_result1"><a ng-href="#single/{{x.i_id}}">{{x.i_name}}</a></td>
								<td class="td_result3">{{x.c_name}}</td>
								<td class="td_result4">
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
								</td>
								<td class="td_result5">{{x.s_avg}}</td>
							</tr>
						</table>
						<br>
						<div class="row p-0">
							<div class="col-7">
								<div class="right">
									<dir-pagination-controls
										max-size="11"
										direction-links="true"
										boundary-links="false">
									</dir-pagination-controls>
								</div>
							</div>	
							<div class="col-5">
								<div class="" style="margin:20px 0;">
									<div style="display:inline-block; font-size:0.8rem; margin-right:10px;">Antal linjer per side</div>
									<select class="selectpicker" style="border:solid 1px #dddddd; padding-top:5px; padding-bottom:5px" ng-init="searchNumber=10" ng-model="searchNumber">
										<option value="10">10</option>
										<option value="50">50</option>
										<option value="100">100</option>
										<option value="500">500</option>
									</select>
								</div>
							</div>	
						</div><!-- row -->
					</div>
				</div>
			</div>
		</div>
	</div>	

	<div class="container-fluid py-2 mb-5" style="background-color:#f7f7f3">
		<div class="container mb-5">
			<div class="col-12">
				<div class="my-5">
					<h2>De 10 mest populære diætister i de seneste tre måneder</h2>
				</div>
			</div>
			<div class="row col-12 justify-content-around">
				<div class="d-flex flex-row" ng-repeat="x in highscoreInst | filter: {p_id : '17'}:true | limitTo:10">
					<a class="p-2 m-1 beh-scores" ng-href="#single/{{x.i_id}}">
						<div class='beh-name'>{{x.i_name}}</div>
						<div class='beh-stars'>
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
							<div class="beh-info">
								{{x.p_name}} - {{x.c_name}}
							</div>
						<div class='beh-avg'>{{x.s_avg}}</div>						
					</a>
				</div>
			</div>
		</div>
	</div><!-- container -->
</div><!-- ng-controller -->