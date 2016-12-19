<!DOCTYPE html>
<div>
    <table style="width: 100%;">
        <tr style="background-color: #428cf4; color: #fff;">
            <td style="width: 10%; text-align: center;">ID</td>
            <td style="width: 10%; text-align: center;">OCCUR DATE</td>
            <td style="width: 30%; text-align: center;">CATEGORY</td>
            <td style="width: 15%; text-align: center;" align="right">AMOUNT</td>
            <td style="width: 35%; text-align: center;">REMARK</td>
        </tr>
        <tr ng-repeat="r in transactions">
            <td style="text-align: center;">{{ $index+1 }}</td>
            <td style="text-align: center;">{{ r.occur_time }}</td>
            <td style="text-align: center;">{{ getCategoryNameByCode(r.cate_code) }}</td>
            <td style="text-align: center;" align="right">{{ r.amount }}</td>
            <td style="text-align: center;">{{ r.remark }}</td>
        </tr>
    </table>
    <div style="text-align: right;">
        <h4>Total Expend: {{totalExpend | currency}}</h4>
    </div>
    <md-button type="button" ng-show="!ifShowAddForm" ng-click="showAddForm(true)" class="md-warn">Add a new fixed expenditure</md-button>
    <div ng-show="ifShowAddForm">
        <form name="addForm" novalidate>
            <br><h4>Add a new fixed expenditure</h4>
            <table style="margin: 0 auto;">
            <tr>
                <td>Transaction Date</td>
                <td>
                    <md-input-container>
                        <label>Date</label>
                        <input type="number" name="transdate" min="1" max="31" ng-model="trans.date" ng-init="trans.date=1" required>
                        <span ng-show="addForm.transdate.$error.required">**</span>
                        <span ng-show="addForm.transdate.$error.min">The value must be between 1 and 31!</span>
                    </md-input-container>
                </td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                    <md-input-container>
                        <label>Choose a category</label>
                        <md-select name="transcate" ng-model="trans.cate" required>
                            <md-option value=""><em>No choose</em></md-option>
                            <md-option ng-repeat="cate in categories" value="{{cate.code}}">{{isLevelRoot(cate.code)?'':'&nbsp;&nbsp;--&nbsp;&nbsp;'}}{{cate.name}}</md-option>
                        </md-select>
                        <span ng-show="addForm.transcate.$error.required">**</span>
                    </md-input-container>
                </td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>
                    <md-input-container>
                        <label>Amount</label>
                        <input type="number" name="transamount" min="0" ng-model="trans.amount" required>
                        <span ng-show="addForm.transamount.$error.required">**</span>
                        <span ng-show="addForm.transamount.$error.min">The value must be more than 0!</span>
                    </md-input-container>
                </td>
            </tr>
            <tr>
                <td>Remark</td>
                <td>
                    <md-input-container>
                        <label>Remark</label>
                        <input type="text" name="transremark" ng-model="trans.remark" ng-minlength="1" ng-maxlength="40" required>
                        <span ng-show="addForm.transremark.$error.required">**</span>
                        <span ng-show="addForm.transremark.$error.minlength || addForm.transremark.$error.maxlength">The remark length must between 1 to 40!</span>
                    </md-input-container>
                </td>
            </tr>
            </table>
            <md-button type="submit" ng-click="addFixedExpend(trans)" ng-disabled="addForm.$invalid" class="md-primary">SAVE</md-button>
            <md-button type="button" ng-click="cannel(trans)" class="md-primary">CANNEL</md-button>
        </form>
    </div>
</div>