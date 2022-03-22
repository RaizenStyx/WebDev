/**************to celsius function**********************/
function toCelsius(farh) {
    return ((farh - 32) * 5/9);
}
console.log(toCelsius(212));

/**************to centimeters function*******************/
function toCentimeters(inch) {
    return inch*2.54;
}
console.log(toCentimeters(5));

/**************add tip function**************************/
function addTip(total) {
    return total * 1.2;
}
console.log(addTip(100));

/**************multiply function*************************/
function multiply(firstNum,secondNum){
    return firstNum * secondNum;
}
console.log(multiply(5,6));

/***********************sort function*********************/
function alphabet_order(str) {
    return str.split('').sort().join('');
}
console.log(alphabet_order('webmaster'));

/***********************Combination of Strings************************/
//Write a JavaScript function that generates all combinations of a string.
function substrings(str1)
{
    var array1 = [];
    for (var x = 0, y=1; x < str1.length; x++,y++)
    {
        array1[x]=str1.substring(x, y);
    }
    var combi = [];
    var temp= "";
    var slent = Math.pow(2, array1.length);

    for (var i = 0; i < slent ; i++)
    {
        temp= "";
        for (var j=0;j<array1.length;j++) {
            if ((i & Math.pow(2,j))){
                temp += array1[j];
            }
        }
        if (temp !== "")
        {
            combi.push(temp);
        }
    }
    console.log(combi.join("\n"));
}

substrings("Connor");

