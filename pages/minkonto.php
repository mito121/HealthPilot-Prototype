<!-- LOGGED IN -->
<div ng-controller="kontoCtrl" ng-init="show_results(); getUser_avg_scores();">
    <div class="container my-5">
        <div class="col-12">
            <div class="">
                <div class="row">
                    <div class="col-9">
                        <h4>Velkommen {{getUserName()}}</h4>
                        Her kan du se og ændre din brugerprofil og dine aktiviteter på HealthPilot
                    </div>
                    <div class="col-3 right" >
                        <img ng-src='{{getUserImg()}}' class="img-thumbnail img-hp"><br>	
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 p-3 m-2 bg-white my-account"><!-- LEFT COL -->
                        <h4>Gennemsnit af mine anmeldelser</h4>
                        <div class="health_score_spec_row" ng-repeat="a in user_avg_scores | filter: {u_id : getUserId()}:true">
                          <div class="health_score_name">{{a.r_name}}</div>
                            <div class="health_score_hearts">
                                <i class="fa fa-heart avg_1" ng-if="a.avg >= 0.5"></i>
                                <i class="fa fa-heart avg_1" ng-if="a.avg >= 1.5"></i>
                                <i class="fa fa-heart avg_1" ng-if="a.avg >= 2.5"></i>
                                <i class="fa fa-heart avg_1" ng-if="a.avg >= 3.5"></i>
                                <i class="fa fa-heart avg_1" ng-if="a.avg >= 4.5"></i>
                                <i class="fa fa-heart avg_1" ng-if="a.avg >= 5.5"></i>
                                <i class="fa fa-heart avg_1" ng-if="a.avg >= 6.5"></i>
                                <i class="fa fa-heart avg_1" ng-if="a.avg >= 7.5"></i>
                                <i class="fa fa-heart avg_1" ng-if="a.avg >= 8.5"></i>
                                <i class="fa fa-heart avg_1" ng-if="a.avg >= 9.5"></i>
                                <i class="fa fa-heart avg_0" ng-if="a.avg < 0.5"></i>
                                <i class="fa fa-heart avg_0" ng-if="a.avg < 1.5"></i>
                                <i class="fa fa-heart avg_0" ng-if="a.avg < 2.5"></i>
                                <i class="fa fa-heart avg_0" ng-if="a.avg < 3.5"></i>
                                <i class="fa fa-heart avg_0" ng-if="a.avg < 4.5"></i>
                                <i class="fa fa-heart avg_0" ng-if="a.avg < 5.5"></i>
                                <i class="fa fa-heart avg_0" ng-if="a.avg < 6.5"></i>
                                <i class="fa fa-heart avg_0" ng-if="a.avg < 7.5"></i>
                                <i class="fa fa-heart avg_0" ng-if="a.avg < 8.5"></i>
                                <i class="fa fa-heart avg_0" ng-if="a.avg < 9.5"></i>
                            </div>
                            <div class="health_score_number">{{a.avg}} / 10</div>
                        </div>
                    </div><!-- left col -->

                <div class="col p-3 m-2 bg-white"><!-- right col -->
                    <h4>Mine brugeroplysninger</h4>
                    <form class="pb-3" ng-submit="updateUser(userId, newName, newPassword, newEmail, roleId)">
                        
                        <input ng-model="userId" type="hidden" ng-init="userId = getUserId()">
                        <input ng-model="roleId" type="hidden" ng-init="roleId = getUserRoleId()">
                        
                        <label for="name">Navn</label>
                        <input type="text" ng-model="newName" class="form-control" ng-init="newName = getUserName()" required>
                        
                        <label for="pw">Adgangskode</label>
                        <input type="text" ng-model="newPassword" class="form-control" placeholder="********" value="">
                        
                        <label for="mail">Mail</label>
                        <input type="email" ng-model="newEmail" class="form-control" ng-init="newEmail = getUserEmail()" required>
                        
                        <div class="form-group">
                            <label for="img">Vælg foto</label><br>
                            <input type="file" file-input="files" id="imageUpload" onchange="angular.element(this).scope().setFile(this)">
                        </div>
                        
                        <input type="submit" class="btn btn-primary" style="width:100%" value="Ret">
                        
                    </form>
                    <div>{{response}}</div>
                    <div>{{fbConnectResponse}}</div>
                  
                    <button ng-if="getFbId()=='null'" ng-click="fbConnect(getUserId())" class="btn-fb">Forbind til Facebook</button>
                    <span ng-if="getFbId()!='null'">Kontoen er knyttet til Facebook</span>
                </div><!-- right col -->

                </div>
                <div class="row"><!-- BOTTOM ROW -->
                    <div class="col p-3 m-2 bg-white">
                        <h4>Mine anmeldelser</h4>
                        <table class="table-striped tbl_result">
                            <tr class="tr_result_header">
                                <th class="table_header" ng-click="sort('i_name')">Behandler
                                    <span ng-class="class('i_name')"></span>
                                </th>
                                <th class="table_header" ng-click="sort('p_name')">Kategori
                                    <span ng-class="class('p_name')"></span>
                                </th>
                                <th class="table_header" ng-click="sort('c_name')">By
                                    <span ng-class="class('c_name')"></span>
                                </th>
                                <th class="table_header" colspan="2" ng-click="sort('--s_avg')">Healthscore
                                    <span ng-class="class('--s_avg')"></span>
                                </th>
                            </tr>

                            <tr class="tr_result" dir-paginate="x in results | filter: {u_id : getUserId()}:true | orderBy:sortKey:reverse | itemsPerPage: 10">
                                <td class="td_result1"><a ng-href="#single/{{x.i_id}}">{{x.i_name}}</a></td>
                                <td class="td_result2">{{x.p_name}}</td>
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

                        <div class="center">
                            <dir-pagination-controls
                                max-size="16"
                                direction-links="true"
                                boundary-links="false">
                            </dir-pagination-controls>
                        </div>
                    </div>
                </div><!-- END bottom row -->
                <p>&nbsp;</p>
            </div>
        </div>
    </div><!-- container -->
</div><!-- NG -->