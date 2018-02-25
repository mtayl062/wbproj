function changeImageRight(id,pos,num)
	{
	var img = document.getElementById(id);
	var parsed = img.src.substring(img.src.lastIndexOf("/") + 1);
	var parsed2 = parsed.split("");
	var newNum = (parseInt(parsed2[pos]) % num) + 1;
	img.src = "images/" + id + newNum.toString() + ".png";
	document.getElementById(id+"_choice").value = newNum;
	return false;
	}

function changeImageLeft(id,pos,num)
	{
	var img = document.getElementById(id);
	var parsed = img.src.substring(img.src.lastIndexOf("/") + 1);
	var parsed2 = parsed.split("");
	var newNum = ((parseInt(parsed2[pos])-2+num) % num) + 1;
	img.src="images/" + id + newNum.toString() + ".png";
	document.getElementById(id+"_choice").value = newNum;
	return false;
	}
	
var button = document.getElementById("avatarFarm");
button.addEventListener("submit",function(e) {
	e.preventDefault();
	window.location.href = "avatar.php";
});
