#Comments go here

function validateForm() {
	x = document.getElementById('time').value;
}

function validatesor() {
	x = document.getElementById('sor').value;
	if (x=="" || x==null) {
		document.getElementById('sorDiv').innerHTML = "State of registration must be filled out";
	} else {
		document.getElementById('sorDiv').innerHTML = "";
	}
	
}