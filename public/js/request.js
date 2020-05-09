document.getElementById("coats").addEventListener('click', catCoat);
function catCoat(){
	
	// create XHR (Ajax) object
	let xhr = new XMLHttpRequest();
	// we want to call OPEN, mais il y a d'autres etats
	
	xhr.open('GET','view/frontend/fetch.php?coat_color='+document.getElementById("coats").value,false); 
	xhr.send(null);

	document.getElementById("present_results").innerHTML = xhr.responseText; //HTML en MAJUSCULES
	
	console.log(xhr.responseText);

}