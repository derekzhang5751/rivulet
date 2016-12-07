<!DOCTYPE html>
<div>
    <div>
        <form name="searchForm" novalidate>
            <h4 style="text-align: left;">Analysis Conditions</h4>
            <md-input-container style="width: 70px; height: 27px;">
                <label>Year</label>
                <input type="number" ng-model="search.year" ng-init="search.year=year" style="text-align: right;">
            </md-input-container>
            <md-input-container style="width: 120px; height: 27px;">
                <label>Month</label>
                <md-select ng-model="search.month" ng-init="search.month=month" style="text-align: left;">
                    <md-option value="1"><em>January</em></md-option>
                    <md-option value="2"><em>February</em></md-option>
                    <md-option value="3"><em>March</em></md-option>
                    <md-option value="4"><em>April</em></md-option>
                    <md-option value="5"><em>May</em></md-option>
                    <md-option value="6"><em>June</em></md-option>
                    <md-option value="7"><em>July</em></md-option>
                    <md-option value="8"><em>August</em></md-option>
                    <md-option value="9"><em>September</em></md-option>
                    <md-option value="10"><em>October</em></md-option>
                    <md-option value="11"><em>November</em></md-option>
                    <md-option value="12"><em>December</em></md-option>
                </md-select>
            </md-input-container>
            <md-button type="submit" ng-click="reanalyze(search)" class="md-primary">ANALYZE</md-button>
        </form>
    </div>
    <br>
Analysis Result
    <div><canvas id="analysisChart"></canvas></div>
    <br /><br /><br />
    <div style="width: 70%;"><canvas id="analysisChart2"></canvas></div>
</div>