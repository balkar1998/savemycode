let editor;

window.onload = function () {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/c_cpp");
};

function changeLanguage() {
    let language = $("#languages").val();

    if (language == "c" || language == "cpp")
        editor.session.setMode("ace/mode/c_cpp");
    else if (language == "php") editor.session.setMode("ace/mode/php");
    else if (language == "python") editor.session.setMode("ace/mode/python");
    else if (language == "node") editor.session.setMode("ace/mode/javascript");
    else if (language == "sql") editor.session.setMode("ace/mode/sql");
    else if (language == "html") editor.session.setMode("ace/mode/html");
    else if (language == "css") editor.session.setMode("ace/mode/css");
}
