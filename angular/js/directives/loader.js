app.directive("loader", function ($rootScope) {
        return function ($scope, element, attrs) {
            $scope.$on("loader_show", function () {
                console.log('loader_show');
                return element.show();
            });
            return $scope.$on("loader_hide", function () {
                console.log('hide');
                return element.hide();
            });
        };
    }
);