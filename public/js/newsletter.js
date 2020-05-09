function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};

function subscribe() {
    var email = $('#email').val();
    if($.trim(email) == ''){
        alert("Enter an email address!!");
        
    }

    else {

        if (!isValidEmailAddress(email)) {
            alert("Invalid email address"); //error message
               
            return false;  
        }

        else {
            

            
            $.get('/newsletter/'+email, function success(data) {
                alert(data);
                $('#email').val(null);
            });
        }

    }



    
}

// $(":file").filestyle({text: "Find file"});


