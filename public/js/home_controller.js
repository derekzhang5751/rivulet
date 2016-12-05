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
    $scope.addtrans = null;
    
    $rootScope.openLeftMenu = function() {
        $mdSidenav('left').toggle();
    }
    
    $scope.isLevelRoot = function($cateCode) {
        return rivuletServ.isLevelRoot($cateCode);
    }
    
    $scope.computeSum = function() {
        $scope.totalIncome = 0.0;
        $scope.totalExpend = 0.0;
        if ($scope.transactions) {
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
    }
    
    $scope.getTransactions = function() {
        var data = "date1=" + $filter('date')($scope.searchBeginDate, 'yyyy-MM-dd')
            + "&date2=" + $filter('date')($scope.searchEndDate, 'yyyy-MM-dd')
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
        //if ($show) {
        //    var el = document.getElementById('transframe');
        //    el.scrollTop = el.scrollHeight - el.height;
        //}
    }
    
    $scope.cannel = function($trans) {
        $scope.addtrans = $trans;
        $trans.date = "";
        $trans.cate = "";
        $trans.amount = "";
        $trans.type = "-1";
        $trans.remark = "";
        $scope.showAddForm(false);
    }
    
    $scope.addTransaction = function($trans) {
        $scope.addtrans = $trans;
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
                    $trans.type = "-1";
                    $trans.remark = "";
                    $scope.showAddForm(false);
                    $scope.getTransactions();
                } else {
                    alert(response.data.msg);
                }
            },
            function error(response){
                alert("Add transaction data failed!");
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
        $scope.searchBeginDate = $search.date1;
        $scope.searchEndDate = $search.date2;
        $scope.searchCateCode = $search.cate;
        $scope.getTransactions();
    }
    
    var today = new Date();
    var mm = today.getMonth();
    var year = today.getFullYear();
    //var sbegin = year+"-"+mm+"-1";
    //console.log("search begin date:"+sbegin);
    $scope.searchBeginDate = new Date(year, mm, 1, 0, 0, 0, 0);
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

