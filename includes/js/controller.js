/////////////////////
//App.directive

// Create markers after render
app.directive('onFinishRender', function ($timeout) {
    return {
        restrict: 'A',
        link: function (scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function () {
                    scope.$emit('ngRepeatFinished');
                });
            }
        }
    }
});

//File upload
app.directive("fileInput", function ($parse) {
    return{
        link: function ($scope, element, attrs) {
            element.on("change", function (event) {
                var files = event.target.files;
                //console.log(files[0].name);  
                $parse(attrs.fileInput).assign($scope, element[0].files);
                $scope.$apply();
            });
        }
    }
});

/////////////////////
//App.run // Get user if logged 
angular.module("sa_app").run(['$rootScope', '$location', function ($rootScope, $location) {

        //Redirect to HTTPS
        if (window.location.protocol == "http:") {
            window.location = document.URL.replace("http://", "https://");
        }

        //Get client location
//        AIzaSyB1k5SC29hxlgaYFAVTeKx9yS7iPNUjUTI

        //Get user id
        var id = false;
        $rootScope.getUserId = function () {
            if (!id)
                id = localStorage.getItem('id');
            return id;
        };

        //Get access token
        var access_token = false;
        $rootScope.getAccessToken = function () {
            if (!access_token)
                access_token = localStorage.getItem('access_token');
            return access_token;
        };

        //Get facebook id
        var fb_id = false;
        $rootScope.getFbId = function () {
            if (!fb_id)
                fb_id = localStorage.getItem('fb_id');
            return fb_id;
        };

        //Get user name
        var name = false;
        $rootScope.getUserName = function () {
            if (!name)
                name = localStorage.getItem('name');
            return name;
        };

        //Get user e-mail
        var email = false;
        $rootScope.getUserEmail = function () {
            if (!email)
                email = localStorage.getItem('email');
            return email;
        };

        //Get user role_id
        var role_id = false;
        $rootScope.getUserRoleId = function () {
            if (!role_id)
                role_id = localStorage.getItem('role_id');
            return role_id;
        };

        //Get user img
        var img = false;
        $rootScope.getUserImg = function () {
            img = localStorage.getItem('img');
            if (img === 'null') {
                return 'https://avatars.io/facebook/' + $rootScope.getFbId() + '/medium';
            } else {
                return 'uploads/' + img;
            }
        };

        //Redirect unlogged
        $rootScope.redirUnlogged = function () {
            role_id = localStorage.getItem('role_id');
            if (!role_id)
                $location.path('forside');
        };

        //Redirect unauthorized admin page visitors
        $rootScope.redirAdmin = function () {
            role_id = localStorage.getItem('role_id');
            if (role_id < 2)
                $location.path('forside');
        };

        //Log off
        $rootScope.logOut = function () {
            FB.logout($rootScope.getAccessToken);
            localStorage.removeItem('id');
            localStorage.removeItem('access_token');
            localStorage.removeItem('fb_id');
            localStorage.removeItem('email');
            localStorage.removeItem('name');
            localStorage.removeItem('role_id');
            localStorage.removeItem('img');
            window.location.reload();
        };
    }]);

///////////////////
// nav controller
app.controller("navCtrl", ['$scope', '$location', function ($scope, $location) {

        //Get location for active nav links
        $scope.getLocation = function () {
            return $scope.location = $location.path();
        };

    }]);



