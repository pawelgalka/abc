<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html lang="pl" xml:lang="pl" xmlns="http://www.w3.org/1999/xhtml">


<head>
    <title>Tworzenie bloga</title>
    <link rel="stylesheet" title="compact" href="styl.css" type="text/css" />
    <link rel="stylesheet" title="alternative1" href="styl1.css" type="text/css" />
    <link rel="stylesheet" title="alternative2" href="styl2.css" type="text/css" />

    <script type="text/javascript" src="validators.js"></script>
    <script type="text/JavaScript">
        window.onload = function(){
            styl();
            currentDate();
            currentTime();
        };
    </script>
</head>

<body>
<?php include('menu.php'); ?>

<div id="main">
    <h1 id="title">Formularz tworzenia posta</h1>
    <div id="text">

<form name="form" action="../skrypty/wpis.php"  method="post" enctype="multipart/form-data" target="_blank">
	<label for="username"><b>Nazwa użytkownika</b></label><br/>
    <input type="text" placeholder="Enter Username" name="username" required="required">
	</input><br/>
	<label for="psw"><b>Hasło</b></label><br/>
    <input type="password" placeholder="Enter Password" name="psw" required="required">
	</input><br/>
	<label for="post"><b>Treść posta:</b></label><br/>
	<textarea name="post" cols="40" rows="5"></textarea><br/>
	<label for="date">Data:</label>
	<input type="text" name="data" id="data">
    </input><br/>
    <label for="time">Czas:</label>
	<input type="text" name="time" id="time">
    </input><br/>
    <label for="attachments">Załączniki:</label><br/>
    <input class="file" type="file" name="1" onchange="add(this)">
    </input><br/>
	<input type="submit" name="submit" />
	</input><br/>
	<input type="reset">
	</input><br/>
</form>

        <div id="styl"></div>
        <script type="text/javascript">addStyleSelector(getStyleList());</script>
    </div>
</div>

</body>
<script>



    var d =new Date();
    var year = d.getFullYear();
    var month = d.getMonth() +1;
    var day = d.getDate();
    var hours = d.getHours();
    var mins = d.getMinutes();
    if(parseInt(day) < 10)
        day = "0"+day;
    if(parseInt(month) < 10)
        month = "0"+month;
    if(parseInt(hours)<10)
        hours = "0" +hours;
    if(parseInt(mins)<10)
        mins = "0" + mins;
    // console.log(parseInt(mins));
    // document.getElementsByName('data')[0].value = year+"-"+month+"-"+day;
    // document.getElementsByName('time')[0].value = hours+":"+mins;
    function currentDate() {
        document.getElementsByName('data')[0].value = year+"-"+month+"-"+day;
    }

    function currentTime() {
        document.getElementsByName('time')[0].value = hours+":"+mins;
    }

    document.getElementById("data").onchange = function () {
        var data = document.getElementsByName("data")[0].value;
        //YYYY-MM-DD
        var year = data.substr(0,4);
        var month = data.substr(5,2);
        var day = data.substr(8,2);
        var matches = /^(\d{4})[-\/](\d{2})[-\/](\d{2})$/.exec(data);
        if (parseInt(year)<0) matches = null;
        if (parseInt(month)<0 || parseInt(month)>12) matches = null;
        if (parseInt(day)<0 || day >31) matches = null;
        if (parseInt(month)==2 && parseInt(day)>29) matches = null;
        var m30 = [4,6,9,11];
        if (m30.includes(parseInt(month)) && day >30) matches = null;
        if (matches == null) {
            currentDate();
        }
    }

    document.getElementById("time").onchange = function () {
        var time = document.getElementsByName('time')[0].value;
        console.log(time)
        var hours = time.substr(0,2);
        var mins = time.substr(2,2);
        var matches = /^(\d{2})[:](\d{2})$/.exec(time);
        console.log(matches)
        if (parseInt(hours)<0 || parseInt(hours)>23) matches = null;
        if (parseInt(mins)<0 || parseInt(mins)>59) matches = null;
        if (matches == null) {
            currentTime();
        }
    }


</script>
</html>