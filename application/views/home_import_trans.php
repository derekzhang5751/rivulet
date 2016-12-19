<!DOCTYPE html>
<div style="text-align: left;">
    <h4>{{message}}</h4>
    <table style="border: none; width: 100%;">
    <tr>
        <td style="border: none;"><input type="file" id="csvFileName" name="csvFileName" /></td>
        <td style="border: none;">
            <p>Card Type:</p>
            <!--input type="radio" name="cardType" value="CREDIT" ng-model="cardType" />&nbsp;CREDIT<br-->
            <!--input type="radio" name="cardType" value="DEBIT" ng-model="cardType" />&nbsp;&nbsp;DEBIT-->
            <md-radio-group ng-model="cardType" class="md-primary">
                <md-radio-button value="CREDIT">CREDIT</md-radio-button>
                <md-radio-button value="DEBIT">&nbsp;DEBIT</md-radio-button>
            </md-radio-group>
        </td>
        <td style="border: none;"><md-button type="button" ng-disabled="disableLoad" ng-click="loadTrans()" class="md-raised md-primary">Load</md-button></td>
    </tr>
    </table>
</div>
<br><br>
<div>
    <table id="transTable" style="width: 100%;">
        <tr style="background-color: #428cf4; color: #fff;">
            <td style="width: 10%; text-align: center;">ITEM</td>
            <td style="width: 20%; text-align: center;">OCCUR DATE</td>
            <td style="width: 20%; text-align: center;">CATEGORY</td>
            <td style="width: 15%; text-align: center;" align="right">AMOUNT</td>
            <td style="width: 35%; text-align: center;">REMARK</td>
        </tr>
        <tr ng-repeat="r in transactions" ng-style="transRowStyle(r.uploaded)" >
            <td style="text-align: center;">{{ r.item }}</td>
            <td style="text-align: center;">{{ r.occur_time }}</td>
            <td style="text-align: center;">
                <select ng-model="r.cate_code">
                    <option ng-repeat="cate in categories" value="{{cate.code}}" selected="{{isSelected(cate.code, r.cate_code)}}" >{{isLevelRoot(cate.code)?'':'&nbsp;&nbsp;--&nbsp;&nbsp;'}}{{cate.name}}</option>
                </select>
            </td>
            <td style="text-align: center;" align="right">{{ r.amount }}</td>
            <td style="text-align: center;">{{ r.remark }}</td>
        </tr>
    </table>
    <md-button type="button" ng-disabled="disableImport" ng-click="uploadTrans()" class="md-raised md-warn">Import Above Transactions</md-button>
</div>