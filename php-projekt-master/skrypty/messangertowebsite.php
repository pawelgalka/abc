
<?php
echo "
<div id='messengerContainer'>
    <input id='isMessengerActive' type='checkbox' onchange='showOrHideMessenger();'> Is Messenger Active
    <div id='messengerActivation' style='visibility: hidden;'>
        <textarea readonly id='messengerArea' rows='10' cols='50'></textarea><br>
        Nazwa:
        <input id='nickname' type='text'><br>
        Wiadomość:
        <input id='message' type='text' style='width: 200px;'> <br>
        <input id='sendButton' type='button' value='Wyślij' onclick='sendMessage();' >
    </div>
</div>
";
?>