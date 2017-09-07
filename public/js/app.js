function xmlreq(url, onsucces, token) {
    // Maak een XHR object
    var xmlHttp = new XMLHttpRequest();
    //onload
    xmlHttp.addEventListener("load", function(){
        //run function on success
        onsucces(xmlHttp.responseText);
        //set token
        document.querySelectorAll("input[type=hidden]").forEach(function(element) {
            if(element.name === "_token"){
            element.value = token;
            }
        }, this);
    })

    xmlHttp.addEventListener("error",function (error) {
        console.log("this be wrong")
    });

    // Send request
    xmlHttp.open("GET", url, true);
    xmlHttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlHttp.setRequestHeader("X-CSRF-TOKEN", token);    
    xmlHttp.send();
}
   

var func = function test(response)
{
    // Lees de tekst die is ontvangen
    var result = JSON.parse(response);

    // Plaats de tekst in de pagina
    document.getElementById("todolist").innerHTML = result[0];
    document.getElementById("donelist").innerHTML = result[1];
    document.getElementById("result").innerHTML = result[2];
    
}