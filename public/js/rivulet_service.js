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
     * @syntax readRecordFromCSV() Read one record from text to a array
     * @param {type} text, raw text as csv format
     * @param {type} parameter, define as object {beginPos: 0, fieldSize: 6}
     * @returns {Array}, return all fields in the row.
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
    
    this.formatBMODate = function(date) {
        // 20161020
        var ret = false;
        if (date.length === 8) {
            ret = date.substring(0, 4) + "-";
            ret = ret + date.substring(4, 6) + "-";
            ret = ret + date.substring(6, 8);
        } else {
            ret = false;
        }
        return ret;
    };
    this.formatBMOAmount = function(amount, isCredit) {
        var ret = parseFloat(amount);
        if (isCredit) {
            ret = 0 - ret;
        }
        return ret;
    };
    this.formatBMORemark = function(remark) {
        var ret = remark;
        if (remark.length > 43) {
            ret = remark.substring(0, 42);
        }
        return ret;
    };
    this.readTransListFromBMOCSV = function(csvText, cardType) {
        var transactions = [];
        var skipRowCount = 0;
        var fieldCount = 100;
        var dateIndex = 0;
        var amountIndex = 0;
        var remarkIndex = 0;
        var isCredit = true;

        if ("DEBIT" === cardType) {
            // DEBIT
            isCredit = false;
            skipRowCount = 6;
            fieldCount = 5;
            dateIndex = 2;
            amountIndex = 3;
            remarkIndex = 4;
        } else {
            // CREDIT
            isCredit = true;
            skipRowCount = 3;
            fieldCount = 6;
            dateIndex = 2;
            amountIndex = 4;
            remarkIndex = 5;
        }
        
        var obj = {
            beginPos: 0,
            fieldSize: fieldCount
        };
        var index = 0;
        while (obj.fieldSize === fieldCount) {
            var r = this.readRecordFromCSV(csvText, obj);
            //console.log("BeginPos="+obj.beginPos+", FieldSize="+obj.fieldSize);
            if (obj.fieldSize === fieldCount) {
                index++;
                if (index > skipRowCount) {
                    transactions[index-skipRowCount-1] = {};
                    //console.log(r[0]+"    "+r[dateIndex]+"    "+r[amountIndex]+"    "+r[remarkIndex]);
                    transactions[index-skipRowCount-1].item = index - skipRowCount;
                    transactions[index-skipRowCount-1].occur_time = this.formatBMODate( r[dateIndex] );
                    transactions[index-skipRowCount-1].cate_code = "0000";
                    transactions[index-skipRowCount-1].amount = this.formatBMOAmount( r[amountIndex], isCredit );
                    transactions[index-skipRowCount-1].remark = this.formatBMORemark( r[remarkIndex] );
                    transactions[index-skipRowCount-1].uploaded = false;
                }
            }
            if (obj.beginPos === csvText.length) {
                obj.fieldSize = 0;
            } else {
                obj.fieldSize = fieldCount;
            }
        }
        return transactions;
    };
    
    this.readTransListFromRBCCSV = function(csvText, cardType) {
        var transactions = [];
        var fieldCount = 100;
        var dateIndex = 0;
        var amountIndex = 0;
        var remarkIndex = 0;
        var isCredit = true;

        if ("DEBIT" === cardType) {
            // DEBIT
            isCredit = false;
            fieldCount = 5;
            dateIndex = 2;
            amountIndex = 4;
            remarkIndex = 5;
        } else {
            // CREDIT
            isCredit = true;
            fieldCount = 6;
            dateIndex = 2;
            amountIndex = 3;
            remarkIndex = 4;
        }
        
        var obj = {
            beginPos: 0,
            fieldSize: fieldCount
        };
        var index = 0;
        while (obj.fieldSize === fieldCount) {
            var r = this.readRecordFromCSV(csvText, obj);
            //console.log("BeginPos="+obj.beginPos+", FieldSize="+obj.fieldSize);
            if (obj.fieldSize === fieldCount) {
                index++;
                if (index > 1) {
                    transactions[index-2] = {};
                    //console.log(r[0]+"    "+r[dateIndex]+"    "+r[amountIndex]+"    "+r[remarkIndex]);
                    transactions[index-2].item = index - 1;
                    transactions[index-2].occur_time = this.formatBMODate( r[dateIndex] );
                    transactions[index-2].cate_code = "0000";
                    transactions[index-2].amount = this.formatBMOAmount( r[amountIndex], isCredit );
                    transactions[index-2].remark = this.formatBMORemark( r[remarkIndex] );
                    transactions[index-2].uploaded = false;
                }
            }
            if (obj.beginPos === csvText.length) {
                obj.fieldSize = 0;
            } else {
                obj.fieldSize = fieldCount;
            }
        }
        return transactions;
    };
    
});

