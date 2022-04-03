var isFileContentChanged = false;
var currentFileId;
var tabsData;
let folderidfile;
var currentFileContentFromServer = "";

//Create Tab on the editor
function createTab(tabData) {
   
    if(editor.getValue() != currentFileContentFromServer){
        if(confirm("Do you want to save your changes?")){
            return;
        }
    }
    var tabHtml = `<div style="display: flex;align-items:center"><li id="${tabData.id}-li" class="nav-item nav-tab active openedf" onclick="selectFile(event, ${tabData.id})" >
                        <a class="nav-link " aria-current="page" style="display:flex;align-items: center;" id=${tabData.id}>${tabData.name}</a>
                    </li><img id="${tabData.id}-img" src="image/x.png" height="10px" onclick="closeFile(${tabData.id})" width="10px" alt=""></div>`;
    if ($("#openfiles").find(`#${tabData.id}`).length === 0) {
        $("#openfiles").append(tabHtml);
        selectFile(event, tabData.id);
    }
    if($('#openfiles').children().length != 0){
        $('#openfiles').find(`#tempheading`).remove();
        editor.setReadOnly(false);
        $('#savecontentbutton').attr('disabled', false);
        $('#savecommentbutton').attr('disabled', false);
        $('#comment').attr('disabled', false);
    }
}

//Close file tab
function closeFile(fileid) {
    $("#openfiles").find(`#${fileid}-li`).remove();
    $("#openfiles").find(`#${fileid}-img`).remove();
    editor.setValue("");
    $(`.comment-container`).empty();
    currentFileContentFromServer = "";
    if($('#openfiles').children().length != 0){
        $('#openfiles').find(`#tempheading`).remove();
    }else{
        $('#openfiles').append('<h1 id="tempheading">You Have No File Open</h1>');
    }
}

//Show input box for folder name
function createFolder() {
    document.getElementById("createfolder").style.display = "block";
    document.getElementById("createlink").style.display = "none";
}

//Show input box for file input name
function createFile(folderid) {
    folderidfile = folderid;
    document.getElementById("createfolder").style.display = "none";
    document.getElementById("createlink").style.display = "none";
    document.getElementById("createfile").style.display = "block";
}

//Open file on the editor as tab
function selectFile(evt, fileid) {
    currentFileId = fileid;
    document.getElementById("saveidform").value = fileid;
    document.getElementById("saveidform1").value = fileid;
    getDataForFile(fileid);
}

//Create active or inactive file tab
function createTabActive(fileid) {
    var alreadyContent;
    var i, tabcontent, tablinks;
    // if (tabsData)
    //     alreadyContent =
    //         tabsData[2][0] !== undefined ? tabsData[2][0].file_content : "";
    // else alreadyContent = "";
    // console.log('====',alreadyContent,'dfg', editor.getValue());
    // isFileContentChanged = editor.getValue() == alreadyContent;
    // console.log(isFileContentChanged);
    // if (!isFileContentChanged) {
    //     var confirmmassage = confirm("Save your file before leaving");
    //     if (confirmmassage) {
    //         return;
    //     }
    // }
    tablinks = document.getElementsByClassName("openedf");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    console.log($(`#${fileid}`).parent());
    $(`#${currentFileId}`).parent()[0].className += " active";
    console.log(document.getElementById("saveidform1").value);
}

//Fetch file content from server
function getDataForFile(fileid) {
    console.log("------------------------------------------------------------");
    if(editor.getValue() != currentFileContentFromServer){
        if(confirm("Do you want to save your changes?")){
            return;
        }
    }
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "post",
            url: "/getdata",
            data: {
                file: fileid,
            },
            success: function (data) {
                console.log("``````````````````````````````````````````````");
                console.log(data);
                tabsData = data;
                var alreadyContent =
                    data[2][0] !== undefined ? data[2][0].file_content : "";
                editor.setValue(alreadyContent);
                currentFileContentFromServer=alreadyContent;
                createTabActive();
                showComment(data[1]);
                // var txt3 = `<li></li>`;
                // $("#folder_li").append(txt3);
            },
        });
    });
}

// Show comment on the editor
function showComment(commentData) {
    $(`.comment-container`).empty();
    for( var i = 0; i < commentData.length; i++){
        var commentDate = new Date(commentData[i].created_at);
    var comtxt = `<div class="comment-box">
                    <div class="comment-header">
                        <div class="comment-time">
                            <span>${commentDate.getDate()}/${commentDate.getMonth()+1}/${commentDate.getFullYear()}</span>
                        </div>
                    </div>
                    <div class="comment-body">
                        <p>${commentData[i].comment}</p>
                    </div>
                </div>`;
    $(`.comment-container`).append(comtxt);
    }
}

//Hide input field for folder/file name
function myFunction(id) {
    var _x_ = document.getElementById(id).style.display;

    if (_x_ == "none") {
        document.getElementById(id).style.display = "block";
    } else {
        document.getElementById(id).style.display = "none";
    }
}

