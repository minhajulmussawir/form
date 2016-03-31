function formValidation()
{
    var uname =document.registration.userid;
    var uemail = document.registration.emailid;
    var ucountry =document.registration.country;
    var upassword = document.registration.passid;
    
    if (userid_validation(uname,3,30)) 
    {
        if (pFilled(upassword))
        {
            if (CFilled(ucountry))
            {
                
            }
        }
    }
    window.location.reload();
    return false;
}

function userid_validation(uid,mx,my)  
{  
var uid_len = uid.value.length;  
if (uid_len === 0 || uid_len >= my || uid_len < mx)  
	{  
		alert("User Name should be filled / length be between "+mx+" to "+my);  
		uid.focus();  
		return false;  
	}  
 return true;  
}  

function email_validation(uemail){
    var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
    if (uemail.value.match(pattern)) {
        return true;
    }
    return false;
}

function CFilled(ucountry)
{
    var clength = ucountry.value.length;

    if (clength < 1)  {
        alert ('Kindly Enter Country Name');
        ucountry.focus();
        return false;
    }
    return true;
}

function pFilled (upassword){
    var plength = upassword.value.length;
    if (plength <8 || plength > 15) {
        alert('Password length should b within 8-15 characters');
        upassword.focus();
        return false;
    }
    return true;
}