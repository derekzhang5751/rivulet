<!DOCTYPE html>
<div>
    <table>
        <tr style="background-color: #428cf4; color: #fff;">
            <td style="width: 30px; text-align: center">ID</td>
            <td style="width: 50px; text-align: center">CODE</td>
            <td style="width: 200px; text-align: center">LEVEL 1</td>
            <td style="width: 200px; text-align: center">LEVEL 2</td>
        </tr>
        <tr ng-repeat="r in categories" style="background-color: {{ isLevelRoot(r.code) ? '#f1f1f1' : '#ffffff' }};">
            <td style="width: 30px; text-align: right">{{ $index+1 }}</td>
            <td style="width: 50px; text-align: center">{{ r.code }}</td>
            <td style="width: 200px; text-align: center">{{ isLevelRoot(r.code) ? r.name : '' }}</td>
            <td style="width: 200px; text-align: center">{{ isLevelRoot(r.code) ? '' : r.name }}</td>
        </tr>
    </table>
    <br>
    <md-button type="button" ng-show="!ifShowAddForm" ng-click="showAddForm(true)" class="md-warn">Add a new category</md-button>
    <div ng-show="ifShowAddForm">
        <form name="addForm" novalidate>
            <br><h4>Add a new category</h4>
            <table>
            <tr>
                <td>Category code</td>
                <td>
                    <md-input-container>
                        <label>Category code</label>
                        <input type="number" name="catecode" min="1000" max="9999" ng-model="cate.code" ng-init="cate.code=''" required>
                        <span ng-show="addForm.catecode.$error.required">**</span>
                        <span ng-show="addForm.catecode.$error.min || addForm.catecode.$error.max">The value must be 1000 to 9999!</span>
                    </md-input-container>
                </td>
            </tr>
            <tr>
                <td>Category name</td>
                <td>
                    <md-input-container>
                        <label>Category name</label>
                        <input type="text" name="catename" ng-model="cate.name" ng-init="cate.name=''" required>
                        <span ng-show="addForm.catename.$error.required">**</span>
                    </md-input-container>
                </td>
            </tr>
            </table>
            <md-button type="submit" ng-click="addCate(cate)" ng-disabled="addForm.$invalid" class="md-primary">SAVE</md-button>
            <md-button type="button" ng-click="cannel(cate)" class="md-primary">CANNEL</md-button>
        </form>
    </div>
</div>