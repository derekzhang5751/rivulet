<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div>
    <div><H1>Welcome to use Rivulet!</H1></div>
    <div style="text-align: left;">
        <form name="searchForm" novalidate>
            <label style="font-weight: bold; font-size: 19px; height: 27px;">Date:</label>
            <md-input-container style="width: 70px; height: 27px; margin-left: 20px;">
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
            <md-button type="submit" ng-click="reload(search)" class="md-primary">REFRESH</md-button>
        </form>
    </div>
    <br>
    <div>
        <table style="width: 100%;">
            <tr style="background-color: #428cf4; color: #fff;">
                <td style="width: 10%; text-align: center">ID</td>
                <td style="width: 35%; text-align: center">CATEGORY</td>
                <td style="width: 20%; text-align: center">BUDGET</td>
                <td style="width: 20%; text-align: center">ACTUAL</td>
                <td style="width: 15%; text-align: center">DIFF</td>
            </tr>
            <tr ng-repeat="r in welcomeStat" style="background-color: {{ isLevelRoot(r.code) ? '#f1f1f1' : '#ffffff' }};">
                <td style="text-align: right;">{{ $index+1 }}</td>
                <td style="text-align: center;">{{ r.cate }}</td>
                <td style="text-align: center;">{{ r.budget }}</td>
                <td style="text-align: center;">{{ r.actual }}</td>
                <td style="text-align: center; color: {{ getColorOfDiffText(r.diff)}};">{{ r.diff }}</td>
            </tr>
        </table>
    </div>
</div>