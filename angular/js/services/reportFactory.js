app.factory('reportFactory', ['$http', function ($http) {
    var reportFactory = {};
    reportFactory.endPoint = 'ajax.php';

    reportFactory.getCourseRepartition = function () {
        return $http.get(this.endPoint+'?query=CourseQuery');
    };

    reportFactory.getUserStateRepartition = function () {
        return $http.get(this.endPoint+'?query=UserStateQuery');
    };
    reportFactory.getRoles= function () {
        return $http.get(this.endPoint+'?query=RoleQuery');
    };
    reportFactory.getExtraField= function (field) {
        return $http.get(this.endPoint+'?query=ExtraFieldQuery&filter='+field);
    };
    /**
     * function filter to keep only unique values in array.
     * Usage: labels.filter(this.onlyUnique);
     * @param value
     * @param index
     * @param self
     * @returns {boolean}
     */
    reportFactory.onlyUnique = function (value, index, self) {
        return self.indexOf(value) === index;
    };
    /**
     * Build a dataObject for chartJS bar chart from rawData.
     *
     * number of series: number of bars for a x value
     * labels: x axe values
     * The data object: the number of array must match the number of series.
     * In each sub array, the number of values must match the number of labels
     * Each sub array contains the values for a serie.
     * Example:
     * $scope.labels = ['course 1', "course 2", "course 3"];
     * $scope.series = ['student', 'teacher', 'guest', 'admin'];
     * $scope.data = [[1, 4, 7], [2, 5, 8], [3, 6, 9], [4, 8, 10]];
     * The first subarray [1,4,7] contains the 'student' serie values.
     * 1 student for course 1
     * 4 students for course 2
     * 7 students for course 3
     * The second subarray [2,5,8] contains the 'teacher' serie values.
     * 2 students for course 1
     * 5 students for course 2
     * 8 students for course 3
     * The third subarray [3,6,9] contains the 'guest' serie values.
     * 3 students for course 1
     * 6 students for course 2
     * 9 students for course 3
     * The fourth subarray [4,8,10] contains the 'admin' serie values.
     * 4 students for course 1
     * 8 students for course 2
     * 10 students for course 3
     *
     * @param rawData: JSON, sql row
     * @param labelKey: name of the label column in rawData (example:'course')
     * @param serieKey: name of the serie column in rawData (example:'role')
     * @param dataKey: name of the data column  in rawData (example:'number')
     * @returns {{labels: Array.<*>, series: Array.<*>, data: Array}}
     */
    reportFactory.buildChartBarData = function (rawData, labelKey, serieKey, dataKey) {
        if (!rawData) {
            throw "rawData is falsy!";
        }
        if (!labelKey | !serieKey | !dataKey) {
            throw "a required value is empty! Check labelKey, serieKey or DataKey";
        }
        var labels = [], series = [], dataSeries = [];
        for (var i = 0; i < rawData.length; i++) {
            labels.push(rawData [i][labelKey]);
            series.push(rawData [i][serieKey]);
        }
        var labelsUnique = labels.filter(this.onlyUnique);
        var seriesUnique = series.filter(this.onlyUnique)
        console.log(labelsUnique, seriesUnique);

        //let's build an util object that as a key foreach series.
        var dataObject = {};
        for (var i = 0; i < seriesUnique.length; i++) {
            dataObject[seriesUnique[i]] = [];
        }
        console.log(dataObject);

        //now the keys are initialized. Let's fill that object with values.
        for (var i = 0; i < rawData.length; i++) {
            dataObject[rawData [i][serieKey]].push(rawData [i][dataKey]);
        }
        console.log(dataObject);

        for (var i = 0; i < seriesUnique.length; i++) {
            dataSeries.push(dataObject[seriesUnique[i]]);
        }
        console.log(dataSeries);
        return {
            labels: labelsUnique,
            series: seriesUnique,
            data: dataSeries
        };
    };
    return reportFactory;
}]);