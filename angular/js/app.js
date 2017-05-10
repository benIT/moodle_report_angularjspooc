var app = angular.module('app', ["ngRoute", "chart.js", "ngTable", "isteven-multi-select",'ngSanitize', 'ngCsv']);

// remember that in MOODLE routes are calculated from the index.php file.
app.config(function ($routeProvider) {
    $routeProvider
        .when("/home", {
            templateUrl: "angular/partials/home.htm"
        })
        .when("/reportCourses", {
            templateUrl: "angular/partials/reportCourses.htm"
        })
        .when("/reportUsers", {
            templateUrl: "angular/partials/reportUsers.htm"
        })
        .when("/form", {
            templateUrl: "angular/partials/form.htm"
        })
        .otherwise({
            redirectTo: '/home'
        });
});

app.run(function ($rootScope, reportFactory) {
    var getRoles = function () {
        reportFactory.getRoles().then(function (response) {
            console.log(response.data);
            $rootScope.roles = response.data;
        }, function (error) {
            $rootScope.status = 'Unable to load data: ' + error.message;
        });
    };
    var getDirections = function () {
        reportFactory.getExtraField('Direction').then(function (response) {
            console.log(response);
            var directions = response.data[0]['param1'];
            directions = directions.split("\n");
            $rootScope.directions=[];
            for (var i = 0; i < directions.length; i++) {
                $rootScope.directions.push({name: directions[i]});
            }
        }, function (error) {
            $rootScope.status = 'Unable to load data: ' + error.message;
            console.log(error);
        });
    };

    var getDepartements = function () {
        reportFactory.getExtraField('Departement').then(function (response) {
            console.log(response);
            var departements = response.data[0]['param1'];
            departements = departements.split("\n");
            $rootScope.departements=[];
            for (var i = 0; i < departements.length; i++) {
                $rootScope.departements.push({name: departements[i]});
            }
        }, function (error) {
            $rootScope.status = 'Unable to load data: ' + error.message;
            console.log(error);
        });
    };

    getDirections();
    getDepartements();
    getRoles();

    $rootScope.localLang = {
        selectAll: "Tout selectionner",
        selectNone: "Tout déselectionner",
        reset: "réinitialiser",
        search: "Rechercher...",
        nothingSelected: "Sélectionner une valeur"         //default-label is deprecated and replaced with this.
    };


    $rootScope.$on('$routeChangeSuccess', function (e, current, pre) {
        console.log(current.originalPath); // Do not use $$route here it is private
        $rootScope.showButton = current.originalPath && current.originalPath.indexOf('home') === -1;
    });
});

app.factory('httpInterceptor', function ($q, $rootScope, $log) {
    var numLoadings = 0;
    return {
        request: function (config) {
            numLoadings++;
            // Show loader
            $rootScope.$broadcast("loader_show");
            return config || $q.when(config)
        },
        response: function (response) {
            if ((--numLoadings) === 0) {
                // Hide loader
                $rootScope.$broadcast("loader_hide");
            }
            return response || $q.when(response);
        },
        responseError: function (response) {
            if (!(--numLoadings)) {
                // Hide loader
                $rootScope.$broadcast("loader_hide");
            }
            return $q.reject(response);
        }
    };
})
    .config(function ($httpProvider) {
        $httpProvider.interceptors.push('httpInterceptor');
    });

