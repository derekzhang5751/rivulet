<!DOCTYPE html>
<div>
    <H2>This page is category.<br></H2>
    <table>
        <tr ng-repeat="r in categories">
            <td style="width: 30px;">{{ $index+1 }}</td>
            <td style="width: 100px;">{{ r.code }}</td>
            <td style="width: 300px;">{{ r.name }}</td>
        </tr>
    </table>
    <br>
    <md-button type="button" ng-show="!ifShowAddForm" ng-click="showAddForm(true)" class="md-warn">Add a new category</md-button>
    <div ng-show="ifShowAddForm">
        <form name="addForm" novalidate>
            <br>Add a new category
            <table>
            <tr>
                <td>Category code</td>
                <td>
                    <input type="number" name="catecode" min="1000" max="9999" ng-model="cate.code" required>
                    <span ng-show="addForm.catecode.$error.min || addForm.catecode.$error.max">The value must be 1000 to 9999!</span>
                </td>
            </tr>
            <tr>
                <td>Category name</td>
                <td>
                    <input type="text" name="catename" ng-model="cate.name" required>
                    <span ng-show="addForm.catename.$error.required">*</span>
                </td>
            </tr>
            </table>
            <input type="submit" ng-click="addCate(cate)" ng-disabled="addForm.$invalid" value="Save">
            <input type="button" ng-click="cannel(cate)" value="Cannel">
        </form>
    </div>
</div>