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
    
    /**
     * Read one record from text to a array
     * @param {type} text
     * @param {type} parameter, define as object {beginPos: 0, fieldSize: 6}
     * @returns {Array}
     */
    this.readRecordFromCSV = function(text, parameter) {
        var len = text.length;
        var r = new Array();
        var line = "";
        if (parameter.beginPos < 0 || parameter.beginPos >= len) {
            return r;
        }
        // read one line
        do {
            var c = text.charAt(parameter.beginPos);
            parameter.beginPos++;
            if (c === '\n' || c === '\r') {
                if (parameter.beginPos < len) {
                    c = text.charAt(parameter.beginPos);
                    if (c !== '\n' && c !== '\r') {
                        break;
                    }
                } else {
                    break;
                }
            } else {
                line = line + c;
            }
        } while (parameter.beginPos < len);
        //console.log("Line:"+line);
        
        // read fields from a line
        var split = ',';
        var p = 0;
        var field = "";
        var fieldSize = 0;
        do {
            if (line.charAt(p) === split) {
                r.push(field);
                field = "";
                fieldSize++;
            } else {
                field = field + line.charAt(p);
            }
            if (p + 1 >= line.length) {
                r.push(field);
                fieldSize++;
            }
            p++;
        } while (p < line.length);
        parameter.fieldSize = fieldSize;
        
        return r;
    };
    
});