///////////////////
//Main controller
app.controller("mainCtrl", function ($scope, $http, NgMap) {


//    $scope.searchNumbers = [{value: 10}, {value: 20}, {value: 50}];
    $scope.searchNumber = 10;


    //display institution search
    $scope.show_results = function () {
        $scope.$emit('LOAD'); // spinner
        $scope.results = [];
        $http.get("handlers/search_ajax.php")
                .success(function (data) {
                    $scope.$emit('UNLOAD'); // spinner
                    $scope.results = data;
                });
    };

    $scope.sortKey = 'i_name'; // column to sort default
    $scope.reverse = false; // sort ordering default
    $scope.sort = function (keyname) {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };
    $scope.class = function (keyname) {
        if ($scope.sortKey == keyname) {
            return $scope.reverse ? 'arrow-down' : 'arrow-up' // toggle arrow up/down
        }
        return '';
    };


    //Center map on ng-repeat hover
//    $scope.center = "Danmark";
//    $scope.setCenter = function(lat, lng){
//        $scope.center = lat + ", " + lng;
//    };

    $scope.$on('ngRepeatFinished', function (ngRepeatFinishedEvent) {
        // Get data as needed of each filtered result and push to array as an object
        $scope.positions = [];

        for (i = 0; i < $scope.filtered_results.length; i++) {
            var obj = {
                i_id: $scope.filtered_results[i]['i_id'],
                i_name: $scope.filtered_results[i]['i_name'],
                i_street: $scope.filtered_results[i]['i_street'],
                p_name: $scope.filtered_results[i]['p_name'],
                zip_id: $scope.filtered_results[i]['zip_id'],
                c_name: $scope.filtered_results[i]['c_name'],
                s_avg: $scope.filtered_results[i]['s_avg'],
                pos: [parseFloat($scope.filtered_results[i]['lat']), parseFloat($scope.filtered_results[i]['lng'])],
                animation: "DROP"
            };
            $scope.positions.push(obj);
        }

    });

    //If filtered results is empty, center client position
    $scope.$watch('filtered_results.length', function () {
        if ($scope.filtered_results.length < 1) {
            $scope.positions = [];
            NgMap.getMap().then(function (map) {
                map.setZoom(14);
            });
        }
    });

    //Make marker bounce on ng-repeat mouseover
    $scope.makeBounce = function (index) {
        $scope.positions[index]['animation'] = "BOUNCE";
    };
    //Make marker stop bounce on ng-repeat mouseleave
    $scope.stopBounce = function (index) {
        $scope.positions[index]['animation'] = "none";
    };


    // Select markers within boundaries
    $scope.positionsWithinBounds = angular.copy($scope.positions);

    var analyzeViewableMarkers = function (map) {
        var ne = map.getBounds().getNorthEast();
        var sw = map.getBounds().getSouthWest();

        var latBounds = {
            top: ne.lat(),
            bottom: sw.lat()
        };

        var lonBounds = {
            left: sw.lng(),
            right: ne.lng()
        };

        $scope.positionsWithinBounds = angular.copy(
                $scope.positions.filter(function (pos) {
                    var liesWithinLatBounds = latBounds.top >= pos.pos[0] && latBounds.bottom <= pos.pos[0];
                    var liesWithinLonBounds = lonBounds.left <= pos.pos[1] && lonBounds.right >= pos.pos[1];

                    return liesWithinLatBounds && liesWithinLonBounds;
                })
                );

        // for some reason the $digest cycle doesn't catch changes to $scope.viewablePositions
        // trigger it manually
        $scope.$apply();
    };
    // Analyze map when boundaries change **causes lag to map**
//    NgMap.getMap().then(function (map) {
//        $scope.map = map;
//        google.maps.event.addListener(map, 'bounds_changed', function () {
//            analyzeViewableMarkers(map);
//        });
//    });

    //Analyze without map lag
    NgMap.getMap().then(function (map) {
        $scope.map = map;
        var timeout;
        google.maps.event.addListener(map, 'bounds_changed', function () {
            window.clearTimeout(timeout);
            timeout = window.setTimeout(function () {
                //do stuff on event
                analyzeViewableMarkers(map);
            }, 175);
        });
    });

    // Update markers on searchNumber change
    $scope.updateMarkers = function (searchNumber) {
        $scope.positions = [];
        for (i = 0; i < searchNumber; i++) {
            var obj = {
                i_id: $scope.filtered_results[i]['i_id'],
                i_name: $scope.filtered_results[i]['i_name'],
                i_street: $scope.filtered_results[i]['i_street'],
                p_name: $scope.filtered_results[i]['p_name'],
                zip_id: $scope.filtered_results[i]['zip_id'],
                c_name: $scope.filtered_results[i]['c_name'],
                s_avg: $scope.filtered_results[i]['s_avg'],
                pos: [parseFloat($scope.filtered_results[i]['lat']), parseFloat($scope.filtered_results[i]['lng'])],
                animation: "DROP"
            };
            $scope.positions.push(obj);
        }
    };

    $scope.searchFilter = function (x) {
        var regex = new RegExp(x.c_name + '\s*$', "g");
        if (!$scope.searchQuery) {
            return true;
        }
        if ($scope.searchQuery.match(regex) || x.zip_id == $scope.searchQuery) {
//        if ($scope.searchQuery == x.zip_id || angular.lowercase($scope.searchQuery) == angular.lowercase(x.c_name)) {
            return true;
        }

        return false;
    };



    //Make marker bounce on ng-repeat mouseover
    $scope.makeBounce = function (id) {
        for (i = 0; i < $scope.filtered_results.length; i++) {
            if ($scope.positions[i]['i_id'] === id) {
                $scope.positions[i]['animation'] = "BOUNCE";
            } else {
                $scope.positions[i]['animation'] = "none";
            }
        }
    };
    //Make marker stop bounce on ng-repeat mouseleave
    $scope.stopBounce = function (id) {
        for (i = 0; i < $scope.filtered_results.length; i++) {
            if ($scope.positions[i]['i_id'] === id) {
                $scope.positions[i]['animation'] = "none";
            }
        }
    };

    //Show NgMap info window
    $scope.showInfo = function (event, inst) {
        $scope.selectedInst = inst;
        $scope.map.showInfoWindow('myInfoWindow', this);
    };
    //Hide NgMap info window
    $scope.hideInfo = function () {
        $scope.map.hideInfoWindow('myInfoWindow', this);
    };

    //Show practice delete
    $scope.displaySearch = 'display:none;';
    $scope.changeSearchBlock = function () {
        $scope.displaySearch = 'display:block;';
    };

    //Clear institution search
    $scope.clear_search = function () {
        $scope.search = "";
        $scope.displaySearch = 'display:none;'
        document.getElementById("searchText").focus();
    };

    //City search
    $scope.search_current_city = function () {
        $scope.selectedCity = $scope.user_city;
    };

    //City delete
    $scope.displayCity = 'display:none;';
    $scope.changeCityBlock = function () {
        $scope.displayCity = 'display:block;';
    };

    //Clear city search
    $scope.clear_city_search = function () {
        $scope.searchCity = "";
        $scope.displayCity = 'display:none;'
        document.getElementById("searchCity").focus();
    };

    //display active practice options
    $scope.practiceOptions = function () {
        $http.get("handlers/search_practices.php")
                .success(function (data) {
                    $scope.optionPractices = data;
                });
    };

    //Show practice delete
    $scope.displayPractice = 'display:none;';
    $scope.changePracticeBlock = function () {
        $scope.displayPractice = 'display:block;';
    };

    //Clear practice filter
    $scope.clear_practice_search = function () {
        $scope.selectedPractice = "";
        $scope.displayPractice = 'display:none;'
        document.getElementById("selectedPractice").focus();
    };

    //get instutions with highest scores
    $scope.show_highscore_institutions = function () {
        $http.get("handlers/get_inst_highscore.php")
                .success(function (data) {
                    $scope.highscoreInst = data;
                });
    };

    //display city options
    $scope.cityOptions = function () {
        $http.get("handlers/all_cities.php")
                .success(function (data) {
                    $scope.optionCities = data;
                });
    };

    //display owner options
    $scope.ownerOptions = function () {
        $http.get("handlers/all_owners.php")
                .success(function (data) {
                    $scope.optionOwners = data;
                });
    };

});

