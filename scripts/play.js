var done = true;

function showAnswer(id) {
	if (done == true) {
		var elem = document.getElementById("answer");
		var text = document.getElementById("answer_text");
		var right_button = document.getElementById("C");
		right_button.style.backgroundColor = "Green";
		if (id === "C") {
			text.innerHTML = "Correct!";
		} else {
			text.innerHTML = "Incorrect! The answer is 5/6.";
			var wrong_button = document.getElementById(id);
			wrong_button.style.backgroundColor = "Red";
		}
		elem.style.visibility = "visible";
		done = false;
	}
}