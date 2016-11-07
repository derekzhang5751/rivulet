<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div>
    <div><H1>Welcome to use Rivulet!</H1></div>
    <div>
        <table>
            <tr style="background-color: #428cf4; color: #fff;">
                <td style="width: 30px; text-align: center">ID</td>
                <td style="width: 200px; text-align: center">CATEGORY</td>
                <td style="width: 100px; text-align: center">BUDGET</td>
                <td style="width: 100px; text-align: center">ACTUAL</td>
            </tr>
            <tr ng-repeat="r in welcomeStat" style="background-color: {{ isLevelRoot(r.code) ? '#f1f1f1' : '#ffffff' }};">
                <td style="text-align: right">{{ $index+1 }}</td>
                <td style="text-align: center">{{ r.cate }}</td>
                <td style="text-align: center">{{ r.budget }}</td>
                <td style="text-align: center">{{ r.actual }}</td>
            </tr>
        </table>
    </div>
</div>