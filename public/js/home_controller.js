/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.controller('homeWelcomeCtrl', function($scope, $rootScope, $http, $mdSidenav) {
    $scope.username = "";
    $scope.usertype = 0;
    $scope.welcomeStat = null;
    $rootScope.subTitle = "--  Welcome";
    
    $rootScope.openLeftMenu = function() {
        $mdSidenav('left').toggle();
    }
    
    $scope.welcome = function() {
        var data = "username=" + $scope.username;
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log("Request getAllCatetories");
        $http.post("Home/welcome", data, config).then(
            function success(response){
                //console.log(response.data);
                $scope.welcomeStat = response.data.records;
            },
            function error(response){
                console.log("Get catetory data failed!");
            }
        );
    }
    
    $scope.welcome();
})

.controller('homeCategoryCtrl', function($scope, $rootScope, $http, rivuletServ, $mdSidenav) {
    $scope.ifShowAddForm = false;
    $scope.categories = "";
    $rootScope.subTitle = "--  Category";
    
    $rootScope.openLeftMenu = function() {
        $mdSidenav('left').toggle();
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
                if (response.data.status == "ok") {
                    $cate.code = "";
                    $cate.name = "";
                    $scope.showAddForm(false);
                    $scope.getAllCategories();
                } else {
                    alert("Add catetory failed! -"+response.data.msg);
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

.controller('homeTransCtrl', function($scope, $rootScope, $http, $filter, rivuletServ, $mdSidenav) {
    $rootScope.subTitle = "-- Transaction";
    $scope.ifShowAddForm = false;
    $scope.searchBeginDate = "";
    $scope.searchEndDate = "";
    $scope.searchCateCode = "";
    $scope.transactions = "";
    $scope.categories = "";
    $scope.totalIncome = 0.0;
    $scope.totalExpend = 0.0;
    
    $rootScope.openLeftMenu = function() {
        $mdSidenav('left').toggle();
    }
    
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
                if (response.data.status == "ok") {
                    $trans.date = "";
                    $trans.cate = "";
                    $trans.amount = "";
                    $trans.type = "";
                    $trans.remark = "";
                    $scope.showAddForm(false);
                    $scope.getTransactions();
                } else {
                    alert(response.data.msg);
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
})

.controller('homeBudgetCtrl', function($scope, $rootScope, $http, $mdSidenav, $mdDialog) {
    $rootScope.subTitle = "-- Budget";
    $scope.budgets = "";
    $scope.totalBudget = 0.0;
    
    $rootScope.openLeftMenu = function() {
        $mdSidenav('left').toggle();
    }
    
    $scope.computeSum = function() {
        $scope.totalBudget = 0.0;
        for (var i=0; i<$scope.budgets.length; i++) {
            var budget = $scope.budgets[i];
            if (budget.amount != 0) {
                if (budget.period == 1) {
                    $scope.totalBudget += (parseFloat(budget.amount) / 12);
                    //console.log("BUDGET SUM: YEARLY+"+budget.amount+"="+$scope.totalBudget);
                } else if (budget.period == 2) {
                    $scope.totalBudget += (parseFloat(budget.amount) * 4);
                    //console.log("BUDGET SUM: WEEKLY+"+budget.amount+"="+$scope.totalBudget);
                } else {
                    $scope.totalBudget += parseFloat(budget.amount);
                    //console.log("BUDGET SUM: MONTHLY+"+budget.amount+"="+$scope.totalBudget);
                }
            }
        }
    }
    
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
    
    $scope.getPeriodWord = function($period) {
        if ($period == 1) {
            return "Yearly";
        } else if ($period == 2) {
            return "Weekly";
        } else {
            return "Monthly";
        }
    }
    
    $scope.getDesc = function($budget) {
        var amount = $budget.amount;
        if ($budget.period == 1) {
            amount = $budget.amount / 12;
        } else if ($budget.period == 2) {
            amount = $budget.amount * 4.0;
        }
        return "$"+amount+" per month";
    }
    
    $scope.getAllBudgets = function() {
        var data = "username=" + $scope.username;
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log("Request getAllBudgets");
        $http.post("Home/getAllBudgets", data, config).then(
            function success(response){
                //console.log(response.data);
                $scope.budgets = response.data.records;
                $scope.computeSum();
            },
            function error(response){
                alert("Get budget data failed!");
            }
        );
    }
    
    $scope.editBudget = function($budget) {
        //console.log("Edit Budget:");
        console.log($budget);
        var data = "id=" + $budget.id
            + "&amount=" + $budget.amount
            + "&period=" + $budget.period;
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log(data);
        $http.post("Home/editBudget", data, config).then(
            function success(response){
                //console.log(response.data);
                if (response.data.status == "ok") {
                    $scope.getAllBudgets();
                    $scope.showAlert(event, 'Save Budget Success', '');
                } else {
                    $scope.showAlert(event, 'Save Budget Failed', response.data.msg);
                }
            },
            function error(response){
                $scope.showAlert(event, 'Save Budget Failed', 'Please try again!');
            }
        );
    }
    
    $scope.getAllBudgets();
})

.controller('homeFixedExpendCtrl', function($scope, $rootScope, $http, $filter, rivuletServ, $mdSidenav) {
    $rootScope.subTitle = "-- Fixed Expenditure";
    
    $rootScope.openLeftMenu = function() {
        $mdSidenav('left').toggle();
    }
    
});
