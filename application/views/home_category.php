<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<H2>This page is category.<br></H2>
<table>
    <tr ng-repeat="r in categories">
        <td style="width: 30px;">{{ r.id }}</td>
        <td style="width: 100px;">{{ r.code }}</td>
        <td style="width: 300px;">{{ r.name }}</td>
    </tr>
</table>
