function validateForm()
{

	console.log("Validating");

	var name = document.querySelector("#name");
	var num = document.querySelector("#phonenumber");
	var email = document.querySelector("#email");

	if (name.value.replace(/ /g, '') === '' || email.value ==='')
	{
		alert("Please enter a name and/or email");
		return false
	}
	else if (validateNumber(num.value) && num.value !== '')
	{
		alert("Invalid phone number");
		return false
	}
	else if (validateEmail(email.value) && email.value !== '')
	{
		alert("Invalid email");
		return false
	}

	document.getElementById("phonebook").submit();
	document.getElementById("phonebook").reset();
}

function validateEmail(email)
{
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return !re.test(String(email).toLowerCase());
}

function validateNumber(num)
{
	var phoneno;
	if (num.length === 10)
	{
		phoneno = /^\d{10}$/;
		return !(num.match(phoneno));
	}
	else
	{
		phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
		return !num.match(phoneno);
	}
}