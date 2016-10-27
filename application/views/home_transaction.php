<!DOCTYPE html>
<div>
    <H2>This page is transactions.<br></H2>
    <div>
        <form name="searchForm" novalidate>
            <p>Search Conditions</p>
            Begin Date:<input type="date" name="searchdate1" ng-model="search.date1" ng-init="search.date1=''">
            &nbsp;&nbsp;End Date:<input type="date" name="searchdate2" ng-model="search.date2" ng-init="search.date2=''">
            <br>Category:
            <select name="searchcate" ng-model="search.cate" ng-init="search.cate=''" required>
                <option value="">All categories</option>
                <option ng-repeat="cate in categories" value="{{cate.code}}">&nbsp;&nbsp;&nbsp;&nbsp;{{cate.name}}</option>
            </select>
            &nbsp;&nbsp;<input type="submit" ng-click="searchTransaction(search)" value="Search">
        </form>
    </div>
    <br>
    <table>
        <tr ng-repeat="r in transactions">
            <td style="width: 40px;">{{ $index+1 }}</td>
            <td style="width: 110px;">{{ r.occur_time }}</td>
            <td style="width: 80px;">{{ getCategoryNameByCode(r.cate_code) }}</td>
            <td style="width: 80px;" align="right">{{ r.direction>0 ? r.amount : '-'+r.amount }}</td>
            <td style="width: 80px;" align="center">{{ r.direction>0 ? 'Income' : 'Expend' }}</td>
            <td style="width: 200px;">{{ r.remark }}</td>
        </tr>
    </table>
    <br>
    <div>
        <h4>Total Income: {{totalIncome | currency}}</h4>
        <h4>Total Expend: {{totalExpend | currency}}</h4>
    </div>
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
                </td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                    <select name="transcate" ng-model="trans.cate" required>
                        <option value="">Choose a category</option>
                        <option ng-repeat="cate in categories" value="{{cate.code}}">&nbsp;&nbsp;&nbsp;&nbsp;{{cate.name}}</option>
                    </select>
                    <span ng-show="addForm.transcate.$error.required">**</span>
                </td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>
                    <input type="number" name="transamount" min="0" ng-model="trans.amount" required>
                    <span ng-show="addForm.transamount.$error.required">**</span>
                    <span ng-show="addForm.transamount.$error.min">The value must be more than 0!</span>
                </td>
            </tr>
            <tr>
                <td>Type</td>
                <td>
                    <select name="transtype" ng-model="trans.type" ng-init="trans.type='-1'">
                        <option value="-1">Expend</option>
                        <option value="1">Income</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Remark</td>
                <td>
                    <input type="text" name="transremark" ng-model="trans.remark" ng-minlength="1" ng-maxlength="20" required>
                    <span ng-show="addForm.transremark.$error.required">**</span>
                    <span ng-show="addForm.transremark.$error.minlength || addForm.transremark.$error.maxlength">The remark length must between 1 to 20!</span>
                </td>
            </tr>
            </table>
            <input type="submit" ng-click="addTransaction(trans)" ng-disabled="addForm.$invalid" value="Save">
            <input type="button" ng-click="cannel(trans)" value="Cannel">
        </form>
    </div>
</div>