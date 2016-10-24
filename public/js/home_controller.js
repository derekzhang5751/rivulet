/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.controller('homeWelcomeCtrl', function($scope) {
    $scope.username = "";
    $scope.usertype = 0;
})

.controller('homeCategoryCtrl', function($scope, $http) {
    $scope.ifShowAddForm = false;
    $scope.categories = "";
    
    $scope.getAllCategories = function() {
        var data = "username=" + $scope.username;
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log("Request getAllCatetories");
        $http.post("Home/getAllCategories", data, config).then(
            function success(response){
                //console.log(response.data);
                $scope.categories = response.data.records;
            },
            function error(response){
                alert("Get catetory data failed!");
            }
        );
    }
    
    $scope.showAddForm = function($show) {
        $scope.ifShowAddForm = $show;
    }
    
    $scope.addCate = function($cate) {
        $scope.showAddForm(false);
    }
    
    $scope.cannel = function($cate) {
        $cate.code = "";
        $cate.name = "";
        $scope.showAddForm(false);
    }
    
    $scope.getAllCategories();
})

.controller('homeTransCtrl', function($scope, $http) {
    $scope.transactions = "";
    
    $scope.getTransactions = function() {
        var data = "";
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log("Request getTransactions");
        $http.post("Home/getTransactions", data, config).then(
            function success(response){
                //console.log(response.data);
                $scope.transactions = response.data.records;
            },
            function error(response){
                alert("Get transaction data failed!");
            }
        );
    }
    
    $scope.getTransactions();
});
