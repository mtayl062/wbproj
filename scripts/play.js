var done = true;

var f;

function countdown() {
	var timebox = document.getElementById("timebox");
	var timeInput = document.getElementById("time");
	f = setInterval(function() {
		var time = timeInput.value;
		if (time > 0) {
			time = time - 1;
			timebox.innerHTML = "LEVEL TIME: " + time + " s";
			timeInput.value = time;
		} else {
			clearInterval(f);
			timebox.innerHTML = "LEVEL TIME: 0 s";
			timeInput.value = 0;
		}
	}, 1000);
}

function showAnswer(id,ans) {
	if (done == true) {
		clearInterval(f);
		var correct = ans.toUpperCase();
		var elem = document.getElementById("answer");
		var text = document.getElementById("answer_text");
		var right_button = document.getElementById(correct);
		right_button.style.backgroundColor = "Green";
		if (id === correct) {
			text.innerHTML = "Correct!";
			var scoreContainer = document.getElementById("score");
			scoreContainer.value = parseInt(scoreContainer.value) + 10;
		} else {
			text.innerHTML = "Incorrect! The answer is " + correct + ".";
			var wrong_button = document.getElementById(id);
			wrong_button.style.backgroundColor = "Red";
		}
		elem.style.visibility = "visible";
		done = false;
	}
}

function prepareCSS(n1,d1,n2,d2,b) {
	if (b) {
		countdown();
	}
	var boxes = d1*d2;
	var div = gcd(d1,d2);
	var l1 = document.getElementById("l1");
	var r1 = document.getElementById("r1");
	var l2 = document.getElementById("l2");
	var r2 = document.getElementById("r2");
	var num_l1 = n1*d2*30/div;
	l1.style.width = num_l1 + "px";
	r1.style.width = (d1*d2*30/div - n1*d2*30/div) + "px";
	l2.style.width = n2*d1*30/div + "px";
	r2.style.width = (d1*d2*30 - n2*d1*30)/div + "px";
}

function gcd(x, y) {
  if (x < y) {
	while(y) {
		var t = y;
		y = x % y;
		x = t;
	}
	return x;
  } else {
	while(x) {
		var t = x;
		x = y % x;
		y = t;
	}
	return y;
  }
}