//Ajax call for creating folder
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#submit").on("click", function (e) {
        e.preventDefault();
        var form_name = document.getElementById("foldername").value;
        var user_id = document.getElementById("user_foldername").value;
        $.ajax({
            type: "post",
            url: "/createfolder",
            data: {
                folder: form_name,
                user: user_id,
            },
            success: function (data) {
                document.getElementById("foldername").value = "";
                console.log(data.id);
                var txt1 = `<a class="nav-link" aria-current="page" href="#" style="display:flex;justify-content:space-between" onclick="myFunction(${data.id})"><div style="display: flex;"><img src="/image/folder.png" width="20px" alt="" ><span class="ml-2">${form_name}</span></div><img onclick="deleteFolder(${data.id})" src="image/x.png" width="20px" alt=""></a>
                `;
                var txt2 =`
                <li class="file_li" id="${data.id}" style="display: none;">
                        <p style="display:flex" onclick="createFile(${data.id})"><img src="/image/plus.png" width="20px" alt="">Create new file</p>
                    </li>
                `
                $("#folder_li").append(txt1);
                $("#folder_li").append(txt2);

            },
        });
    });
});

// Delete folder
function deleteFolder(folderid) {
    var confirmmassage = confirm("Are you sure you want to delete this folder?");
    if (confirmmassage) {
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                type: "post",
                url: "/deletefolder",
                data: {
                    folder: folderid,
                },
                success: function (data) {
                    console.log(data);
                    // refresh page
                    location.reload();
                },
            });
        });
    }
}



//Ajax call for creating file
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#filesubmit").on("click", function (event) {
        event.preventDefault();
        var file_name = document.getElementById("filename").value;
        var user_id = document.getElementById("user_filename").value;
        $.ajax({
            type: "POST",
            url: "createfile",
            data: {
                filename: file_name,
                user: user_id,
                parentFolder: folderidfile,
            },
            success: function (data) {
                document.getElementById("filename").value = "";
                console.log(data);
                var txt2 = `<a href="" style="display:flex;justify-content: space-between;align-items: center;" onclick="createTab(${data})" ><img src="/image/file.png" width="20px" alt="">${file_name}<img onclick="deleteFile(${data.id})" src="image/x.png" width="8px" alt=""></a>`;
                $(`#${data.parent_folder}`).append(txt2);
                //refresh page
                location.reload();
            },
        });
    });
});

// Delete file
function deleteFile(fileid) {
    var confirmmassage = confirm("Are you sure you want to delete this file?");
    if (confirmmassage) {
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                type: "post",
                url: "/deletefile",
                data: {
                    file: fileid,
                },
                success: function (data) {
                    console.log(data);
                    // refresh page
                    location.reload();
                },
            });
        });
    }
}





//Ajax call for saving file
$(document).ready(function () {
    if($('#openfiles').children().length == 0){
        $('#openfiles').append(`<h1 id="tempheading">You Have No File Open</h1>`);
        editor.setReadOnly(true);
        $('#savecontentbutton').attr('disabled', true);
        $('#savecommentbutton').attr('disabled', true);
        $('#comment').attr('disabled', true);
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#savecontentbutton").on("click", function (event) {
        event.preventDefault();
        var file_name = document.getElementById("saveidform").value;
        var datatosave = editor.getValue();
        currentFileContentFromServer=datatosave;
        console.log(file_name, datatosave);
        $.ajax({
            type: "POST",
            url: "savefile",
            data: {
                filename: file_name,
                file_content: datatosave,
            },
            success: function (data) {
                // document.getElementById('filename').value = '';
                console.log(data);
                //   var txt2 = `<a href="" style="display:flex" ><img src="{{ asset('image/file.png') }}" width="20px" alt="">${file_name}</a>`;
                //   $(`#${data.parent_folder}`).append(txt2);
            },
        });
    });
});

//Ajax call for adding comment
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#savecommentbutton").on("click", function (event) {
        event.preventDefault();
        var file_name = document.getElementById("saveidform1").value;
        var comment = document.getElementById("comment").value;
        console.log(
            "////////////////////////////////////////////////////////////////////////////////////////////////////////////"
        );
        console.log(file_name, comment);
        $.ajax({
            type: "POST",
            url: "/savecomment",
            data: {
                filename: file_name,
                comment: comment,
            },
            success: function (data) {
                // document.getElementById('filename').value = '';
                console.log(data);
                var comtxt = `<div class="comment-box">
                    <div class="comment-header">
                        <div class="comment-time">
                            <span>${new Date().getDate()}/${new Date().getMonth()+1}/${new Date().getFullYear()}</span>
                        </div>
                    </div>
                    <div class="comment-body">
                        <p>${data.comment}</p>
                    </div>
                </div>`;
                $(`.comment-container`).append(comtxt);
            },
        });
    });
});
