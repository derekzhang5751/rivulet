/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.controller('homeWelcomeCtrl', function($scope) {
    $scope.username = "";
    $scope.usertype = 0;
})

.controller('homeCategoryCtrl', function($scope, $http, rivuletServ) {
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
    
    $scope.isLevelRoot = function($cateCode) {
        return rivuletServ.isLevelRoot($cateCode);
    }
    
    $scope.getAllCategories();
})

.controller('homeTransCtrl', function($scope, $http, $filter, rivuletServ) {
    $scope.ifShowAddForm = false;
    $scope.searchBeginDate = "";
    $scope.searchEndDate = "";
    $scope.searchCateCode = "";
    $scope.transactions = "";
    $scope.categories = "";
    $scope.totalIncome = 0.0;
    $scope.totalExpend = 0.0;
    
    $scope.isLevelRoot = function($cateCode) {
        return rivuletServ.isLevelRoot($cateCode);
    }
    
    $scope.computeSum = function() {
        $scope.totalIncome = 0.0;
        $scope.totalExpend = 0.0;
        for (var i=0; i<$scope.transactions.length; i++) {
            var trans = $scope.transactions[i];
            if (trans.direction > 0) {
                $scope.totalIncome += parseFloat(trans.amount);
                //console.log("INCOME: +"+trans.amount+"="+$scope.totalIncome);
            } else {
                $scope.totalExpend += parseFloat(trans.amount);
                //console.log("EXPEND: +"+trans.amount+"="+$scope.totalExpend);
            }
        }
    }
    
    $scope.getTransactions = function() {
        var data = "date1=" + $scope.searchBeginDate
            + "&date2=" + $scope.searchEndDate
            + "&cate=" + $scope.searchCateCode;
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log("Request transactions:data="+data);
        $http.post("Home/getTransactions", data, config).then(
            function success(response){
                //console.log(response.data);
                $scope.transactions = response.data.records;
                $scope.computeSum();
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
        $formatDate = $filter('date')($trans.date, 'yyyy-MM-dd');
        var data = "date=" + $formatDate
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
                //console.log(response.data);
                if (response.data == "ok") {
                    $trans.date = "";
                    $trans.cate = "";
                    $trans.amount = "";
                    $trans.type = "";
                    $trans.remark = "";
                    $scope.showAddForm(false);
                    $scope.getTransactions();
                } else {
                    alert(response.data);
                }
            },
            function error(response){
                alert("Get catetory data failed!");
            }
        );
    }
    
    $scope.getCategoryNameByCode = function($code) {
        $name = "";
        for (var i=0; i<$scope.categories.length; i++) {
            var cat = $scope.categories[i];
            if (cat.code == $code) {
                $name = cat.name;
                break;
            }
        }
        return $name;
    }
    
    $scope.searchTransaction = function($search) {
        $scope.searchBeginDate = $filter('date')($search.date1, 'yyyy-MM-dd');
        $scope.searchEndDate = $filter('date')($search.date2, 'yyyy-MM-dd');
        $scope.searchCateCode = $search.cate;
        $scope.getTransactions();
    }
    
    $scope.getAllCategories();
    $scope.getTransactions();
});
