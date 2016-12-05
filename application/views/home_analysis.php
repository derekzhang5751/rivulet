<!DOCTYPE html>
<div>
    <div>
        <form name="searchForm" novalidate>
            <h4 style="text-align: left;">Analysis Conditions</h4>
            <md-datepicker ng-model="search.date1" ng-init="search.date1=searchBeginDate" md-placeholder="Enter begin date" md-open-on-focus></md-datepicker>
            &nbsp;&nbsp;
            <md-datepicker ng-model="search.date2" ng-init="search.date2=''" md-placeholder="Enter end date" md-open-on-focus></md-datepicker>
            &nbsp;&nbsp;<md-button type="submit" ng-click="reanalyze(search)" class="md-primary">ANALYZE</md-button>
        </form>
    </div>
    <br>
Analysis Result
    <div><canvas id="analysisChart"></canvas></div>
    <br /><br /><br />
    <div style="width: 70%;"><canvas id="analysisChart2"></canvas></div>
</div>