function validateForm(event)
{

	console.log("Validating");

	var name = document.querySelector("#name");
	var address = document.querySelector("#address");
	var num = document.querySelector("#phonenumber");
	var email = document.querySelector("#email");

	if (name.value.replace(/ /g, '') === '')
	{
		alert("Invalid form");
		event.preventDefault();
		return
	}
	else if (validateNumber(num.value) && num.value !== '')
	{
		alert("Invalid phone number");
		event.preventDefault();
		return
	}
	else if (validateEmail(email.value) && email.value !== '')
	{
		alert("Invalid email");
		event.preventDefault();
		return
	}
	var contact = '{"name":"' + name.value + '","address":"' + address.value + '","phonenumber":"' + num.value + '","email":"' + email.value + '"}';
	contact = JSON.parse(contact);

	//form.submit();
	return false;
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