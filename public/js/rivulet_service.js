/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.service('rivuletServ', function() {
    
    this.isLevelRoot = function($categoryCode) {
        //console.log("isLevelRoot input:"+$categoryCode);
        var a = parseInt($categoryCode) % 100;
        if (a === 0) {
            return true;
        } else {
            return false;
        }
    }
    
});

