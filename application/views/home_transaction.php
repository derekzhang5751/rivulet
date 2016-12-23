<!DOCTYPE html>
<div>
    <div>
        <form name="searchForm" novalidate>
            <h4 style="text-align: left;">Search Conditions</h4>
            <md-datepicker ng-model="search.date1" ng-init="search.date1=searchBeginDate" md-placeholder="Enter begin date" md-open-on-focus></md-datepicker>
            &nbsp;&nbsp;
            <md-datepicker ng-model="search.date2" ng-init="search.date2=''" md-placeholder="Enter end date" md-open-on-focus></md-datepicker>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <md-input-container>
                <label>Choose a category</label>
                <md-select ng-model="search.cate" ng-init="search.cate=''" required>
                    <md-option value=""><em>All categories</em></md-option>
                    <md-option ng-repeat="cate in categories" value="{{cate.code}}">{{isLevelRoot(cate.code)?'':'&nbsp;&nbsp;--&nbsp;&nbsp;'}}{{cate.name}}</md-option>
                </md-select>
            </md-input-container>
            &nbsp;&nbsp;<md-button type="submit" ng-click="searchTransaction(search)" class="md-primary">SEARCH</md-button>
        </form>
    </div>
    <br>
    <table style="width: 100%;">
        <tr style="background-color: #428cf4; color: #fff;">
            <td style="width: 5%; text-align: center;">ITEM</td>
            <td style="width: 15%; text-align: center;">DATE</td>
            <td style="width: 23%; text-align: center;">CATEGORY</td>
            <td style="width: 10%; text-align: center;" align="right">AMOUNT</td>
            <td style="width: 10%; text-align: center;">TYPE</td>
            <td style="width: 30%; text-align: center;">REMARK</td>
            <td style="width: 7%; text-align: center;">
                <md-switch ng-model="enableDelete" aria-label="delete" style="min-height: 10px; height: 10px; margin-left: 18px;"></md-switch>
            </td>
        </tr>
        <tr ng-repeat="r in transactions">
            <td style="text-align: center;">{{ $index+1 }}</td>
            <td style="text-align: center;">{{ r.occur_time }}</td>
            <td style="text-align: center;">{{ getCategoryNameByCode(r.cate_code) }}</td>
            <td style="text-align: right;">{{ r.direction>0 ? r.amount : '-'+r.amount }}</td>
            <td style="text-align: center;">{{ r.direction>0 ? 'Income' : 'Expend' }}</td>
            <td style="text-align: center;">{{ r.remark }}</td>
            <td style="text-align: center;">
        <md-button type="button" class="md-warn" ng-disabled="!enableDelete" ng-click="delTranConfirm(event, r.id, r.remark)" style="min-width: 40px; font-size: 13px">Delete</md-button>
            </td>
        </tr>
    </table>
    <div style="text-align: right;">
        <h4>Total Income: {{totalIncome | currency}}</h4>
        <h4>Total Expend: {{totalExpend | currency}}</h4>
    </div>
    <br>
    <md-button type="button" ng-show="!ifShowAddForm" ng-click="showAddForm(true)" class="md-warn">Add a new transaction</md-button>
    <div ng-show="ifShowAddForm">
        <form name="addForm" novalidate>
            <br><h4>Add a new transaction</h4>
            <table style="margin: 0 auto;">
            <tr>
                <td>Transaction Date</td>
                <td>
                    <md-datepicker name="transdate" ng-model="trans.date" md-placeholder="Enter date" md-open-on-focus required></md-datepicker>
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
                <td>Type</td>
                <td>
                    <md-input-container>
                        <label>Type</label>
                        <md-select name="transtype" ng-model="trans.type" ng-init="trans.type='-1'">
                            <md-option value="-1"><em>&nbsp;&nbsp;&nbsp;&nbsp;Expend&nbsp;&nbsp;</em></md-option>
                            <md-option value="1"><em>&nbsp;&nbsp;&nbsp;&nbsp;Income&nbsp;&nbsp;</em></md-option>
                        </md-select>
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
            <!--tr>
                <td>Split</td>
                <td>
                    <md-input-container style="min-width: 100px;">
                        <label>Split Type</label>
                        <md-select name="transsplittype" ng-model="trans.splittype" required>
                            <md-option value="0"><em>No Split</em></md-option>
                            <md-option value="1" selected="true"><em>Monthly</em></md-option>
                        </md-select>
                    </md-input-container>
                    <md-input-container style="min-width: 100px;">
                        <label>Split Times</label>
                        <md-select name="transsplitsize" ng-model="trans.splitsize" required>
                            <md-option value="1" selected="true">1</md-option>
                            <md-option value="2">2</md-option>
                        </md-select>
                    </md-input-container>
                </td>
            </tr-->
            </table>
            <md-button type="submit" ng-click="addTransaction(trans)" ng-disabled="addForm.$invalid" class="md-primary">SAVE</md-button>
            <md-button type="button" ng-click="cannel(trans)" class="md-primary">CANNEL</md-button>
        </form>
    </div>
</div>