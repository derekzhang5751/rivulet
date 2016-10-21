<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
