//Angular application
var app = angular.module("sa_app", ['ngRoute', 'angularUtils.directives.dirPagination', 'ngMap']);

app.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
        $locationProvider.hashPrefix('');
        $routeProvider
                .when('/', {
                    templateUrl: 'pages/forside.php',
                    controller: 'mainCtrl'
                })
                .when('/forside/', {
                    templateUrl: 'pages/forside.php',
                    controller: 'mainCtrl'
                })
                .when('/search/', {
                    templateUrl: 'pages/search.php',
                    controller: 'searchCtrl'
                })
                .when('/search/:pid/:zipid/:searchText', {
                    templateUrl: 'pages/search.php',
                    controller: 'searchCtrl'
                })
                .when('/single/:id', {
                    templateUrl: 'pages/single.php',
                    controller: 'singleCtrl'
                })
                .when('/min-konto/', {
                    templateUrl: 'pages/minkonto.php',
                    controller: 'kontoCtrl'
                })
                .when('/login/', {
                    templateUrl: 'pages/login.php',
                    controller: 'loginCtrl'
                })
                .when('/admin-i/', {
                    templateUrl: 'pages/admin-i.php',
                    controller: 'instiCtrl'
                })
                .when('/admin-u/', {
                    templateUrl: 'pages/admin-u.php',
                    controller: 'usersCtrl'
                })
                .when('/admin-p/', {
                    templateUrl: 'pages/admin-p.php',
                    controller: 'controller'
                })
                .when('/om-os/', {
                    templateUrl: 'pages/om-os.php',
                    controller: 'controller'
                })
                .when('/klinik/', {
                    templateUrl: 'pages/klinik.php',
                    controller: 'controller'
                })
                .when('/Diætist/', {
                    templateUrl: 'pages/diætist.php',
                    controller: 'mainCtrl'
                })
                .when('/Tandlæge/', {
                    templateUrl: 'pages/tandlæge.php',
                    controller: 'mainCtrl'
                })
                .otherwise({
                    template: '404 page not found.'
                });
    }]);

//Facebook login
window.fbAsyncInit = function () {
    FB.init({
        appId: '810184669329517',
        status: true,
        cookie: true,
        xfbml: true,
        version: 'v4.0'
    });

    FB.AppEvents.logPageView();

};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
