/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var app = angular.module("rivuletApp", ["ngRoute", "ngMaterial"]);

app.config(function($routeProvider){
    $routeProvider
    .when("/category", {
        templateUrl: "/Home/page/home_category",
        controller: "homeCategoryCtrl"
    })
    .when("/transaction", {
        templateUrl: "/Home/page/home_transaction",
        controller: "homeTransCtrl"
    })
    .when("/budget", {
        templateUrl: "/Home/page/home_budget",
        controller: "homeBudgetCtrl"
    })
    .when("/fixedexpenditure", {
        templateUrl: "/Home/page/home_fixedexpenditure",
        controller: "homeFixedExpendCtrl"
    })
    .when("/analysis", {
        templateUrl: "/Home/page/home_analysis",
        controller: "analysisCtrl"
    })
    .otherwise({
        templateUrl: "/Home/page/home_welcome",
        controller: "homeWelcomeCtrl"
    });
});