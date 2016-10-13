/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.controller('userCtrl', function($scope, $http) {
    $scope.username = "111";
    $scope.password = "222";
    
    $scope.login = function() {
        if ($scope.username == "") {
            alert("User can not be empty!");
            return;
        }
        if ($scope.password == "") {
            alert("Password can not be empty!");
            return;
        }
        var data = "username=" + $scope.username + "&password=" + $scope.password;
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        $http.post("User/signIn", data, config).then(
            function success(response){
                //console.log("success:");
                console.log(response.data);
            },
            function error(response){
                //console.log("error:");
                console.log(response.data);
            }
        );
    }
});

