function poll() {
    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {
            if (this.status === 200) {

                try {
                    var json = JSON.parse(this.responseText);
                } catch {
                    console.log("B");
                    poll();return;
                }


                if (json.status !== true) {
                    alert(json.error);return;
                }
                document.getElementById('messengerArea').innerHTML = json.content;


                poll();
            } else {
                console.log("!4");
                poll();
            }
        }
    }
    ajax.open('GET', '../skrypty/serverajax.php?blognazwa='+document.getElementById('blognazwa').value, true);
    ajax.send();


}

window.onload = function() {
    poll();
}

