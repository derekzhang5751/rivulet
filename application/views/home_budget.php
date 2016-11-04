<!DOCTYPE html>
<div>
    <table>
        <tr style="background-color: #428cf4; color: #fff;">
            <td style="width: 30px; text-align: center">ID</td>
            <td style="width: 50px; text-align: center">CODE</td>
            <td style="width: 150px; text-align: center">CATEGORY</td>
            <td style="width: 80px; text-align: center">BUDGET</td>
            <td style="width: 80px; text-align: center">PERIOD</td>
            <td style="width: 200px; text-align: center">DESC</td>
            <td style="width: 50px; text-align: center">SETUP</td>
        </tr>
        <tr ng-repeat="r in budgets">
            <td style="text-align: right">{{ $index+1 }}</td>
            <td style="text-align: center">{{ r.code }}</td>
            <td style="text-align: center">{{ r.cate_name }}</td>
            <td style="text-align: center">{{ r.amount }}</td>
            <td style="text-align: center">{{ getPeriodWord(r.period) }}</td>
            <td style="text-align: center">{{ getDesc(r) }}</td>
            <td style="text-align: center">EDIT</td>
        </tr>
    </table>
</div>