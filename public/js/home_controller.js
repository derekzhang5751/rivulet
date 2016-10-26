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
        var data = "code="+$cate.code+"&name="+$cate.name;
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log("Request getAllCatetories");
        $http.post("Home/addNewCatetory", data, config).then(
            function success(response){
                if (response.data == "ok") {
                    $cate.code = "";
                    $cate.name = "";
                    $scope.showAddForm(false);
                    $scope.getAllCategories();
                } else {
                    alert("Add catetory failed! -"+response.data);
                }
            },
            function error(response){
                alert("Add catetory failed!");
            }
        );
    }
    
    $scope.cannel = function($cate) {
        $cate.code = "";
        $cate.name = "";
        $scope.showAddForm(false);
    }
    
    $scope.getAllCategories();
})

.controller('homeTransCtrl', function($scope, $http) {
    $scope.ifShowAddForm = true;
    $scope.transactions = "";
    $scope.categories = "";
    
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
    
    $scope.cannel = function($trans) {
        $trans.date = "";
        $trans.cate = "";
        $trans.amount = "";
        $trans.type = "";
        $trans.remark = "";
        $scope.showAddForm(false);
    }
    
    $scope.addTransaction = function($trans) {
        var data = "date=" + $trans.date
            + "&cate=" + $trans.cate
            + "&amount=" + $trans.amount
            + "&type=" + $trans.type
            + "&remark=" + $trans.remark;
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log("Request getAllCatetories");
        $http.post("Home/addTransaction", data, config).then(
            function success(response){
                console.log(response.data);
                if (response.data == "ok") {
                    $scope.getAllCategories();
                } else {
                    alert(response.data);
                }
            },
            function error(response){
                alert("Get catetory data failed!");
            }
        );
    }
    
    $scope.getTransactions();
    $scope.getAllCategories();
});
