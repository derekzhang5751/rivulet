/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.service('rivuletServ', function() {
    var colorR = 100;
    var colorG = 100;
    var colorB = 100;
    var curColorPos = 0;
    
    this.isLevelRoot = function($categoryCode) {
        //console.log("isLevelRoot input:"+$categoryCode);
        var a = parseInt($categoryCode) % 100;
        if (a === 0) {
            return true;
        } else {
            return false;
        }
    };
    
    this.getNextColorRGB = function() {
        var interval = 80;
        var color = "0, 0, 0";
        switch (curColorPos) {
            case 0:
                colorR = parseInt(colorR)+parseInt(interval);
                if (colorR > 250) colorR = colorR - 250;
                color = colorR + "," + colorG + "," + colorB;
                curColorPos = 1;
                break;
            case 1:
                colorG = parseInt(colorG)+parseInt(interval);
                if (colorG > 250) colorG = colorG - 250;
                color = colorR + "," + colorG + "," + colorB;
                curColorPos = 2;
                break;
            case 2:
                colorB = parseInt(colorB)+parseInt(interval);
                if (colorB > 250) colorB = colorB - 250;
                color = colorR + "," + colorG + "," + colorB;
                curColorPos = 0;
                break;
            default:
                color = colorR + "," + colorG + "," + colorB;
                curColorPos = 0;
                break;
        }
        //console.log("Color:"+color);
        return color;
    };
    
    this.getFirstDayOfMonth = function(year, month) {
        if (typeof(year) !== "number" || typeof(month) !== "number") {
            return "";
        }
        if (year <= 0 || month <= 0 || month > 12) {
            return "";
        }
        var mmmm = month.toString();
        if (mmmm.length === 1) {
            mmmm = "0" + mmmm;
        }
        return year.toString() + "-" + mmmm + "-01";
    };
    
    this.getLastDayOfMonth = function(year, month) {
        if (typeof(year) !== "number" || typeof(month) !== "number") {
            return "";
        }
        if (year <= 0 || month <= 0 || month > 12) {
            return "";
        }
        var m = month;
        var y = year;
        if (month === 12) {
            m = 1;
            y = year + 1;
        } else {
            m = month + 1;
        }
        var date1 = new Date(y, m-1, 1);
        var date2 = new Date(date1 - 24*60*60*1000);
        var mmmm = (date2.getMonth() + 1).toString();
        if (mmmm.length === 1) {
            mmmm = "0" + mmmm;
        }
        return date2.getFullYear() + "-" + mmmm + "-" + date2.getDate();
    };
    
});

