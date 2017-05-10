app.controller('reportUserController', function ($scope, reportFactory, NgTableParams) {
    $scope.title = 'User site state';
    var getCourseRepartition = function () {
        reportFactory.getUserStateRepartition().then(function (response) {
            $scope.rawData = response.data[0];
            console.log($scope.rawData);

            $scope.labels = Object.keys($scope.rawData);
            $scope.data=[];
            for (var i = 0; i < $scope.labels.length;i++) {
                $scope.data.push($scope.rawData[$scope.labels[i]]);
            }
            $scope.options = {
                legend: {display: true}
            };
            $scope.tableParams = new NgTableParams({}, {dataset: response.data});

        }, function (error) {
            $scope.status = 'Unable to load data: ' + error.message;
        });
    };
    getCourseRepartition();
});