<!DOCTYPE html>
<html lang="da">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Healthpilot</title>
        <link rel="icon" href="images/logo02.png">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


        <!-- jQuery CSS -->			
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Bootstrap CSS -->
        <link href="includes/css/bootstrap-4.3.1.css" rel="stylesheet" type="text/css"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- custom css -->
        <link href="includes/css/style.css" rel="stylesheet" type="text/css"/>

        <!-- font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

        <script src="includes/js/jquery-3.4.1.js"></script>

        <!-- angularjs -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>		
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular-route.js"></script>

        <!--        
                <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.js"></script>
        -->
        <!-- angular dirPagination -->
        <script src="includes/js/dirPagination.js"></script>

        <!-- angular app -->
        <script src="includes/js/app.js"></script>

        <!-- angular controllers -->
        <script src="includes/js/controller.js"></script>

        <!-- angular european formatting -->    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.6.0/angular-locale_de-de.js"></script>


        <script src="http://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.0.1/lodash.js" type="text/javascript"></script>


        <!-- google map -->
        <script src="https://rawgit.com/allenhwkim/angularjs-google-maps/master/build/scripts/ng-map.js"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAn-NhOxh0jPs-CNVQhOinA03BpYzsHo9s"></script>
        <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAn-NhOxh0jPs-CNVQhOinA03BpYzsHo9s&callback=lazyLoadCallback"></script>-->

        <!--        
                <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAn-NhOxh0jPs-CNVQhOinA03BpYzsHo9s&callback=initMap"></script>
                <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAn-NhOxh0jPs-CNVQhOinA03BpYzsHo9s&sensor=false&extension=.js"></script>
        -->

    </head>

    <body ng-app="sa_app">
        <div ng-controller="mainCtrl">

            <div class="thetop"></div>
            <div class="sticky-top container-fluid header-row no-gutters p-0 bg-header">
                <nav class="navbar navbar-expand-sm navbar-dark">
                    <div class="container">
                        <a class="navbar-brand" href="#forside"><img src="images/healthpilot.png" width="300" alt="Healthpilot"/></a>
                        <div id="navbarNav" ng-controller="navCtrl">
                            <!-- nav -->
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href= "#forside">Forside</a> 
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href= "#om-os">Om os</a> 
                                </li>

                                <!-- Kategorier -->
                                <li class="nav-item dropdown" ng-init="practiceOptions()">
                                    <a class="nav-link" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategorier</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a ng-repeat="x in optionPractices" class="dropdown-item" href= "#{{x.p_name}}">{{x.p_name}}</a>
                                    </div>
                                </li>

                                <!-- NOT LOGGED -->
                                <li class="nav-item" ng-if="!getUserId()">
                                    <a class="nav-link" href="#login"><i class="fas fa-user-not"></i>Log ind</a> 
                                </li>

                                <!--BRUGER dropdown--> 
                                <li class="nav-item dropdown" ng-if="getUserRoleId() == 3">
                                    <a class="nav-link nav-link-img" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="my-img" src="{{getUserImg()}}">
                                        <div class="my-name">{{getUserName()}}</div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href= "#min-konto">Min konto</a>
                                        <a class="dropdown-item" ng-click="logOut()" href="#">Log ud</a>
                                </li>

                                <!--BEHANDLER dropdown--> 
                                <li class="nav-item dropdown" ng-if="getUserRoleId() == 2">
                                    <a class="nav-link nav-link-img" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="my-img" src="{{getUserImg()}}">
                                        <div class="my-name">{{getUserName()}}</div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href= "#klinik">Min klinik</a> 
                                        <div class="dropdown-divider"></div> 
                                        <a class="dropdown-item" href= "#min-konto">Min konto</a>
                                        <a class="dropdown-item" ng-click="logOut()" href="#">Log ud</a>
                                </li>

                                <!--ADMIN dropdown--> 
                                <li class='nav-item dropdown' ng-if="getUserRoleId() == 1">
                                    <a class='nav-link nav-link-img' href='' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <img class="my-img" src="{{getUserImg()}}">
                                        <div class='my-name'>{{getUserName()}}</div>
                                    </a>
                                    <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                        <a class='dropdown-item' href= '#search'>Behandler oversigt</a> 
                                        <div class='dropdown-divider'></div> 
                                        <a class='dropdown-item' href= '#admin-i'>Admin behandlere</a>
                                        <a class='dropdown-item' href= '#admin-u'>Admin brugere</a>
                                        <a class='dropdown-item' href= '#admin-p'>Admin kategorier</a>
                                        <div class='dropdown-divider'></div> 
                                        <a class='dropdown-item' href='#min-konto'>Min konto</a>
                                        <a class='dropdown-item' ng-click="logOut()" href='#'>Log ud</a>
                                    </div>
                                </li>
                            </ul>
                            <!-- /nav -->
                        </div>
                    </div>
                </nav>		
            </div>		

            <!-- view -->
            <div ng-view autoscroll="true"></div>

            <!-- footer -->
            <footer class="footerback">
                <div class="container-fluid footer pt-2">
                    <div class="container">
                        <div class="col-12">
                            <p>Copyright © Healthpilot - All rights reserved</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>