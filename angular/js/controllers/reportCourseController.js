app.controller('reportCourseController', function ($scope, reportFactory, NgTableParams) {
    $scope.title = 'User role repartition group by course';
    var getCourseRepartition = function () {
        reportFactory.getCourseRepartition().then(function (response) {
            $scope.rawData = response.data;
            var graphData = reportFactory.buildChartBarData($scope.rawData, 'course', 'role', 'number');
            $scope.labels = graphData.labels;
            $scope.series = graphData.series;
            $scope.data = graphData.data;
            $scope.options = {
                legend: {display: true},
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };
            $scope.tableParams = new NgTableParams({}, {dataset: $scope.rawData});

        }, function (error) {
            $scope.status = 'Unable to load data: ' + error.message;
        });
    };
    getCourseRepartition();
    console.log($scope.rawData);

});