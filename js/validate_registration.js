function validate(form){
	x = document.getElementById("registrationBlock").getElementsByTagName("span");
	for (var i=x.length-1; i>=0; i--){
		x[i].parentNode.removeChild(x[i]);
		//console.log(i)
	}

	var pass = isCorrectPass(form.pass);
	var email = isCorrectMail(form.email);

	//return false;
	return pass && email;
}

function isCorrectPass(text){
	var num = text.value;
	var item = document.createElement("span");
	if (num ==""){
		item.innerHTML = "Field cannot be empty!";
		text.style.backgroundColor = "#f7f7f7";
		var parentDiv = text.parentNode;
		parentDiv.insertBefore(item, text);
		return false;
	}
	else if (num.length<=7){
		//console.log(num);
		
		item.innerHTML = "Password must be 8 or more characters.";
		text.style.backgroundColor = "#f7f7f7";
		var parentDiv = text.parentNode;
		parentDiv.insertBefore(item, text);
		return false;
	}
	return true;
}

function isCorrectMail(text){
	var reg = /\w+@\w+\.[a-z]{2,3}/gi;
	var array = text.value;
	text.style.backgroundColor = "white";
	var regTesting = reg.test(array);
		if (text.value == ""){
			var item = document.createElement("span");
			item.innerHTML = "Field cannot be empty!";
			text.style.backgroundColor = "#f7f7f7";
			var parentDiv = text.parentNode;
			parentDiv.insertBefore(item, text);
			return false;
		}
		else if (regTesting == false){
			var item = document.createElement("span");
			item.innerHTML = "<br>E-mail doesn't correct";
			text.style.backgroundColor = "#f7f7f7";
			var parentDiv = text.parentNode;
			parentDiv.insertBefore(item, text);
			return false;
		}
	return true;
}
	

