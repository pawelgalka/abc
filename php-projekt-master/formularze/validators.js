
/***************************FILES***********************************************/
function add(v) {
    if (v.value !=""){
        addFile()
    }
}
//do dodawania dynamicznie plików
function addFile() {
    var ilePlikow = document.getElementsByClassName('file').length;
    var newFile = document.createElement("input");
    newFile.className = "file";
    newFile.type = "file";
    newFile.name = ilePlikow+1;
    newFile.setAttribute("onchange","add(this)");
    document.getElementsByName('form')[0].insertBefore(newFile,document.getElementsByName('submit')[0]);
    document.getElementsByName('form')[0].insertBefore(document.createElement("br"),document.getElementsByName('submit')[0]);

}


/***************************STYLE*****************************************************/
function getStyleList() {
    var allLinks = document.getElementsByTagName('link');
    result = new Array();
    for(i = 0; i < allLinks.length; ++i) {
        if(allLinks[i].type == "text/css"){
            result.push(allLinks[i]);
        }
    }
    return result;
}

var list = getStyleList();
var styleNumber;

// konfiguracja - wygasza każdy styl
function disableAll() {
    for(i = 0; i < list.length; ++i) {
        list[i].disabled = true;
    }
}


function setActive(e) {
    list[e.target.getAttribute('name')].disabled = false;
    console.log(e.target.getAttribute('name'));
    document.cookie="currentStyleID="+e.target.getAttribute('name');
}

function addStyleSelector(list) {
    var f = document.createElement("form");
    var s = document.createElement("select"); //input element, text

    for(it = 0; it < list.length; ++it) {
        var opt = document.createElement('option');
        opt.innerHTML = list[it].title;				// podpis
        opt.setAttribute('value',list[it].title);
        opt.setAttribute('name', it);
        opt.setAttribute('onclick','disableAll(); setActive(event);');
        s.appendChild(opt);
    }
    f.appendChild(s);

    document.getElementById('styl').appendChild(f);
}

function styl() {
    var lastStyleID = getCookie();
    console.log(lastStyleID);
    disableAll();
    if ((lastStyleID != "" )&& (typeof(list[lastStyleID]) != 'undefined')){ //jesli nie jest puste{
        list[lastStyleID].disabled = false; // ustaw poprzedni styl jako aktywny
    }
    else {
        if(styleNumber!=undefined) list[styleNumber].disabled=false;
        list[0].disabled = false; // ustaw pierwszy styl z listy gdy nie ma ciasteczka lub jest puste
    }
}


function getCookie()
{
    var number="";
    var ca = document.cookie.split(';'); // pobranie ciasteczek i oddzielenie ich od siebie
    console.log(ca);
    for(var i=0; i < ca.length; i++)
    {
        var c = ca[i].trim();
        if(c[0]!='c') continue;
        for (var j=c.indexOf('=')+1;j<c.length; j++) number = number.concat(c[j]);
        styleNumber = number;
        return number;
    }
    return "";
}

/******************************************MESSENGER*********************************************/
function loadBlog(){ //sets unchecked checkbox
    document.getElementById('isMessengerActive').checked = false;
    getMessages();
}

function showOrHideMessenger() {
    var checkbox = document.getElementById('isMessengerActive');
    var messengerActivation = document.getElementById('messengerActivation');
    if(checkbox.checked) {
        messengerActivation.style.visibility = 'visible';
    }
    else {
        messengerActivation.style.visibility = 'hidden';
    }
}

function resetMessage() { //resetuje wartości do messengera
    document.getElementById('nickname').value = "";
    document.getElementById('message').value = "";
}


function getMessages() {
    ReadConversation('../blogi/'+document.getElementById('blognazwa').value+"/wiadomosci");
}

function sendMessage() {
    var nickname = document.getElementById('nickname').value;
    var message = document.getElementById('message').value;

    if(nickname=="" || message=="")
        alert("Błędny format wiadomości");
    else{
        var xhttp = new XMLHttpRequest();
        var blogName = document.getElementById('blogName').value;
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log("pomyślnie przesłano wiadomość "+new Date());
            }
        resetMessage();
        };
        xhttp.open("GET","../skrypty/messenger.php?nickname="+nickname+"&message="+message+"&blogname="+blogName,true);
        xhttp.send();}


}
var maxCapacity = 8; //max lines of conv.

function ReadConversation(file) {
    var xhttp = new XMLHttpRequest();
    var conversation="";
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var array = this.responseText.split("\n");
            if(array.length <=maxCapacity) document.getElementById('messengerArea').innerHTML = this.responseText;
            else{
                for(var i=array.length-maxCapacity-1;i<array.length;i++)
                    conversation+=this.responseText.split("\n")[i]+"\n";
                document.getElementById('messengerArea').innerHTML = conversation;
            }
        }
    }
    xhttp.open("GET", file, true);
    xhttp.send();

}
