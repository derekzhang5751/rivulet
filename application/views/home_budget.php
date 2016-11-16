<!DOCTYPE html>
<div>
    <table style="width: 100%;">
        <tr style="background-color: #428cf4; color: #fff;"><td>
            <table class="budgettable1"><tr>
                <td style="width: 30px; text-align: center">ID</td>
                <td style="width: 50px; text-align: center">CODE</td>
                <td style="width: 150px; text-align: center">CATEGORY</td>
                <td style="width: 120px; text-align: center">BUDGET</td>
                <td style="width: 80px; text-align: center">PERIOD</td>
                <td style="width: 200px; text-align: center">DESC</td>
                <td style="width: 100px; text-align: center">SETUP</td>
            </tr></table>
        </td></tr>
        <tr ng-repeat="r in budgets" ng-form="editForm"><td style="background-color: #fff;">
            <form name="editForm" ng-submit="editBudget(budget)"><table class="budgettable2"><tr>
                <td style="width: 30px; text-align: right">
                    {{ $index+1 }}<input type="hidden" name="budgetid" ng-model="budget.id" ng-init="budget.id=r.id">
                </td>
                <td style="width: 50px; text-align: center">{{ r.code }}</td>
                <td style="width: 150px; text-align: center">{{ r.cate_name }}</td>
                <td style="width: 120px; text-align: center">
                    <input type="text" name="budgetamount" min="0" ng-model="budget.amount" ng-init="budget.amount=r.amount" style="text-align: right; width: 80px; border-width: 0px;" required>
                </td>
                <td style="width: 80px; text-align: center">
                    <select ng-model="budget.period" ng-init="budget.period=r.period">
                        <option value="0" >Monthly</option>
                        <option value="1" >Yearly</option>
                        <option value="2" >Weekly</option>
                    </select>
                </td>
                <td style="width: 200px; text-align: center">{{ getDesc(r) }}</td>
                <td style="text-align: center">
                    <md-button type="submit" class="md-warn" ng-disabled="!editForm.$dirty">SAVE</md-button>
                </td>
            </tr></table></form>
        </td></tr>
    </table>
    <div style="text-align: right;">
        <h4>Total Budgets: {{totalBudget | currency}}</h4>
    </div>
</div>