.controller('homeFixedExpendCtrl', function($scope, $rootScope, $http, rivuletServ, $mdSidenav) {
    $rootScope.subTitle = "-- Fixed Expenditure";
    $scope.ifShowAddForm = false;
    $scope.transactions = "";
    $scope.categories = "";
    $scope.totalExpend = 0.0;
    
    $rootScope.openLeftMenu = function() {
        $mdSidenav('left').toggle();
    }
    
    $scope.isLevelRoot = function($cateCode) {
        return rivuletServ.isLevelRoot($cateCode);
    }
    
    $scope.computeSum = function() {
        $scope.totalExpend = 0.0;
        if ($scope.transactions) {
            for (var i=0; i<$scope.transactions.length; i++) {
                var trans = $scope.transactions[i];
                $scope.totalExpend += parseFloat(trans.amount);
                //console.log("EXPEND: +"+trans.amount+"="+$scope.totalExpend);
            }
        }
    }
    
    $scope.getFixedExpends = function() {
        var data = "cate=1";
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log("Request fixed expenditure:data="+data);
        $http.post("Home/getFixedExpenditures", data, config).then(
            function success(response){
                //console.log(response.data);
                $scope.transactions = response.data.records;
                $scope.computeSum();
            },
            function error(response){
                alert("Get fixed expenditure data failed!");
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
        $trans.remark = "";
        $scope.showAddForm(false);
    }
    
    $scope.addFixedExpend = function($trans) {
        var data = "date=" + $trans.date
            + "&cate=" + $trans.cate
            + "&amount=" + $trans.amount
            + "&remark=" + $trans.remark;
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log("Add a fixed expenditure");
        $http.post("Home/addFixedExpenditure", data, config).then(
            function success(response){
                //console.log(response.data);
                if (response.data.status == "ok") {
                    $trans.date = "";
                    $trans.cate = "";
                    $trans.amount = "";
                    $trans.type = "";
                    $trans.remark = "";
                    $scope.showAddForm(false);
                    $scope.getFixedExpends();
                } else {
                    alert(response.data.msg);
                }
            },
            function error(response){
                alert("Add a fixed expenditure failed!");
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
    
    $scope.getAllCategories();
    $scope.getFixedExpends();
})

.controller('analysisCtrl', function($scope, $rootScope, $http, $filter, $mdSidenav, rivuletServ) {
    $rootScope.subTitle = "-- Analysis";
    $scope.ifShowAddForm = false;
    $scope.searchBeginDate = "";
    $scope.searchEndDate = "";
    $scope.originData = null;

    $scope.labels = ["1", "2", "3", "4", "5", "6"];
    $scope.data = [28,48,40,19,96,27];
    $scope.analysisChart = null;
    $scope.colors1 = [];
    $scope.colors2 = [];
    $scope.analysisChart2 = null;
    
    $rootScope.openLeftMenu = function() {
        $mdSidenav('left').toggle();
    }
    
    $scope.drawChart = function() {
        var ctx = document.getElementById("analysisChart").getContext("2d");
        var data = {
            labels: $scope.labels,
            datasets: [
                {
                    label: "Expenditure Sum",
                    backgroundColor: $scope.colors1,
                    borderColor: $scope.colors2,
                    borderWidth: 1,
                    data: $scope.data
                }
            ]
        };
        var options = null;
        var config = {
            type: "horizontalBar",
            data: data,
            options: options
        };
        if ($scope.analysisChart === null) {
            $scope.analysisChart = new Chart(ctx, config);
        } else {
            $scope.analysisChart.destroy();
            $scope.analysisChart = new Chart(ctx, config);
        }
    }
    $scope.drawChart2 = function() {
        var ctx = document.getElementById("analysisChart2").getContext("2d");
        var data = {
            labels: $scope.labels,
            datasets: [
                {
                    label: "Expenditure Sum",
                    backgroundColor: $scope.colors1,
                    hoverBackgroundColor: $scope.colors2,
                    data: $scope.data
                }
            ]
        };
        var options = null;
        var config = {
            type: "pie",
            data: data,
            options: options
        };
        if ($scope.analysisChart2 === null) {
            $scope.analysisChart2 = new Chart(ctx, config);
        } else {
            $scope.analysisChart2.destroy();
            $scope.analysisChart2 = new Chart(ctx, config);
        }
    }
    
    $scope.updateCategoriesAnalysis = function() {
        var data = "date1=" + $filter('date')($scope.searchBeginDate, 'yyyy-MM-dd')
            + "&date2=" + $filter('date')($scope.searchEndDate, 'yyyy-MM-dd');
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };
        //console.log("Request updateCategoriesAnalysis");
        $http.post("Home/updateCategoriesAnalysis", data, config).then(
            function success(response){
                //console.log(response.data);
                if (response.data.status == "ok") {
                    $scope.labels = [];
                    $scope.data = [];
                    $scope.colors1 = [];
                    $scope.colors2 = [];
                    $scope.originData = response.data.records;
                    for (var i=0; i<$scope.originData.length; i++) {
                        var r = $scope.originData[i];
                        $scope.labels.push(r.name);
                        $scope.data.push(r.sum);
                        var color = rivuletServ.getNextColorRGB();
                        var color1 = "rgba("+color+", 0.5)";
                        var color2 = "rgba("+color+", 1.0)";
                        $scope.colors1.push(color1);
                        $scope.colors2.push(color2);
                    }
                    // draw chart
                    if ($scope.originData.length > 0) {
                        $scope.drawChart();
                        $scope.drawChart2();
                    }
                } else {
                    alert(response.data.msg);
                }
            },
            function error(response){
                alert("Update catetory analysis data failed!");
            }
        );
    }
    
    $scope.reanalyze = function($search) {
        $scope.searchBeginDate = $search.date1;
        $scope.searchEndDate = $search.date2;
        $scope.updateCategoriesAnalysis();
    }
    
    var today = new Date();
    var mm = today.getMonth();
    var year = today.getFullYear();
    
    $scope.searchBeginDate = new Date(year, mm, 1, 0, 0, 0, 0);
    $scope.updateCategoriesAnalysis();
})
;
