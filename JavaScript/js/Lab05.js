

    function getFormvalues(){
        let FormValues = document.getElementById("registration");
        for (let i = 0; i < FormValues.length; i++) {
    	    if (FormValues.elements[i].value!= "Submit"){
				
        	    console.log("Name: "+ FormValues + " Value: "+
        	    FormValues.elements[i].value);
				
				document.getElementById("formOutput").innerHTML = "Information was logged in console."

            }
        }
    }
