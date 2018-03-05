var wsUrl = "ws://0.0.0.0:2346";
var editor = ace.edit("editor");
editor.setTheme("ace/theme/monokai");
editor.session.setMode({path: "ace/mode/php", inline: true});

editor.on('change', function () {
    localStorage.setItem('live-tinker', editor.getValue());
});

editor.commands.addCommand({
    name: 'runAll',
    bindKey: {win: 'Ctrl-Enter',  mac: 'Command-Enter'},
    exec: function(editor) {
        sendCode(editor.getValue())
    }
});

document.addEventListener("DOMContentLoaded", function(event) {
    var value = localStorage.getItem('live-tinker');
    if (typeof value === "string") {
        editor.setValue(value, 1);
    }
});

var connected = false;
// read from .env?
var socket = new WebSocket(wsUrl);

function connect() {
    if (!connected) {
        try {
            socket = new WebSocket(wsUrl);

            socket.onopen = function () {
                connected = true;
                document.getElementById('status').innerHTML = 'connected';
                changeButtonsState(false);
            };
            socket.onclose = function () {
                connected = false;
                document.getElementById('status').innerHTML = 'disconnected';
                changeButtonsState(true);
            };
            socket.onmessage = function (data) {
                document.getElementById('editor-result').innerHTML = data.data;
                changeButtonsState(false);
            };
        } catch (e) {}
    }
}

function sendCode(text) {
    socket.send(text);
    changeButtonsState(true);
    document.getElementById('editor-result').innerHTML = '';
}

function changeButtonsState(state) {
    document.getElementsByClassName('run-buttons')[0].disabled = state;
    document.getElementsByClassName('run-buttons')[1].disabled = state;
}

setInterval(function () {
    connect();
}, 3000);

connect();
