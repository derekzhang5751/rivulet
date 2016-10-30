/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.controller('userCtrl', function($scope, $http, $window, $mdDialog) {
    $scope.username = "";
    $scope.password = "";
    
    $scope.showAlert = function(ev, title, msg) {
        $mdDialog.show(
            $mdDialog.alert()
              .parent(angular.element(document.querySelector('#popupContainer')))
              .clickOutsideToClose(true)
              .title(title)
              .textContent(msg)
              .ariaLabel('Alert Dialog Demo')
              .ok('Got it')
              .targetEvent(ev)
        );
    };
    
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
                //console.log(response.data);
                if (response.data == "ok") {
                    $window.location.href = "/Home";
                } else {
                    //console.log(response.data);
                    //alert("Sign in failed");
                    $scope.showAlert(event, 'Sign in failed!', '');
                }
            },
            function error(response){
                //console.log("error:");
                console.log(response.data);
            }
        );
    }
});

