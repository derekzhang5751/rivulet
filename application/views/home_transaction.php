<!DOCTYPE html>
<div>
    <H2>This page is transactions.<br></H2>
    <table>
        <tr ng-repeat="r in transactions">
            <td style="width: 40px;">{{ r.id }}</td>
            <td style="width: 160px;">{{ r.occur_time }}</td>
            <td style="width: 40px;">{{ r.cate_code }}</td>
            <td style="width: 60px;">{{ r.amount }}</td>
            <td style="width: 20px;">{{ r.direction }}</td>
            <td style="width: 200px;">{{ r.remark }}</td>
        </tr>
    </table>
    <br>
    <input type="button" ng-show="!ifShowAddForm" ng-click="showAddForm(true)" value="Add a new transaction">
    <div ng-show="ifShowAddForm">
        <form name="addForm" novalidate>
            <br>Add a new transaction
            <table>
            <tr>
                <td>Transaction Date</td>
                <td>
                    <input type="date" name="transdate" ng-model="trans.date" required>
                    <span ng-show="addForm.catecode.$error.min || addForm.catecode.$error.max">The value must be 1000 to 9999!</span>
                </td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                    <input type="text" name="transcate" ng-model="trans.cate" required>
                    <span ng-show="addForm.catename.$error.required">*</span>
                </td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>
                    <input type="number" name="transamount" min="0" max="9999" ng-model="trans.amount" required>
                    <span ng-show="addForm.transamount.$error.min || addForm.transamount.$error.max">The value must be 0 to 9999!</span>
                </td>
            </tr>
            <tr>
                <td>Type</td>
                <td>
                    <input type="text" name="transtype" ng-model="trans.type" required>
                    <span ng-show="addForm.catename.$error.required">*</span>
                </td>
            </tr>
            <tr>
                <td>Remark</td>
                <td>
                    <input type="text" name="transremark" min="1" max="2" ng-model="trans.remark" required>
                    <span ng-show="addForm.transamount.$error.min || addForm.transamount.$error.max">The value must be 1 to 2!</span>
                </td>
            </tr>
            </table>
            <input type="submit" ng-click="addTransaction(cate)" ng-disabled="addForm.$invalid" value="Save">
            <input type="button" ng-click="cannel(cate)" value="Cannel">
        </form>
    </div>
</div>