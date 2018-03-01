var done = true;

function showAnswer(id,ans) {
	if (done == true) {
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

function prepareCSS(n1,d1,n2,d2) {
	var boxes = d1*d2;
	var l1 = document.getElementById("l1");
	var r1 = document.getElementById("r1");
	var l2 = document.getElementById("l2");
	var r2 = document.getElementById("r2");
	l1.style.width = n1*d2*30 + "px";
	r1.style.width = d1*d2*30 - n1*d2*30 + "px";
	l2.style.width = n2*d1*30 + "px";
	r2.style.width = d1*d2*30 - n2*d1*30 + "px";
}