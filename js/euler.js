function fibSum() {

	var fibForm = document.forms["fibForm"];

	var num = fibForm.elements["fibnum"].value;

    var i = 1,
        j = 2;

    var sum = 0;

    var temp;
    do {
        if (j % 2 === 0) {
            sum += j;
        }
        temp = i + j;
        i = j;
        j = temp;
    } while (j <= num);
    document.getElementById('fibSum').innerHTML = "The sum of even values for " + num + " is " + sum;
}

function findPrime() {

	var sumForm = document.forms["primeForm"];

	var num = sumForm.elements["primenum"].value;

	var newNum = num;

    var largestPrime = 0;

    var counter = 2;
    while (counter * counter <= newNum) {
        if (newNum % counter == 0) {
            newNum = newNum / counter;
        } else {
            counter++;
        }
    }
    if (newNum > largestPrime) {
        largestPrime = newNum;
    }
    document.getElementById('prime').innerHTML = "The largest prime number of "
    												+ num + " is " + largestPrime;
}

function addThreeAndFive() {

    var sumForm = document.forms["sumForm"];

    var num = sumForm.elements["sumnum"].value;

    var sum = 0;

    for (var i = 0; i <= num; i++) {
        if (i % 3 === 0 || i % 5 === 0) {
            sum += i;
        }
    }
    document.getElementById('totalSum').innerHTML = "The sum of " + num + " is " + sum;
}