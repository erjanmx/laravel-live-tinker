var editor = ace.edit("editor");
editor.setTheme("ace/theme/monokai");
editor.session.setMode({path: "ace/mode/php", inline: true});

editor.on('change', function () {
    localStorage.setItem('live-tinker', editor.getValue());
});

// Add keyboard commands
editor.commands.addCommand({
    name: 'runAll',
    bindKey: {win: 'Ctrl-Enter',  mac: 'Command-Enter'},
    exec: function(editor) {
        sendCode(editor.getValue())
    }
});
editor.commands.addCommand({
    name: 'runSelected',
    bindKey: {win: 'Ctrl-Shift-Enter',  mac: 'Command-Shift-Enter'},
    exec: function(editor) {
        sendCode(editor.getSelectedText())
    }
});

function sendCode(text) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/live-tinker/ajax');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        var response = xhr.responseText;
        if (xhr.status === 200) {
            response = '<pre>' + response + '</pre>';
        }

        document.Response.document.body.innerHTML = response;
        changeButtonsState(false);
    };
    xhr.send('c=' + encodeURIComponent(text));

    changeButtonsState(true);
    document.Response.document.body.innerHTML = '';
}

function changeButtonsState(state) {
    document.getElementsByClassName('run-buttons')[0].disabled = state;
    document.getElementsByClassName('run-buttons')[1].disabled = state;
}

document.addEventListener("DOMContentLoaded", function(event) {
    var value = localStorage.getItem('live-tinker');
    if (typeof value === "string") {
        editor.setValue(value, 1);
    }
});