/////////////////////
//Filter
app.filter('cityOrZip', function () {
    return function (insts, search) {
        if (angular.isDefined(search)) {
            var filterResults = [];
            var i;
            var searchVal = angular.lowercase(search);
            for (i = 0; i < insts.length; i++) {
                var city = insts[i].angular.lowercase(city);
                var zip = insts[i].parseFloat(zip);
                if (city.indexOf(searchVal) != -1 || zip.indexOf(searchVal) != -1) {
                    filterResults.push(insts[i]);
                }
            }
            return filterResults;
        } else {
            return insts;
        }
    };
});

////////////////////
//Login controller
app.controller("loginCtrl", function ($scope, $location, $http, $rootScope, $window) {

    //Opret bruger
    $scope.create_user = function () {
        if ($scope.password != $scope.passwordrepeat) {
            alert("Passwords matcher ikke. Prøv igen.");
        } else {
            //insert
            $http.post(
                    "handlers/create_user.php", {
                        'name': $scope.name,
                        'email': $scope.email,
                        'password': $scope.password
                    }
            ).success(function (data) {
                $scope.name = "";
                $scope.email = "";
                $scope.password = "";
                $scope.passwordrepeat = "";
                $scope.server_msg = "Velkommen hos HealthPilot!";
            });
        }
    };

    //Log ind
    $scope.logonEmail = function () {
        $http.post(
                "handlers/logon.php", {
                    'email': $scope.email,
                    'password': $scope.password
                }
        ).success(function (data) {
            $rootScope.user_data = data;
            if ($rootScope.user_data != 0) { //If login was successful
                $location.path('forside');
                $scope.user_id = $rootScope.user_data[0]['id'];
                $scope.fb_id = $rootScope.user_data[0]['fb_id'];
                $scope.name = $rootScope.user_data[0]['name'];
                $scope.role_id = $rootScope.user_data[0]['role_id'];
                $scope.img = $rootScope.user_data[0]['img'];

                $window.localStorage.setItem("id", $scope.user_id);
                $window.localStorage.setItem("fb_id", $scope.fb_id);
                $window.localStorage.setItem("name", $scope.name);
                $window.localStorage.setItem("email", $scope.email);
                $window.localStorage.setItem("role_id", $scope.role_id);
                $window.localStorage.setItem("img", $scope.img);
            } else { //If login failed
                $scope.server_msg = "Forkert e-mail eller password.";
            }
        });
    };

    //Facebook login
    $scope.logonFacebook = function () {

        FB.login(function (response) {
            if (response.authResponse) {
                $scope.fbAccessToken = FB.getAuthResponse().accessToken;
                FB.api('/me', {
                    fields: 'email,name',
                    access_token: $scope.fbAccessToken
                }, function (response) {

                    $scope.fbResponse = response;
                    var fbId = response.id;
                    var fbName = response.name;
                    var fbEmail = response.email;

                    $http.post(
                            "handlers/facebook_logon.php", {
                                'id': fbId,
                                'name': fbName,
                                'email': fbEmail
                            }
                    ).success(function (data) {
                        //do something
                        $scope.fbLoginResponse = data;
                        $location.path('forside');
                        $scope.user_id = $scope.fbLoginResponse[0]['id'];
                        $scope.fb_id = $scope.fbLoginResponse[0]['fb_id'];
                        $scope.name = $scope.fbLoginResponse[0]['name'];
                        $scope.email = $scope.fbLoginResponse[0]['email'];
                        $scope.role_id = $scope.fbLoginResponse[0]['role_id'];
                        $scope.img = $scope.fbLoginResponse[0]['img'];

                        $window.localStorage.setItem("id", $scope.user_id);
                        $window.localStorage.setItem("fb_id", $scope.fb_id);
                        $window.localStorage.setItem("name", $scope.name);
                        $window.localStorage.setItem("email", $scope.email);
                        $window.localStorage.setItem("role_id", $scope.role_id);
                        $window.localStorage.setItem("img", $scope.img);
                        $window.localStorage.setItem("access_token", fbAccessToken);
                    });

                });

            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {scope: 'email'});
    };
});

////////////////////
//Min-konto controller
app.controller("kontoCtrl", function ($scope, $rootScope, $http, $window) {

    //Get file name
    $scope.setFile = function (element) {
        $scope.$apply(function ($scope) {
            $scope.theFile = element.files[0];
        });
    };

    //User update
    $scope.updateUser = function (id, newName, newPassword, newEmail, newRole) {
        var form_data = new FormData();
        form_data.append('id', id);
        form_data.append('newName', newName);
        form_data.append('newPassword', newPassword);
        form_data.append('newEmail', newEmail);
        form_data.append('newRole', newRole);

        angular.forEach($scope.files, function (file) {
            form_data.append('file', file);
        });

        $http.post('handlers/user_update.php',
                form_data,
                {transformRequest: angular.identity, headers: {'Content-Type': undefined, 'Process-Data': false}}
        ).success(function (response) {
            $scope.response = response;

            //Reset password and file input
            $scope.newPassword = "";
            var fileElement = angular.element('#imageUpload');
            angular.element(fileElement).val(null);

            //Update user name
            $window.localStorage.setItem("name", newName);
            var name = false;
            $rootScope.getUserName = function () {
                if (!name)
                    name = localStorage.getItem('name');
                return name;
            };
            //Update user e-mail
            $window.localStorage.setItem("email", newEmail);
            var email = false;
            $rootScope.getUserEmail = function () {
                if (!email)
                    email = localStorage.getItem('email');
                return email;
            };
            //Get user img
            $window.localStorage.setItem("img", $scope.theFile.name);
            var img = false;

            //Get user img
            var img = false;
            $rootScope.getUserImg = function () {
                img = localStorage.getItem('img');
                if (img === 'null') {
                    return 'https://avatars.io/facebook/' + $rootScope.getFbId() + '/medium';
                } else {
                    return 'uploads/' + img;
                }
            };
        });
    };

    //display all specific user ratings
    $scope.show_results = function () {
        $scope.results = [];
        $http.get("handlers/all_user_ratings.php")
                .success(function (data) {
                    $scope.results = data;
                    $scope.sortKey = 'i_name'; // column to sort default
                    $scope.reverse = false; // sort ordering default

                    $scope.sort = function (keyname) {
                        $scope.sortKey = keyname;   //set the sortKey to the param passed
                        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
                    };

                    $scope.class = function (keyname) {
                        if ($scope.sortKey == keyname) {
                            return $scope.reverse ? 'arrow-down' : 'arrow-up' // toggle arrow up/down
                        }
                        return '';
                    }
                });
    };

    //display user avg-ratings on specific institution
    $scope.getUser_avg_scores = function () {
        $http.get("handlers/user_avg_scores.php")
                .success(function (data) {
                    $scope.user_avg_scores = data;
                });
    };

    //Connect to facebook
    $scope.fbConnect = function (user_id) {
        FB.login(function (response) {
            if (response.authResponse) {
                FB.api('/me?fields=id,name,email', function (response) {

                    console.log(response);
                    var fb_id = response.id;
                    var fbAccessToken = FB.getAuthResponse().accessToken;

                    $http.post(
                            "handlers/facebook_connect.php", {
                                'id': user_id,
                                'fb_id': fb_id
                            }
                    ).success(function (data) {
                        //do something
                        $scope.fbConnectResponse = data;
                        $window.localStorage.setItem("access_token", fbAccessToken);
                        $window.localStorage.setItem("fb_id", fb_id);

                        $rootScope.getAccessToken = function () {
                            if (!access_token)
                                access_token = localStorage.getItem('access_token');
                            return access_token;
                        };

                        $rootScope.getFbId = function () {
                            if (!fb_id)
                                fb_id = localStorage.getItem('fb_id');
                            return fb_id;
                        };
                    });

                });

            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        });
    };

});

////////////////////
//Admin users controller
app.controller("usersCtrl", function ($scope, $http) {

    //display user options
    $scope.userOptions = function () {
        $http.get("handlers/user_options.php")
                .success(function (data) {
                    $scope.optionUsers = data;
                });
    };

    //display role options
    $scope.roleOptions = function () {
        $http.get("handlers/all_roles.php")
                .success(function (data) {
                    $scope.optionRoles = data;
                });
    };

    //display user search results
    $scope.select_user = function () {
        $http.post("handlers/select_user.php", {
            'id': $scope.searchUsers.id
        }
        ).success(function (data) {
            //do something
            $scope.user_data = data;
            $scope.selected_user_id = $scope.user_data[0]['id'];
            $scope.selected_name = $scope.user_data[0]['name'];
            $scope.selected_email = $scope.user_data[0]['email'];
            $scope.selected_role_id = $scope.user_data[0]['role_id'];
            $scope.selected_img = $scope.user_data[0]['img'];
            $scope.selected_fbId = $scope.user_data[0]['fb_id'];
            $scope.userId = $scope.selected_user_id;
            $scope.newName = $scope.selected_name;
            $scope.newEmail = $scope.selected_email;

            $scope.newRole = $scope.optionRoles[$scope.selected_role_id - 1];
        });
    };

    //Insert user
    $scope.create_user = function () {
        if ($scope.password != $scope.passwordrepeat) {
            alert("Passwords matcher ikke. Prøv igen.");
        } else {
            //insert
            $http.post("handlers/create_user.php", {
                'name': $scope.name,
                'email': $scope.email,
                'password': $scope.password
            }
            ).success(function (new_id) {
                //do something
                $scope.response = new_id;
                $scope.insert_response = "'" + $scope.name + "' er nu oprettet i databasen. ID = " + $scope.response;
                $scope.name = "";
                $scope.email = "";
                $scope.password = "";
                $scope.passwordrepeat = "";
                $scope.userOptions();
            });
        }
    };

    //Update user
    $scope.updateUser = function (id, newName, newPassword, newEmail, newRole) {
        var form_data = new FormData();
        form_data.append('id', id);
        form_data.append('newName', newName);
        form_data.append('newPassword', newPassword);
        form_data.append('newEmail', newEmail);
        form_data.append('newRole', newRole);

        angular.forEach($scope.files, function (file) {
            form_data.append('file', file);
        });

        $http.post(
                "handlers/user_update.php",
                form_data,
                {transformRequest: angular.identity, headers: {'Content-Type': undefined, 'Process-Data': false}}
        ).success(function (update_msg) {
            $scope.update_response = update_msg;

            //Reset password and file input
            $scope.newPassword = "";
            var imgFile = angular.element('#newImage');
            angular.element(imgFile).val(null);
            $scope.select_user();
            $scope.userOptions();
            $scope.roleOptions();
        });

    };

    //Delete user
    $scope.delete_user = function (id) {
        $http.post("handlers/delete_user.php", {
            'id': id,
        }
        ).success(function (response) {
            //do something
            $scope.delete_response = response;
            $scope.delete_msg = "Bruger er slettet!";
            $scope.select_user();
            $scope.userOptions();
        });
    };
});


////////////////////
//Admin institutions controller
app.controller("instiCtrl", function ($scope, $http) {

    //display practice options
    $scope.practiceOptions = function () {
        $http.get("handlers/all_practices.php")
                .success(function (data) {
                    $scope.optionPractices = data;
                });
    };

    //display city options
    $scope.cityOptions = function () {
        $http.get("handlers/all_cities.php")
                .success(function (data) {
                    $scope.optionCities = data;
                });
    };

    //display owner options
    $scope.ownerOptions = function () {
        $http.get("handlers/all_owners.php")
                .success(function (data) {
                    $scope.optionOwners = data;
                });
    };

    //Insert institution
    $scope.create_inst = function () {
        //insert
        $http.post("handlers/create_inst.php", {
            'name': $scope.name,
            'zip_id': $scope.zip_id,
            'practice_id': $scope.practice_id,
            'tel': $scope.tel,
            'email': $scope.email,
            'street': $scope.street,
            'web': $scope.web,
            'owner_id': $scope.owner_id
        }).success(function (response) {
            //do something
            $scope.response = response;
            $scope.show_inst();
            $scope.instOptions();

            $scope.create_msg = "'" + $scope.name + "' er nu oprettet i databasen";
            $scope.name = "";
            $scope.zip_id = "";
            $scope.practice_id = "";
            $scope.tel = "";
            $scope.email = "";
            $scope.street = "";
            $scope.web = "";
            $scope.owner_id = "";
        });
    };

    //display institution options
    $scope.instOptions = function () {
        $http.get("handlers/all_inst.php")
                .success(function (data) {
                    $scope.optionInst = data;
                });
    };

    //display user search results
    $scope.show_inst = function () {
        $http.get("handlers/all_inst.php")
                .success(function (data) {
                    $scope.inst_results = data;
                });
    };

    //Update institution
    $scope.update_inst = function (id, new_name, new_practice_id, new_street, new_zip_id, new_tel, new_email, new_web, new_owner_id) {
        $http.post("handlers/update_inst.php", {
            'id': id,
            'new_name': new_name,
            'new_zip_id': new_zip_id,
            'new_practice_id': new_practice_id,
            'new_tel': new_tel,
            'new_email': new_email,
            'new_street': new_street,
            'new_web': new_web,
            'new_owner_id': new_owner_id
        }).success(function (data) {
            //do something
            $scope.response = data;
            $scope.update_msg = "Behandler " + new_name + " er rettet.";
            $scope.instOptions();
            $scope.show_inst();
        });
    };

    //Delete institution
    $scope.delete_inst = function (id) {
        $http.post("handlers/delete_inst.php", {
            'id': id
        }
        ).success(function (response) {
            //do something
            $scope.response = response;
            $scope.instOptions();
            $scope.show_inst();
        });
    };

    //Check all institutions for lat long
    $scope.setLatLng = function () {
        $http.get("handlers/setLatLng.php")
                .success(function (response) {
                    //do something
                    $scope.geocodeResponse = response;
                });
    };

});



////////////////////
//Single page controller
app.controller("singleCtrl", function ($scope, $rootScope, $http, $routeParams, $location, NgMap) {

    //Get ID of institution
    if ($routeParams.id > 0) {
        $scope.inst_id = $routeParams.id;
    }

    //Set zoom
    NgMap.getMap().then(function (map) {
        map.setZoom(14);
    });

    //display practice options
    $scope.practiceOptions = function () {
        $http.get("handlers/all_practices.php")
                .success(function (data) {
                    $scope.optionPractices = data;
                });
    };

    //display city options
    $scope.cityOptions = function () {
        $http.get("handlers/all_cities.php")
                .success(function (data) {
                    $scope.optionCities = data;
                });
    };

    //display owner options
    $scope.ownerOptions = function () {
        $http.get("handlers/all_owners.php")
                .success(function (data) {
                    $scope.optionOwners = data;
                });
    };

    //Show institution
    $scope.show_single_inst = function () {
        $http.post("handlers/single_inst.php", {
            'id': $scope.inst_id
        }).success(function (data) {
            $scope.i_name = data[0]['i_name'];
            $scope.i_sdkid = data[0]['i_sdkid'];
            $scope.i_zip = data[0]['i_zip'];
            $scope.i_street = data[0]['i_street'];
            $scope.i_tel = data[0]['i_tel'];
            $scope.i_mail = data[0]['i_mail'];
            $scope.i_web = data[0]['i_web'];
            $scope.i_owid = data[0]['i_owid'];
            $scope.p_id = data[0]['p_id'];
            $scope.p_name = data[0]['p_name'];
            $scope.c_name = data[0]['c_name'];
            $scope.c_id = data[0]['c_id'];
            $scope.i_note = data[0]['i_note'];
            $scope.i_lat = data[0]['lat'];
            $scope.i_lng = data[0]['lng'];

            $scope.new_name = $scope.i_name;
            $scope.new_zip_id = $scope.i_zip;
            $scope.new_street = $scope.i_street;
            $scope.new_tel = $scope.i_tel;
            $scope.new_email = $scope.i_mail;
            $scope.new_web = $scope.i_web;

            //Preselect practice
            $http.get("handlers/all_practices.php")
                    .success(function (data) {
                        var index = data.findIndex(function (item, i) {
                            return item.id === $scope.p_id;
                        });
                        $scope.new_practice = data[index];
                    });
            //Preselect city
            $http.get("handlers/all_cities.php")
                    .success(function (data) {
                        var index = data.findIndex(function (item, i) {
                            return item.zip_id === $scope.i_zip;
                        });
                        $scope.new_zip = data[index];
                    });
            //Preselect owner
            $http.get("handlers/all_owners.php")
                    .success(function (data) {
                        var index = data.findIndex(function (item, i) {
                            return item.id === $scope.i_owid;
                        });
                        $scope.new_owner = data[index];
                    });

            if ($scope.i_tel != null) {
                $scope.i_tel = $scope.i_tel.substring(0, 4) + " " + $scope.i_tel.substring(4, 8);
            }
            if ($scope.i_note != null) {
                $scope.i_note = $scope.i_note.replace(/,/g, ' | ');
            }

            $scope.i_update = data[0]['i_update'];
            $scope.addr = $scope.i_name + ", " + $scope.i_street + ", " + $scope.i_zip + " " + $scope.c_name;

        });
    };

    //Show openhours
    $http.post("handlers/get_open_hours.php", {
        'id': $scope.inst_id
    }).success(function (data) {
        //do something
        $scope.shdk_id = data[0]['sundheddk_id'];
        $scope.mon = data[0]['mon'];
        $scope.tue = data[0]['tue'];
        $scope.wed = data[0]['wed'];
        $scope.thu = data[0]['thu'];
        $scope.fri = data[0]['fri'];
        $scope.sat = data[0]['sat'];
        $scope.sun = data[0]['sun'];
    });

    //Get number of ratings
    $scope.currentNumRatings = function () {
        $http.post("handlers/get_num_ratings.php", {
            'id': $scope.inst_id
        }).success(function (data) {
            $scope.num_score = data[0]['num_scores'];

            if ($scope.num_score == 1) {
                $scope.textCount = 'anmeldelse'
            } else {
                $scope.textCount = 'anmeldelser'
            }
        });
    };

    //Get current rating text if exists
    $scope.currentUserRatingText = function () {
        $http.post("handlers/get_existing_text.php", {
            'user_id': localStorage.getItem('id'),
            'inst_id': $scope.inst_id
        }).success(function (data) {
            $scope.db_rating_text = data[0]['text'];
            if ($scope.db_rating_text != null) {
                $scope.rating_text = $scope.db_rating_text;
            }
        });
    };

    //Get current ratings if exists
    $scope.currentUserRating = function () {
        $http.post("handlers/get_existing_rating.php", {
            'user_id': localStorage.getItem('id'),
            'inst_id': $scope.inst_id
        }).success(function (data) {
            $scope.rating_data = data;
            $scope.rating1 = data[0]['rating'];
            $scope.rating2 = data[1]['rating'];
            $scope.rating3 = data[2]['rating'];
            $scope.rating4 = data[3]['rating'];
            $scope.rating5 = data[4]['rating'];

            setStars1($scope.rating1 - 1);
            setStars2($scope.rating2 - 1);
            setStars3($scope.rating3 - 1);
            setStars4($scope.rating4 - 1);
            setStars5($scope.rating5 - 1);
        });
    };

    //display user avg-total-rating on specific institution
    $scope.get_avg_total_score = function () {
        $http.get("handlers/user_avg_total_score.php")
                .success(function (data) {
                    $scope.user_avg_total_score = data;
                });
    };

    //display rating avg
    $scope.getAvg = function () {
        $http.get("handlers/search_ratings.php")
                .success(function (data) {
                    $scope.rating_avg = data;
                });
    };

    //display specific rating avgs
    $scope.getInst_avg_scores = function () {
        $http.get("handlers/inst_avg_scores.php")
                .success(function (data) {
                    $scope.inst_avg_scores = data;
                });
    };

    //Get comments
    $scope.getComments = function () {
        $http.get("handlers/all_comments.php")
                .success(function (data) {
                    $scope.comments = data;
                });
    };

    //Get ratings
    $scope.getRatings = function () {
        $http.get("handlers/all_ratings.php")
                .success(function (data) {
                    $scope.ratings = data;
                });
    };

    //Get prices
    $scope.getPrices = function () {
        $http.get("handlers/all_prices.php")
                .success(function (data) {
                    $scope.prices = data;
                });
    };

    //Toogle on-off
    $scope.displayDwn = 'block';
    $scope.displayUp = 'none';

    $scope.changeDwn = function () {
        if ($scope.displayDwn == 'none') {
            $scope.displayDwn = 'block'
            $scope.displayUp = 'none'
        } else {
            $scope.displayDwn = 'none'
            $scope.displayUp = 'block'
        }
    };
    $scope.changeUp = function () {
        if ($scope.displayUp == 'none') {
            $scope.displayDwn = 'none'
            $scope.displayUp = 'block'
        } else {
            $scope.displayDwn = 'block'
            $scope.displayUp = 'none'
        }
    };

    //Update institution
    $scope.update_inst = function (id, new_name, new_practice_id, new_street, new_zip_id, new_tel, new_email, new_web, new_owner_id) {
        $http.post("handlers/update_inst.php", {
            'id': id,
            'new_name': new_name,
            'new_zip_id': new_zip_id,
            'new_practice_id': new_practice_id,
            'new_tel': new_tel,
            'new_email': new_email,
            'new_street': new_street,
            'new_web': new_web,
            'new_owner_id': new_owner_id
        }
        ).success(function (data) {
            $scope.response = data;
            $scope.update_msg = "Behandlerens data er rettet";
            $scope.show_single_inst();
        });
    };

    //Delete institution
    $scope.delete_inst = function (id) {
        $http.post("handlers/delete_inst.php", {
            'id': id,
        }
        ).success(function (data) {
            $scope.response = data;
            //$scope.show_single_inst();
            $location.path('forside');

        });
    };

    //Rate
    $scope.rate = function () {
        //check if user is logged on
        var id = localStorage.getItem('id');
        if (id === null) {
            $scope.logged = 0;
        } else {
            //insert
            $http.post("handlers/rate.php", {
                'rating1': $scope.rating1,
                'rating2': $scope.rating2,
                'rating3': $scope.rating3,
                'rating4': $scope.rating4,
                'rating5': $scope.rating5,
                'rating_text': $scope.rating_text,
                'i_id': $scope.inst_id,
                'u_id': id
            }
            ).success(function (data) {
                //do something
                document.getElementById('result').innerHTML = 'Tak for din anmeldelse!';
                $scope.getAvg();
                $scope.currentNumRatings();
                $scope.get_avg_total_score();
                $scope.getComments();
                $scope.getRatings();
                $scope.getInst_avg_scores();
                $scope.currentUserRating();
                $scope.currentUserRatingText();
                $scope.currentRatingCount();
            });
        }
    };

    //Log ind
    $scope.logonEmail = function () {
        $http.post(
                "handlers/logon.php", {
                    'email': $scope.email,
                    'password': $scope.password
                }
        ).success(function (data) {
            //do something
            $rootScope.user_data = data;

            if ($rootScope.user_data != 0) { //If login was successful
                $scope.logged = 1;
                $scope.user_id = $rootScope.user_data[0]['id'];
                $scope.fb_id = $rootScope.user_data[0]['fb_id'];
                $scope.name = $rootScope.user_data[0]['name'];
                $scope.role_id = $rootScope.user_data[0]['role_id'];
                $scope.img = $rootScope.user_data[0]['img'];

                $window.localStorage.setItem("id", $scope.user_id);
                $window.localStorage.setItem("fb_id", $scope.fb_id);
                $window.localStorage.setItem("name", $scope.name);
                $window.localStorage.setItem("email", $scope.email);
                $window.localStorage.setItem("role_id", $scope.role_id);
                $window.localStorage.setItem("img", $scope.img);

                $scope.currentUserRating();
                $scope.currentUserRatingText();
            } else { //If login failed
                $scope.server_msg = "Forkert e-mail eller password.";
            }

        });
    };

    //Opret bruger
    $scope.create_user = function () {
        if ($scope.password != $scope.passwordrepeat) {
            alert("Passwords matcher ikke. Prøv igen.");
        } else {
            //insert
            $http.post(
                    "handlers/create_user.php", {
                        'name': $scope.name,
                        'email': $scope.email,
                        'password': $scope.password
                    }
            ).success(function (data) {
                //do something
                $scope.server_msg = "Velkommen hos HealthPilot!";
                $scope.signup = false;
            });
        }
    };

    // RATING HEARTS //
    //Heart colors
    var col_active = "#b44024";
    var col_inactive = "#E0E0E0";

    var ratedIndex1 = -1;
    var ratedIndex2 = -1;
    var ratedIndex3 = -1;
    var ratedIndex4 = -1;
    var ratedIndex5 = -1;

    $('.minus1').on('click', function () {
        resetStarColors1();
        ratedIndex1 = -1;
    });
    $('.minus2').on('click', function () {
        resetStarColors2();
        ratedIndex2 = -1;
    });
    $('.minus3').on('click', function () {
        resetStarColors3();
        ratedIndex3 = -1;
    });
    $('.minus4').on('click', function () {
        resetStarColors4();
        ratedIndex4 = -1;
    });
    $('.minus5').on('click', function () {
        resetStarColors5();
        ratedIndex5 = -1;
    });

    // 1
    $(document).ready(function () {
        resetStarColors1();
        $('.fa-heart1').on('click', function () {
            ratedIndex1 = parseInt($(this).data('index'));
        });
        $('.fa-heart1').mouseover(function () {
            resetStarColors1();
            var currentIndex = parseInt($(this).data('index'));
            setStars1(currentIndex);
        });
        $('.fa-heart1').mouseleave(function () {
            resetStarColors1();
            if (ratedIndex1 = -1)
                setStars1($scope.rating1 - 1);
        });
    });
    function setStars1(max) {
        for (var i = 0; i <= max; i++)
            $('.fa-heart1:eq(' + i + ')').css('color', col_active);
    }
    function resetStarColors1() {
        $('.fa-heart1').css('color', col_inactive);
    }

    // 2
    $(document).ready(function () {
        resetStarColors2();
        $('.fa-heart2').on('click', function () {
            ratedIndex2 = parseInt($(this).data('index'));
        });
        $('.fa-heart2').mouseover(function () {
            resetStarColors2();
            var currentIndex = parseInt($(this).data('index'));
            setStars2(currentIndex);
        });
        $('.fa-heart2').mouseleave(function () {
            resetStarColors2();
            if (ratedIndex2 = -1)
                setStars2($scope.rating2 - 1);
        });
    });
    function setStars2(max) {
        for (var i = 0; i <= max; i++)
            $('.fa-heart2:eq(' + i + ')').css('color', col_active);
    }
    function resetStarColors2() {
        $('.fa-heart2').css('color', col_inactive);
    }

    // 3
    $(document).ready(function () {
        resetStarColors3();
        $('.fa-heart3').on('click', function () {
            ratedIndex3 = parseInt($(this).data('index'));
        });
        $('.fa-heart3').mouseover(function () {
            resetStarColors3();
            var currentIndex = parseInt($(this).data('index'));
            setStars3(currentIndex);
        });
        $('.fa-heart3').mouseleave(function () {
            resetStarColors3();
            if (ratedIndex3 = -1)
                setStars3($scope.rating3 - 1);
        });
    });
    function setStars3(max) {
        for (var i = 0; i <= max; i++)
            $('.fa-heart3:eq(' + i + ')').css('color', col_active);
    }
    function resetStarColors3() {
        $('.fa-heart3').css('color', col_inactive);
    }


    // 4
    $(document).ready(function () {
        resetStarColors4();
        $('.fa-heart4').on('click', function () {
            ratedIndex4 = parseInt($(this).data('index'));
        });
        $('.fa-heart4').mouseover(function () {
            resetStarColors4();
            var currentIndex = parseInt($(this).data('index'));
            setStars4(currentIndex);
        });
        $('.fa-heart4').mouseleave(function () {
            resetStarColors4();
            if (ratedIndex4 = -1)
                setStars4($scope.rating4 - 1);
        });
    });
    function setStars4(max) {
        for (var i = 0; i <= max; i++)
            $('.fa-heart4:eq(' + i + ')').css('color', col_active);
    }
    function resetStarColors4() {
        $('.fa-heart4').css('color', col_inactive);
    }

    // 5
    $(document).ready(function () {
        resetStarColors5();
        $('.fa-heart5').on('click', function () {
            ratedIndex5 = parseInt($(this).data('index'));
        });
        $('.fa-heart5').mouseover(function () {
            resetStarColors5();
            var currentIndex = parseInt($(this).data('index'));
            setStars5(currentIndex);
        });
        $('.fa-heart5').mouseleave(function () {
            resetStarColors5();
            if (ratedIndex5 = -1)
                setStars5($scope.rating5 - 1);
        });
    });
    function setStars5(max) {
        for (var i = 0; i <= max; i++)
            $('.fa-heart5:eq(' + i + ')').css('color', col_active);
    }
    function resetStarColors5() {
        $('.fa-heart5').css('color', col_inactive);
    }
    // RATING HEARTS //

});