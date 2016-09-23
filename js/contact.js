$(document).ready(function(){
	document.getElementById("send").addEventListener("click", function(event){
		var req = new XMLHttpRequest();
		var payload = {email: null, msg: null};
		payload.email = document.getElementById("email").value;
		payload.msg = document.getElementById("msg").value;
		req.open("POST", "http://chrisloomis13.com/contact.php", true);
		req.setRequestHeader('Content-Type', 'application/json');
		req.addEventListener("load",function(){
			if(req.status >= 200 && req.status < 400)
			{//no error so utilize data returned
				var response = JSON.parse(req.responseText);
				//we need to parse the JSON inside the JSON returned
				response = JSON.parse(response.data);
				document.getElementById("response").textContent = response.email + " | " + response.msg;
			}
			else
			{//error
				console.log("Error in network request: " + request.statusText);
			}
		});
		req.send(JSON.stringify(payload));
		event.preventDefault();
	});
});