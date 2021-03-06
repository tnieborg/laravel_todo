function InitAJAX()
{
    var objxml;
    var IEtypes = ["Msxml2.XMLHTTP.6.0", "Msxml2.XMLHTTP.3.0", "Microsoft.XMLHTTP"];

    try
    {
        // Probeer het eerst op de "moderne" standaardmanier
        objxml = new XMLHttpRequest();
    }
    catch (e)
    {
        // De standaardmanier werkte niet, probeer oude IE manieren
        for (var i = 0; i < IEtypes.length; i++)
        {
            try
            {
                objxml = new ActiveXObject(IEtypes[i]);
            }
            catch (e)
            {
                continue;
            }
        }
    }

    // Lever het XHR object op
    return objxml;
}

export function test(sort)
{
    // Maak een XHR object
    var xmlHttp = InitAJAX();
    //CSRF token
    var token = document.getElementsByTagName('input').item(name="_token").value; 
    
    var data = "_token="+token;
    console.log(token);
    //maak de URL voor het AJAX request
    
    var url = '/api/ajax?sort=' + sort + "&" + data;

    // Wat moet er gebeuren bij statuswijzigingen?
    xmlHttp.onreadystatechange = function ()
    {
        // Is het request al helemaal klaar en OK?
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            // Lees de tekst die is ontvangen
            var result = JSON.parse(xmlHttp.responseText);

            // Plaats de tekst in de pagina
            document.getElementById("todolist").innerHTML = result[0];
            document.getElementById("donelist").innerHTML = result[1];
            document.getElementById("result").innerHTML = result[2];
            document.querySelectorAll("input[type=hidden]").forEach(function(element) {
                if(element.name === "_token"){
                element.value = result[3];
                }
            }, this);
            
        }
    }
    // Verstuur het request
    xmlHttp.open("GET", url, true);
    xmlHttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlHttp.setRequestHeader("X-CSRF-TOKEN", result[3]);    
    xmlHttp.send();
}