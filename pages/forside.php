<div ng-controller="mainCtrl" ng-init="show_highscore_institutions(); show_map();">
    <div class="container pt-5">
        <div class="row col-12 pb-2">
            <h2>Danmarks uafhængige sundhedsportal</h2>
            <br>

        </div>
        <div class="row">
            <div class="col-8 mb-3">
                <h4>Fortæl om dine oplevelser med læger, tandlæger, fysioterapeuter, psykologer, alternative behandlere, sygehuse etc. 
                    <br><br>Hjælp behandlerne med at forbedre kvaliteten af deres ydelser og hjælp andre borgere med at vælge det rette tilbud.</h4>
            </div>
            <div class="col-4 mb-3">
                <div class="p-1 pt-3 ml-5 legends jumbo-dark8">
                    <ul>
                        <li>Oversigt over behandlere</li>
                        <li>Prissammenligninger</li>
                        <li>Brugeranmeldelser</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row mx-1 pt-4 result-box">

            <div class="col-4">
                <input type="text" class="form-control" placeholder="Søg på by eller postnummer" ng-model="searchQuery">
            </div>

            <!-- results -->
            <div class="col-12 mb-2 mt-3" style="background-color: #fff">
                <div class="row">

                    <div class="col-7 pt-3 ">
                        <!-- loading gif -->
                        <div id="loadinggif" ng-show="loading" class="p-5"><img src="images/loadinggif.png"></div>

                        <div class="col-12 result" ng-init="show_results()">
                            
                            <!-- filtered results -->
                            <div ng-hide="true" ng-href="#single/{{x.i_id}}" class="row px-3 py-2 mb-1 data-row" dir-paginate="x in $parent.filtered_results = (results | filter: searchFilter | itemsPerPage : searchNumber)" on-finish-render="ngRepeatFinished"></div>
                            
                            <!-- insts within boundaries -->
                            
                            <a ng-href="#single/{{i.i_id}}" class="row px-3 py-2 mb-1 data-row" ng-repeat="i in positionsWithinBounds" ng-mouseover="makeBounce(i.i_id)" ng-mouseleave="stopBounce(i.i_id)">
                                <div class="col-7 data">
                                    <div class="data1">{{i.i_name}}</div>
                                    <div class="data2">{{i.p_name}} - {{i.i_street}}, {{i.zip_id}} {{i.c_name}}</div>
                                </div>
                                
                                <div class="col-5 pl-2 data-score">
                                    <i class="fa fa-heart avg_1" ng-if="i.s_avg >= 0.5"></i>
                                    <i class="fa fa-heart avg_1" ng-if="i.s_avg >= 1.5"></i>
                                    <i class="fa fa-heart avg_1" ng-if="i.s_avg >= 2.5"></i>
                                    <i class="fa fa-heart avg_1" ng-if="i.s_avg >= 3.5"></i>
                                    <i class="fa fa-heart avg_1" ng-if="i.s_avg >= 4.5"></i>
                                    <i class="fa fa-heart avg_1" ng-if="i.s_avg >= 5.5"></i>
                                    <i class="fa fa-heart avg_1" ng-if="i.s_avg >= 6.5"></i>
                                    <i class="fa fa-heart avg_1" ng-if="i.s_avg >= 7.5"></i>
                                    <i class="fa fa-heart avg_1" ng-if="i.s_avg >= 8.5"></i>
                                    <i class="fa fa-heart avg_1" ng-if="i.s_avg >= 9.5"></i>
                                    <i class="fa fa-heart avg_0" ng-if="i.s_avg < 0.5"></i>
                                    <i class="fa fa-heart avg_0" ng-if="i.s_avg < 1.5"></i>
                                    <i class="fa fa-heart avg_0" ng-if="i.s_avg < 2.5"></i>
                                    <i class="fa fa-heart avg_0" ng-if="i.s_avg < 3.5"></i>
                                    <i class="fa fa-heart avg_0" ng-if="i.s_avg < 4.5"></i>
                                    <i class="fa fa-heart avg_0" ng-if="i.s_avg < 5.5"></i>
                                    <i class="fa fa-heart avg_0" ng-if="i.s_avg < 6.5"></i>
                                    <i class="fa fa-heart avg_0" ng-if="i.s_avg < 7.5"></i>
                                    <i class="fa fa-heart avg_0" ng-if="i.s_avg < 8.5"></i>
                                    <i class="fa fa-heart avg_0" ng-if="i.s_avg < 9.5"></i>
                                    <div class="data-num">{{i.s_avg}}</div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="col-5 pl-0">
                        <!-- map -->
                        <div class="mt-3">
                            <!--{{positions}}-->
                            <ng-map zoom-to-include-markers="auto" class="hp-map" ng-click="hideInfo()">

                                <info-window id="myInfoWindow">
                                    <div ng-non-bindable>
                                        <h6><strong>{{selectedInst.i_name}}</strong></h6>
                                        <div ng-if="selectedInst.s_avg > 0" class="data-score">
                                            <i class="fa fa-heart avg_1" ng-if="selectedInst.s_avg >= 0.5"></i>
                                            <i class="fa fa-heart avg_1" ng-if="selectedInst.s_avg >= 1.5"></i>
                                            <i class="fa fa-heart avg_1" ng-if="selectedInst.s_avg >= 2.5"></i>
                                            <i class="fa fa-heart avg_1" ng-if="selectedInst.s_avg >= 3.5"></i>
                                            <i class="fa fa-heart avg_1" ng-if="selectedInst.s_avg >= 4.5"></i>
                                            <i class="fa fa-heart avg_1" ng-if="selectedInst.s_avg >= 5.5"></i>
                                            <i class="fa fa-heart avg_1" ng-if="selectedInst.s_avg >= 6.5"></i>
                                            <i class="fa fa-heart avg_1" ng-if="selectedInst.s_avg >= 7.5"></i>
                                            <i class="fa fa-heart avg_1" ng-if="selectedInst.s_avg >= 8.5"></i>
                                            <i class="fa fa-heart avg_1" ng-if="selectedInst.s_avg >= 9.5"></i>
                                            <i class="fa fa-heart avg_0" ng-if="selectedInst.s_avg < 0.5"></i>
                                            <i class="fa fa-heart avg_0" ng-if="selectedInst.s_avg < 1.5"></i>
                                            <i class="fa fa-heart avg_0" ng-if="selectedInst.s_avg < 2.5"></i>
                                            <i class="fa fa-heart avg_0" ng-if="selectedInst.s_avg < 3.5"></i>
                                            <i class="fa fa-heart avg_0" ng-if="selectedInst.s_avg < 4.5"></i>
                                            <i class="fa fa-heart avg_0" ng-if="selectedInst.s_avg < 5.5"></i>
                                            <i class="fa fa-heart avg_0" ng-if="selectedInst.s_avg < 6.5"></i>
                                            <i class="fa fa-heart avg_0" ng-if="selectedInst.s_avg < 7.5"></i>
                                            <i class="fa fa-heart avg_0" ng-if="selectedInst.s_avg < 8.5"></i>
                                            <i class="fa fa-heart avg_0" ng-if="selectedInst.s_avg < 9.5"></i>
                                            <div class="data-num">{{selectedInst.s_avg}}</div>
                                            <br><br>
                                        </div>
                                        <p>{{selectedInst.p_name}} - {{selectedInst.i_street}}, {{selectedInst.zip_id}} {{selectedInst.c_name}}</p>
                                        <a ng-href="#single/{{selectedInst.i_id}}">Gå til behandlerside</a>
                                    </div>
                                </info-window>

                                <marker position="[55.395700, 10.368710]" title="Din placering" icon="https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|3d5afe"></marker>
                                <marker id="{{m.i_id}}" ng-repeat="m in positions" position="{{m.pos}}" title="{{m.i_name}}" icon="https://pilot.webnation.dk/images/heartmarker.png" animation="{{m.animation}}" on-click="showInfo(event, m)"></marker>

                            </ng-map>
                        </div>

                        <!--<div ng-repeat="i in vm.positionsWithinBounds">{{i.id}} - {{i.name}} - {{i_street}}</div>-->

                    </div>
                </div><!-- row -->

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
<!--                            <select ng-model="searchNumber" 
                                    ng-options="numberOption as numberOption.value for numberOption in searchNumbers track by searchNumbers.value" 
                                    ng-change="updateMarkers(searchNumber)" 
                                    class="selectpicker" style="border:solid 1px #dddddd; padding-top:5px; padding-bottom:5px">
                            </select>-->
                            <select ng-model="searchNumber"
                                    ng-change="updateMarkers(searchNumber)" 
                                    class="selectpicker" style="border:solid 1px #dddddd; padding-top:5px; padding-bottom:5px">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>        

                </div>
            </div>
        </div>
    </div>	

    <div class="container-fluid py-2 jumbo-dark1">
        <div class="container mb-5">
            <div class="col-12">
                <div class="my-5">
                    <h2>Gå i dybden med de specifikke kategorier</h2>
                </div>
            </div>

            <div class="row col-12 justify-content-around">
                <div class="d-flex flex-row" ng-repeat="x in optionPractices">
                    <a class="p-1 pt-2 box-img-practice" href="#{{x.p_name}}">
                        <img class="img-practice" src="../uploads/{{x.p_img}}">
                        <div class="pt-1">{{x.p_name}}</div>
                    </a>			
                </div>
            </div>	
        </div>
    </div>

    <div class="container-fluid py-2 mb-5">
        <div class="container mb-5">
            <div class="col-12">
                <div class="my-5">
                    <h2>De 10 mest populære behandlere i de seneste tre måneder</h2>
                </div>
            </div>
            <div class="row col-12 justify-content-around">
                <div class="d-flex flex-row" ng-repeat="x in highscoreInst| limitTo:15">
                    <a class="p-2 m-1 beh-scores" ng-href="#single/{{x.i_id}}">
                        <div class="beh-name">{{x.i_name}}</div>
                        <div class="beh-stars">
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
                        <div class="beh-avg">{{x.s_avg}}</div>						
                    </a>
                </div>
            </div>
        </div>
    </div><!-- container -->
</div><!-- ng-controller -->