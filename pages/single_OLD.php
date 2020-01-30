<div class="container p-5 single" ng-controller="singleCtrl" ng-init="currentUserRating(); currentUserRatingText(); getRatings(); getAvg(); getInst_avg_scores(); getComments(); get_avg_total_score(); getPrices(); currentNumRatings()">
    
    <div class="row">
      <div class="col p-3 inst-info hp-box"><!-- TOPBOX  -->
        <div class="row">

          <div class="col-7 pt-2"><!-- top venstre -->
            <div class="single-name">{{i_name}}</div>
            <div class="my-3 single-meta">
              <a href="#{{p_name}}">{{p_name}}</a> - 
              <a href="#{{p_name}}/{{c_name}}">{{c_name}}</a>
            </div>
            <!-- Healthscore -->
            <div class="mt-2">
              <div class="" ng-repeat="rating in rating_avg | filter: {i_id: inst_id}:true">
                <div class="score_hearts">
                  <i class="fa fa-heart avg_1" ng-if="rating.avg >= 0.5"></i>
                  <i class="fa fa-heart avg_1" ng-if="rating.avg >= 1.5"></i>
                  <i class="fa fa-heart avg_1" ng-if="rating.avg >= 2.5"></i>
                  <i class="fa fa-heart avg_1" ng-if="rating.avg >= 3.5"></i>
                  <i class="fa fa-heart avg_1" ng-if="rating.avg >= 4.5"></i>
                  <i class="fa fa-heart avg_1" ng-if="rating.avg >= 5.5"></i>
                  <i class="fa fa-heart avg_1" ng-if="rating.avg >= 6.5"></i>
                  <i class="fa fa-heart avg_1" ng-if="rating.avg >= 7.5"></i>
                  <i class="fa fa-heart avg_1" ng-if="rating.avg >= 8.5"></i>
                  <i class="fa fa-heart avg_1" ng-if="rating.avg >= 9.5"></i>
                  <i class="fa fa-heart avg_0" ng-if="rating.avg < 0.5"></i>
                  <i class="fa fa-heart avg_0" ng-if="rating.avg < 1.5"></i>
                  <i class="fa fa-heart avg_0" ng-if="rating.avg < 2.5"></i>
                  <i class="fa fa-heart avg_0" ng-if="rating.avg < 3.5"></i>
                  <i class="fa fa-heart avg_0" ng-if="rating.avg < 4.5"></i>
                  <i class="fa fa-heart avg_0" ng-if="rating.avg < 5.5"></i>
                  <i class="fa fa-heart avg_0" ng-if="rating.avg < 6.5"></i>
                  <i class="fa fa-heart avg_0" ng-if="rating.avg < 7.5"></i>
                  <i class="fa fa-heart avg_0" ng-if="rating.avg < 8.5"></i>
                  <i class="fa fa-heart avg_0" ng-if="rating.avg < 9.5"></i>
                </div>
                <div class="score_number">{{rating.avg}}</div>
                <div class="score_count">({{num_score}} {{textCount}})</div>
              </div>
            </div>
          </div>
          <div class="col-5 py-2"><!-- top højre -->
            <!-- Healthscores -->
            <div class="health_scores_spec_row" ng-repeat="a in inst_avg_scores | filter: {i_id: inst_id}:true">
              <div class="health_scores_name">{{a.r_name}}</div>
              <div class="health_scores_hearts">
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
              <div class="health_scores_number">{{a.avg}}/10</div>
            </div>                  
          </div>
        </div>
        
      </div>
    </div>

    <div class="row mb-5">
      <div class="col-7 p-0 pr-4"><!-- LEFT COL -->

        <!-- institution info -->
        <div class="p-3 mt-3 inst-info single-address hp-box">
          <i class="fa fa-adr"></i>{{i_street}}, {{i_zip}} {{c_name}}
          <p class="tel"><i class="fa fa-tel"></i>{{i_tel}}</p>
          <p ng-if="i_mail!=''"><i class="fa fa-mail"></i>{{i_mail}}</p>
          <p ng-if="i_web!=''"><a href="https://{{i_web}}" title="Gå til behandlers hjemmeside" target="_blank"><i class="fa fa-web"></i>{{i_web}}</a></p>
          <br>

          <!-- map -->
          <div ng-if="uri!=''">
            <a href="https://www.google.dk/maps/search/{{uri}}" title="Åben i Google Maps" target="_blank">
              <img src="https://maps.google.com/maps/api/staticmap?mobile=true&size=1000x300&maptype=roadmap&markers=color:red|{{addr}}&mobile=true&language=da&key=AIzaSyAn-NhOxh0jPs-CNVQhOinA03BpYzsHo9s" style="width:100%">
            </a>
          </div>
        </div>

        <!-- web -->
        <div  ng-if="i_web!=''" class="col-12 mt-3 p-3 web inst-info hp-box">
            <a ng-href="https://{{i_web}}" target="_blank"><img src='http://image.thum.io/get/http://{{i_web}}' class='embed-responsive' title="Gå til behandlers hjemmeside"></a>
        </div>

        <!-- diverse info -->
        <div class="mt-3 py-3 inst-info hp-box">
          <div class="row">
            <div class="col mx-3 misc">
              <strong>Diverse</strong><br>
              {{i_note}}
              <br>
              Opdateret den {{i_update}}
            </div>                
            <div class="col mx-3 openhours">
              <strong>Åbningstider</strong><br>
              <h6>
              <table class="tbl-open" width="100%" border="0">
                  <tr ng-if="mon!=null">
                    <td width="70">Mandag</td>
                    <td>{{mon}}</td>
                  </tr>
                  <tr ng-if="tue!=null">
                    <td>Tirsdag</td>
                    <td>{{tue}}</td>
                  </tr>
                  <tr ng-if="wed!=null">
                    <td>Onsdag</td>
                    <td>{{wed}}</td>
                  </tr>
                  <tr ng-if="thu!=null">
                    <td>Torsdag</td>
                    <td>{{thu}}</td>
                  </tr>
                  <tr ng-if="fri!=null">
                    <td>Fredag</td>
                    <td>{{fri}}</td>
                  </tr>
                  <tr ng-if="sat!=null OR sat!=''">
                    <td>Lørdag</td>
                    <td>{{sat}}</td>
                  </tr>
                  <tr ng-if="sun!=null OR sun!=''">
                    <td>Søndag</td>
                    <td>{{sun}}</td>
                  </tr>
              </table>
              </h6>

            </div>                
          </div>                
        </div>

        <!-- priser -->
        <div class="p-3 mt-3 inst-info hp-box">
          <div class="row pb-3">
            <div class="col-4">
              <div style="position:relative; display:inline-block; font-weight:bold;">Priser</div>
            </div>
            <div class="col-8 right">
              <div clas="" style="font-size:0.8rem; position:relative; margin-left:15px; text-align:center; display:inline-block; border:1px solid #7A7A7A; width:200px; -webkit-border-radius:5px 5px 5px 5px; -moz-border-radius:5px 5px 5px 5px; border-radius:5px 5px 5px 5px; font-style:italic;">Prisspænd alle</div>

              <div clas="" style="font-size:0.8rem; font-style:italic; display:inline-block; margin-left:15px; text-align:center; background-color:#5CB75E; width:100px;">Behandler</div>
            </div>
          </div>
          
          <table class="table-striped tbl_result" style="font-size:0.9rem">
            <tr class="tr_result">
              <td style="font-weight:600;">Indgreb</td>
              <td style="font-weight:600;" align="center" class="">Fra</td>
              <td style="font-weight:600;" align="center" class="">Til</td>
              <td style="width:10px;"></td>
              <td style="font-weight:500; width:100px;">Pris indikator</td>
            </tr>
            <tr class="tr_result" ng-repeat="x in prices | filter: {sunheddk_id : i_sdkid}:true">
              <td class="">{{x.op_name}}</td>
              <td width="55" align="right" class="">{{x.price_from | number}}</td>
              <td width="55" align="right" class="">{{x.price_to  | number}}</td>
              <td></td>
              <td>
                <div clas="" style="position:relative; width:103px; border:1px solid #7A7A7A; height:12px; -webkit-border-radius:5px 5px 5px 5px; -moz-border-radius:5px 5px 5px 5px; border-radius:5px 5px 5px 5px;">
                  
                  <div clas="" style="background-color:#5CB75E; height:10px; margin-left:{{100*x.price_from/(x.MaxPriceTo-x.MaxPriceFrom)}}px; width:{{100*((x.price_to-x.price_from)/(x.MaxPriceTo-x.MaxPriceFrom))+3}}px;">
                  </div>
               </div>
              </td>
            </tr>
          </table>
        </div>
        
        <br><br><br><br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_edit_inst">
          Ret behandler data
        </button>
        <br><br><br><br>
  
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
        <!-- MODAL -->
        <div class="" id="modal_edit_inst">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Tilret behandler {{inst_id}} </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body" ng-init="practiceOptions(); cityOptions(); ownerOptions()">
                
                <form ng-submit="update_inst(inst_id, new_name, newPractice.id, new_street, newZip.zip_id, new_tel, new_email, new_web, newOwner.id)">
                  

                  <label>Navn ({{i_name}})</label>
                  <input type="text" ng-model="new_name" class="form-control">
                  

                  <label>Praksis kategori ({{p_id}})</label>                
                  <select class="form-control selectpicker" id="newPractice" ng-model="newPractice" ng-options="p as p.name for p in optionPractices track by p.id" required>
                  </select>

                  <label>Adresse ({{i_street}})</label>
                  <input type="text" class="form-control" ng-model="new_street" required>

                  <label>By ({{i_zip}})</label>
                  <select class="form-control selectpicker" id="newZip" ng-model="newZip" ng-options="c as c.city for c in optionCities track by c.zip_id">
                  </select>

                  <label>Telefon</label>
                  <input type="text" class="form-control" ng-model="new_tel">

                  <label>Email ({{i_mail}})</label>
                  <input type="text" class="form-control" ng-model="new_email">

                  <label>Hjemmeside</label>
                  <input type="text" class="form-control" ng-model="new_web">

                  <label>Ejerskab ({{i_owid}})</label>
                  <select class="form-control selectpicker" id="newOwner" ng-model="newOwner" ng-options="ownerOption as ownerOption.owner for ownerOption in optionOwners track by ownerOption.id" required>
                  </select>                  
                  
                  <br>
                  <input type="submit" class="btn btn-primary btn-block" value="Ret behandler">

                  </form>
                {{response}}


              <!-- Modal footer -->
              <div class="modal-footer">
                  
                <form ng-submit="delete_inst(inst_id)">
                  <input type="submit" class="btn btn-danger" value="Slet behandler">
                </form>

                <button type="button" class="btn btn-success" data-dismiss="modal">LUK</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
        
      </div>
      <!-- END LEFT COL -->

      <!-- RIGHT COL -->
      <div class="col-5">
        <div class="row">
          <div class="col-12 mt-3 py-3 ratings hp-box-shadow">
              <p>Udfyld og send din anmeldelse</p>
              <form ng-submit="rate()">
                  <input type="hidden" ng-model="inst_id">
                  <!-- RATING 1 -->
                  <div class="rating">
                      <div class="rating-name">
                          <span>Behandlingseffekt</span>
                      </div>
                      <div class="hearts">
                          <i class="fas fa-minus-circle minus1" ng-click="rating1 = 0"></i>
                          <label><input type="radio" name="rating1" ng-model="rating1" value="1" style="display:none;"><i class="fa fa-heart fa-heart1" data-index="0"></i></label>
                          <label><input type="radio" name="rating1" ng-model="rating1" value="2" style="display:none;"><i class="fa fa-heart fa-heart1" data-index="1"></i></label>
                          <label><input type="radio" name="rating1" ng-model="rating1" value="3" style="display:none;"><i class="fa fa-heart fa-heart1" data-index="2"></i></label>
                          <label><input type="radio" name="rating1" ng-model="rating1" value="4" style="display:none;"><i class="fa fa-heart fa-heart1" data-index="3"></i></label>
                          <label><input type="radio" name="rating1" ng-model="rating1" value="5" style="display:none;"><i class="fa fa-heart fa-heart1" data-index="4"></i></label>
                          <label><input type="radio" name="rating1" ng-model="rating1" value="6" style="display:none;"><i class="fa fa-heart fa-heart1" data-index="5"></i></label>
                          <label><input type="radio" name="rating1" ng-model="rating1" value="7" style="display:none;"><i class="fa fa-heart fa-heart1" data-index="6"></i></label>
                          <label><input type="radio" name="rating1" ng-model="rating1" value="8" style="display:none;"><i class="fa fa-heart fa-heart1" data-index="7"></i></label>
                          <label><input type="radio" name="rating1" ng-model="rating1" value="9" style="display:none;"><i class="fa fa-heart fa-heart1" data-index="8"></i></label>
                          <label><input type="radio" name="rating1" ng-model="rating1" value="10" style="display:none;"><i class="fa fa-heart fa-heart1" data-index="9"></i></label>
                      </div>
                      <span class="number" ng-if="rating1 > 0">{{rating1}}</span>
                  </div>

                  <!-- RATING 2 -->
                  <div class="rating">
                      <div class="rating-name">
                          <span>Faciliteter</span>
                      </div>
                      <div class="hearts">
                          <i class="fas fa-minus-circle minus2" ng-click="rating2 = 0"></i>
                          <label><input type="radio" name="rating2" ng-model="rating2" value="1" style="display:none;"><i class="fa fa-heart fa-heart2" data-index="0"></i></label>
                          <label><input type="radio" name="rating2" ng-model="rating2" value="2" style="display:none;"><i class="fa fa-heart fa-heart2" data-index="1"></i></label>
                          <label><input type="radio" name="rating2" ng-model="rating2" value="3" style="display:none;"><i class="fa fa-heart fa-heart2" data-index="2"></i></label>
                          <label><input type="radio" name="rating2" ng-model="rating2" value="4" style="display:none;"><i class="fa fa-heart fa-heart2" data-index="3"></i></label>
                          <label><input type="radio" name="rating2" ng-model="rating2" value="5" style="display:none;"><i class="fa fa-heart fa-heart2" data-index="4"></i></label>
                          <label><input type="radio" name="rating2" ng-model="rating2" value="6" style="display:none;"><i class="fa fa-heart fa-heart2" data-index="5"></i></label>
                          <label><input type="radio" name="rating2" ng-model="rating2" value="7" style="display:none;"><i class="fa fa-heart fa-heart2" data-index="6"></i></label>
                          <label><input type="radio" name="rating2" ng-model="rating2" value="8" style="display:none;"><i class="fa fa-heart fa-heart2" data-index="7"></i></label>
                          <label><input type="radio" name="rating2" ng-model="rating2" value="9" style="display:none;"><i class="fa fa-heart fa-heart2" data-index="8"></i></label>
                          <label><input type="radio" name="rating2" ng-model="rating2" value="10" style="display:none;"><i class="fa fa-heart fa-heart2" data-index="9"></i></label>
                      </div>
                      <span class="number" ng-if="rating2 > 0">{{rating2}}</span>
                  </div>

                  <!-- RATING 3 -->
                  <div class="rating">
                      <div class="rating-name">
                          <span>Hjælpsomhed</span>
                      </div>
                      <div class="hearts">
                          <i class="fas fa-minus-circle minus3" ng-click="rating3 = 0"></i>
                          <label><input type="radio" name="rating3" ng-model="rating3" value="1" style="display:none;"><i class="fa fa-heart fa-heart3" data-index="0"></i></label>
                          <label><input type="radio" name="rating3" ng-model="rating3" value="2" style="display:none;"><i class="fa fa-heart fa-heart3" data-index="1"></i></label>
                          <label><input type="radio" name="rating3" ng-model="rating3" value="3" style="display:none;"><i class="fa fa-heart fa-heart3" data-index="2"></i></label>
                          <label><input type="radio" name="rating3" ng-model="rating3" value="4" style="display:none;"><i class="fa fa-heart fa-heart3" data-index="3"></i></label>
                          <label><input type="radio" name="rating3" ng-model="rating3" value="5" style="display:none;"><i class="fa fa-heart fa-heart3" data-index="4"></i></label>
                          <label><input type="radio" name="rating3" ng-model="rating3" value="6" style="display:none;"><i class="fa fa-heart fa-heart3" data-index="5"></i></label>
                          <label><input type="radio" name="rating3" ng-model="rating3" value="7" style="display:none;"><i class="fa fa-heart fa-heart3" data-index="6"></i></label>
                          <label><input type="radio" name="rating3" ng-model="rating3" value="8" style="display:none;"><i class="fa fa-heart fa-heart3" data-index="7"></i></label>
                          <label><input type="radio" name="rating3" ng-model="rating3" value="9" style="display:none;"><i class="fa fa-heart fa-heart3" data-index="8"></i></label>
                          <label><input type="radio" name="rating3" ng-model="rating3" value="10" style="display:none;"><i class="fa fa-heart fa-heart3" data-index="9"></i></label>
                      </div>
                      <span class="number" ng-if="rating3 > 0">{{rating3}}</span>
                  </div>
                  <!-- RATING 4 -->
                  <div class="rating">
                      <div class="rating-name">
                          <span>Ventetid</span>
                      </div>
                      <div class="hearts">
                          <i class="fas fa-minus-circle minus4" ng-click="rating4 = 0"></i>
                          <label><input type="radio" name="rating4" ng-model="rating4" value="1" style="display:none;"><i class="fa fa-heart fa-heart4" data-index="0"></i></label>
                          <label><input type="radio" name="rating4" ng-model="rating4" value="2" style="display:none;"><i class="fa fa-heart fa-heart4" data-index="1"></i></label>
                          <label><input type="radio" name="rating4" ng-model="rating4" value="3" style="display:none;"><i class="fa fa-heart fa-heart4" data-index="2"></i></label>
                          <label><input type="radio" name="rating4" ng-model="rating4" value="4" style="display:none;"><i class="fa fa-heart fa-heart4" data-index="3"></i></label>
                          <label><input type="radio" name="rating4" ng-model="rating4" value="5" style="display:none;"><i class="fa fa-heart fa-heart4" data-index="4"></i></label>
                          <label><input type="radio" name="rating4" ng-model="rating4" value="6" style="display:none;"><i class="fa fa-heart fa-heart4" data-index="5"></i></label>
                          <label><input type="radio" name="rating4" ng-model="rating4" value="7" style="display:none;"><i class="fa fa-heart fa-heart4" data-index="6"></i></label>
                          <label><input type="radio" name="rating4" ng-model="rating4" value="8" style="display:none;"><i class="fa fa-heart fa-heart4" data-index="7"></i></label>
                          <label><input type="radio" name="rating4" ng-model="rating4" value="9" style="display:none;"><i class="fa fa-heart fa-heart4" data-index="8"></i></label>
                          <label><input type="radio" name="rating4" ng-model="rating4" value="10" style="display:none;"><i class="fa fa-heart fa-heart4" data-index="9"></i></label>
                      </div>
                      <span class="number" ng-if="rating4 > 0">{{rating4}}</span>
                  </div>
                  <!-- RATING 5 -->
                  <div class="rating">
                      <div class="rating-name">
                          <span>Samlede oplevelse</span>
                      </div>
                      <div class="hearts">
                          <i class="fas fa-minus-circle minus5" ng-click="rating5 = 0"></i>
                          <label><input type="radio" name="rating5" ng-model="rating5" value="1" style="display:none;"><i class="fa fa-heart fa-heart5" data-index="0"></i></label>
                          <label><input type="radio" name="rating5" ng-model="rating5" value="2" style="display:none;"><i class="fa fa-heart fa-heart5" data-index="1"></i></label>
                          <label><input type="radio" name="rating5" ng-model="rating5" value="3" style="display:none;"><i class="fa fa-heart fa-heart5" data-index="2"></i></label>
                          <label><input type="radio" name="rating5" ng-model="rating5" value="4" style="display:none;"><i class="fa fa-heart fa-heart5" data-index="3"></i></label>
                          <label><input type="radio" name="rating5" ng-model="rating5" value="5" style="display:none;"><i class="fa fa-heart fa-heart5" data-index="4"></i></label>
                          <label><input type="radio" name="rating5" ng-model="rating5" value="6" style="display:none;"><i class="fa fa-heart fa-heart5" data-index="5"></i></label>
                          <label><input type="radio" name="rating5" ng-model="rating5" value="7" style="display:none;"><i class="fa fa-heart fa-heart5" data-index="6"></i></label>
                          <label><input type="radio" name="rating5" ng-model="rating5" value="8" style="display:none;"><i class="fa fa-heart fa-heart5" data-index="7"></i></label>
                          <label><input type="radio" name="rating5" ng-model="rating5" value="9" style="display:none;"><i class="fa fa-heart fa-heart5" data-index="8"></i></label>
                          <label><input type="radio" name="rating5" ng-model="rating5" value="10" style="display:none;"><i class="fa fa-heart fa-heart5" data-index="9"></i></label>
                      </div>
                      <span class="number" ng-if="rating5 > 0">{{rating5}}</span>
                  </div>

                  <div class="rating_textarea">
                      <textarea name="rating_text" ng-model="rating_text" placeholder="Skriv om dine oplevelser her..."></textarea>
                  </div>

                  <input type="submit" class="btn btn-info rate-btn" value="Send anmeldelse">
              </form>			
              <div id="result"></div>

              <!-- LOG IN TO RATE -->
              <div class="logIn2Rate" ng-show="logged === 0" ng-init="signup = false">
                  <span><strong>Du skal være logget ind for at skrive en anmeldelse.</strong></span>

                  <!-- login -->
                  <div class="login" ng-show="signup === false">
                      <form ng-submit="logonEmail()">
                          <label for="login_email">Email</label>
                          <input type="email" class="form-control" id="login_email" placeholder="Din email" ng-model="email">
                          <label for="login_password">Password</label>
                          <input type="password" class="form-control" id="login_password" placeholder="Password" ng-model="password">
                          <button type="submit" class="btn btn-primary mt-3">Log ind med email</button>
                      </form>
                      <a href="#" ng-click="signup = true">Endnu ikke medlem? Klik her</a>
                  </div>

                  <!-- signup -->
                  <div class="signup" ng-show="signup === true">
                      <span><strong>Tilmeld dig nemt og gratis på 20 sekunder.</strong></span>
                      <form ng-submit="create_user()">
                          <div class="form-group">
                              <label for="r_name">Navn</label>
                              <input type="text" class="form-control" id="r_name" placeholder="Dit fulde navn" ng-model="name">
                          </div>
                          <div class="form-group">
                              <label for="r_email">Email</label>
                              <input type="email" class="form-control" id="r_email" placeholder="Din email" ng-model="email">
                          </div>
                          <div class="form-group">
                              <label for="r_password">Password</label>
                              <input type="password" class="form-control" id="r_password" placeholder="Password" ng-model="password">
                          </div>
                          <div class="form-group">
                              <label for="r_password">Gentag password</label>
                              <input type="password" class="form-control" id="r_password" placeholder="Password" ng-model="passwordrepeat">
                          </div>
                          <button type="submit" class="btn btn-primary">Tilmeld dig</button>
                      </form>
                      <a href ng-click="signup = false">Er du allerede medlem?</a>
                  </div>
                  <div class="p-3 alert alert-success">
                  {{server_msg}}
                  </div>
              </div>
            
          </div>
          <br><br> 

          <div class="hp-header mt-4 mb-3">
            Alle brugeranmeldelser
          </div>

          <div class="mb-3 comment hp-box" ng-repeat="c in comments | filter: inst_id">

            <div class="px-3 py-1 comment-top">
              <div class="row">
                <div class="col-2 comment-meta"><img src="../uploads/{{c.user_img}}" class="comment-img"></div>
                <div class="col-10 comment-meta">{{c.user_name}}<br>{{c.comment_rate_time}}</div>
              </div>
            </div>
            <div class="px-3 py-2 comment-rating" style="border-bottom:1px solid #eeeeee;">
              <div ng-repeat="hs in user_avg_total_score | filter: {i_id : inst_id}:true | filter: {user_id : c.comment_user_id}:true ">
                <div class="comment-rate">Samlet score</div>
                  <div class="comment-hearts">
                  <div class="health_scores_hearts">
                    <i class="fa fa-heart avg_1" ng-if="hs.rating >= 0.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="hs.rating >= 1.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="hs.rating >= 2.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="hs.rating >= 3.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="hs.rating >= 4.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="hs.rating >= 5.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="hs.rating >= 6.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="hs.rating >= 7.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="hs.rating >= 8.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="hs.rating >= 9.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="hs.rating < 0.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="hs.rating < 1.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="hs.rating < 2.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="hs.rating < 3.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="hs.rating < 4.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="hs.rating < 5.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="hs.rating < 6.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="hs.rating < 7.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="hs.rating < 8.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="hs.rating < 9.5"></i>
                  </div>
                  <div class="comment-value">
                    <img src="../images/icons-png/carat-d-black.png" width="14" height="14" style="cursor:pointer; display:{{displayDwn}};" title="Vis score på alle kategorier" ng-click="changeDwn()">
                    <img style="cursor:pointer; display:{{displayUp}};"  ng-click="changeUp()" src="../images/icons-png/carat-u-black.png" width="14" height="14">
                  </div>
                </div>
              </div>
            </div>

            <div class="p-3 comment-rating" style="display:{{displayUp}}">
              <div ng-repeat="x in ratings | filter: {i_id: inst_id}:true | filter: {user_id: c.comment_user_id}:true ">
                <div class="comment-rate">{{x.name}}</div>
                <div class="comment-hearts">
                  <div class="health_scores_hearts">
                    <i class="fa fa-heart avg_1" ng-if="x.rating >= 0.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="x.rating >= 1.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="x.rating >= 2.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="x.rating >= 3.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="x.rating >= 4.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="x.rating >= 5.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="x.rating >= 6.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="x.rating >= 7.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="x.rating >= 8.5"></i>
                    <i class="fa fa-heart avg_1" ng-if="x.rating >= 9.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="x.rating < 0.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="x.rating < 1.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="x.rating < 2.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="x.rating < 3.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="x.rating < 4.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="x.rating < 5.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="x.rating < 6.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="x.rating < 7.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="x.rating < 8.5"></i>
                    <i class="fa fa-heart avg_0" ng-if="x.rating < 9.5"></i>
                  </div>
                  <div class="comment-value">{{x.rating}}</div>
                </div>
              </div>
            </div>
            <div class="p-3 comment-info">{{c.comment_text}}</div>

          </div>
        </div>

      </div><!-- col -->
  </div><!-- row -->
</div><!-- container -->  



