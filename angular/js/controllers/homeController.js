app.controller('homeController', function ($scope) {
    $scope.message = "Welcome to the moodle/angularjs/chartJS POOC!";
    $scope.about = 'The aim of this POOC is to check the compatibility between MOODLE 3.X, angularjs 1.X, and chartJS 1.X';
    $scope.CourseReports = [
        {
            name: 'Role repartition by course',
            url: '#!/reportCourses'
        },
        {
            name: 'Users',
            url: '#!/reportUsers'
        },
        {
            name: 'Another report (not yet implemented)',
            url: '#!/home'
        },
        {
            name: 'Another report (not yet implemented)',
            url: '#!/home'
        },
        {
            name: 'Another report (not yet implemented)',
            url: '#!/home'
        },
        {
            name: 'Another report (not yet implemented)',
            url: '#!/home'
        },
        {
            name: 'Another report (not yet implemented)',
            url: '#!/home'
        },
        {
            name: 'Another report (not yet implemented)',
            url: '#!/home'
        },
        {
            name: 'Another report (not yet implemented)',
            url: '#!/home'
        },
        {
            name: 'Another report (not yet implemented)',
            url: '#!/home'
        },
        {
            name: 'Another report (not yet implemented)',
            url: '#!/home'
        },
        {
            name: 'Another report (not yet implemented)',
            url: '#!/home'
        }
    ];
});
