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
    <br>
    <div style="text-align: left;" ng-show="fixedTrans.length>0">
        <h4>You have something to do !</h4>
        <table style="width: 100%;">
            <tr style="background-color: #428cf4; color: #fff;"><td>
                <table class="budgettable1"><tr>
                    <td style="width: 15%; text-align: center">DATE</td>
                    <td style="width: 30%; text-align: center">CATEGORY</td>
                    <td style="width: 10%; text-align: center">AMOUNT</td>
                    <td style="width: 35%; text-align: center">REMARK</td>
                    <td style="width: 10%; text-align: center"></td>
                </tr></table>
            </td></tr>
            <tr ng-repeat="r in fixedTrans" ng-form="editForm"><td style="background-color: #fff;">
                <form name="editForm" ng-submit="applyFixedExpend(expend)"><table class="budgettable2"><tr>
                    <td style="width: 15%; text-align: center;">
                        <input type="text" name="expenddate" ng-model="expend.occur_time" ng-init="expend.occur_time=r.occur_time" style="text-align: center; left: 100px; width: 100%; border-width: 0px;" disabled="true">
                    </td>
                    <td style="width: 30%; text-align: center;">{{ getCategoryNameByCode(r.cate_code) }}
                        <input type="text" hidden="true" name="expendcate" ng-model="expend.cate_code" ng-init="expend.cate_code=r.cate_code" style="text-align: center; width: 100%; border-width: 0px;" disabled="true">
                    </td>
                    <td style="width: 10%; text-align: center;">
                        <input type="text" name="expendamount" ng-model="expend.amount" ng-init="expend.amount=r.amount" style="text-align: right; width: 100%; border-width: 0px;" disabled="true">
                    </td>
                    <td style="width: 35%; text-align: center;">
                        <input type="text" name="expendremark" ng-model="expend.remark" ng-init="expend.remark=r.remark" style="text-align: center; width: 100%; border-width: 0px;" disabled="true">
                    </td>
                    <td style="width: 10%; text-align: center;">
                        <md-button type="submit" class="md-warn">APPLY</md-button>
                    </td>
                </tr></table></form>
            </td></tr>
        </table>
    </div>
</div>