<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    html,
    body {
        height: 100% !important;
        margin: 0;
        box-sizing: border-box;
    }

    .header-blue {
        border-bottom: 1px solid #dee2e6;
    }

    #sidebar {
        background: #dbdbdb;
        border-right: 1px solid #dee2e6;
    }

    .navbar-collapse {
        /* flex-basis: 100%; */
        flex-grow: 0;
    }

    #mainDiv {
        border-bottom: 1px solid #dee2e6;
    }

    #footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 60px;
        /* Height of the footer */
    }

    .input {
        width: 100%;
    }

    ul.nav.nav-tabs {
        display: flex;
        justify-content: space-around;
        background-color: dbdbdb;
    }

    .editior {
        display: flex;
        align-items: center;
        margin-top: 20px;
        flex-direction: column;
    }

    .top-header {
        font-size: 25px !important;
    }

    .folder-header {
        display: flex;
        justify-content: space-between;
    }



    /* ----------ide------------- */
    .header {
        background: #57a958;
        text-align: left;
        font-size: 20px;
        font-weight: bold;
        color: white;
        padding: 4px;
        font-family: sans-serif;
    }

    .control-panel {
        background: lightgray;
        text-align: right;
        padding: 4px;
        font-family: sans-serif;
    }

    .languages {
        background: white;
        border: 1px solid gray;
    }

    #editor {
        height: 400px;
    }

    .button-container {
        text-align: right;
        padding: 4px;
    }

    .formfolder {
        display: flex;

    }

    .file_li {
        margin-left: 18px;
    }


</style>
<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 offset-1">
                <ul class="nav flex-column" id="sidebar">
                    <div class="folder-header">
                        <h4>Folders</h4>
                        <a class="btn btn-sm btn-primary" id="createlink" onClick="createFolder()">Create folder</a>
                        <form action="" method="" name="createfolder" id="createfolder" style="display: none;">
                            @csrf
                            <div class="formfolder">
                                <input type="text" id="foldername" name="foldername" value="" placeholder="folder name">
                                <input type="hidden" name="user_id" id="user_foldername" value="{{ Auth::user()->id }}">
                                <button type="submit" id="submit" ><img src="{{ asset('image/add-folder.png') }}" width="30px" alt=""></button>
                                <button type="button"><img src="{{ asset('image/x.png') }}" width="20px" alt=""></button>
                            </div>
                        </form>
                        <form action="" method="" name="createfile" id="createfile" style="display: none;">
                            @csrf
                            <div class="formfolder">
                                <input type="text" id="filename" name="filename" value="dsfsd" placeholder="file name">
                                <input type="hidden" name="user_id" id="user_filename" value="{{ Auth::user()->id }}">
                                <button type="submit" id="filesubmit" ><img src="{{ asset('image/add-folder.png') }}" width="30px" alt=""></button>
                                <button type="button"><img src="{{ asset('image/x.png') }}" width="20px" alt=""></button>
                            </div>
                        </form>
                    </div>
                    @foreach($data as $item)
                    <li class="nav-item" id="folder_li">
                        <a class="nav-link" aria-current="page" style="display:flex"  onclick="myFunction('{{$item->id}}')"><img src="{{ asset('image/folder.png') }}" width="20px" alt="">{{ $item->name }}</a>
                        <li class="file_li" id="{{$item->id}}" style="display: none;">
                            <p style="display:flex" onclick="createFile({{$item->id}})" ><img src="{{ asset('image/plus.png') }}" width="20px" alt="">Create new file</p>
                            @foreach($innerdata as $inneritem)
                                @if($inneritem->parent_folder == $item->id)
                                    <a onclick="createTab({{$inneritem}})" style="display:flex" ><img src="{{ asset('image/file.png') }}" width="20px" alt="">{{ $inneritem->name }}</a>
                                @endif 
                            @endforeach
                        </li>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <ul class="nav nav-tabs allopenfiles" id="openfiles">
                    </ul>
                </div>
                <div class="row editior">
                    <div class="col-md-12">

                        <div class="header">Add your code here</div>
                        <div class="control-panel">
                            select language:
                            &nbsp; &nbsp;
                            <select name="" id="languages" class="languages" onchange="changeLanguage()">
                                <option value="c">C</option>
                                <option value="cpp">C++</option>
                                <option value="php">PHP</option>
                                <option value="python">PYTHON</option>
                                <option value="node">JavaScript</option>
                                <option value="sql">Sql</option>
                                <option value="html">Html</option>
                                <option value="css">Css</option>
                            </select>
                        </div>
                        <div class="editor" id="editor"></div>
                        <div class="button-container">
                            <form action="" method="" id="savecontent" name="savecontent">
                                @csrf
                                <input type="hidden" name="savedid" value="" id="saveidform">
                                <button type="submit" id="savecontentbutton" class="btn btn-success text-dark">Save File</button>
                            </form>
                        </div>
                    </div>
                    <div class="row comments">
                        <h1>Comments</h1>
                        <form action="" method="" id="savecomment" style="margin-left:22px;" name="savecomment">
                            <textarea name="comment" placeholder="Add your comments here........" id="comment" cols="180" rows="5" style="margin-top: 10px; margin-bottom:10px;"></textarea>
                            <input type="hidden" name="savedid1" value="" id="saveidform1">
                            <button type="submit" id="savecommentbutton" class="btn btn-primary text-dark" >Add Comment</button>
                        </form>
                    </div>
                    <footer style="margin-top: 30px;">
                        Copyright
                    </footer>
                </div>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('lib/ace.js') }}"></script>
        <script src="{{ asset('lib/theme-monokai.js') }}"></script>
        <script type="text/javascript">
            var isFileContentChanged = false;
            var tabsData;
function createTab(tabData) {
    var tabHtml = `<li class="nav-item nav-tab active openedf" onclick="selectFile(event, ${tabData.id})">
                        <a class="nav-link " aria-current="page" id=${tabData.id}>${tabData.name}</a>
                    </li>`
    if($("#openfiles").find(`#${tabData.id}`).length === 0)
    {
        $("#openfiles").append(tabHtml)
        selectFile(event,tabData.id)
    }
}

function selectFile(evt, fileid) {
    var alreadyContent = tabsData[2][0]!==undefined ? tabsData[2][0].file_content : ""
    console.log(alreadyContent,editor.getValue())
    isFileContentChanged = editor.getValue() == alreadyContent
    console.log(isFileContentChanged)
    if(isFileContentChanged){
        var confirmmassage = confirm('Save your file before leaving')
        if(confirmmassage){
            return
        }
    }
  var i, tabcontent, tablinks;
  document.getElementById("saveidform").value = fileid;
  document.getElementById("saveidform1").value = fileid;
  getDataForFile(fileid)
  tablinks = document.getElementsByClassName("openedf");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  console.log($(`#${fileid}`).parent())
  $(`#${fileid}`).parent()[0].className += " active";
}

function getDataForFile(fileid){
    $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
  $.ajax({
                    type: 'post',
                    url: "/getdata",
                    data: {
                        file: fileid
                    },
                    success: function(data) {
                        console.log(data)
                        tabsData = data
                        var alreadyContent = data[2][0]!==undefined ? data[2][0].file_content : ""
                        editor.setValue(alreadyContent)
                        // var txt3 = `<li></li>`; 
                        // $("#folder_li").append(txt3);
                    }
                })
            });
}

function myFunction(id) {
  var _x_ = document.getElementById(id).style.display;

  if( _x_ == 'none')
  {
    document.getElementById(id).style.display = 'block';
  }
  else
  {
    document.getElementById(id).style.display = 'none';
  }
}
                // creating folder ajax

            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#submit').on('click', function(e) {
                    e.preventDefault();
                    var form_name = document.getElementById('foldername').value;
                var user_id = document.getElementById('user_foldername').value;
                    $.ajax({
                    type: 'post',
                    url: "/createfolder",
                    data: {
                        folder: form_name,
                        user: user_id
                    },
                    success: function(data) {
                        document.getElementById('foldername').value = '';
                        console.log(data)
                        var txt1 = `<a class="nav-link" aria-current="page" href="#" style="display:flex"><img src="{{ asset('image/folder.png') }}" width="20px" alt="">${form_name}</a>`; 
                        $("#folder_li").append(txt1);
                    }
                })
                });
            });

            function createFolder() {
                document.getElementById('createfolder').style.display = "block";
                document.getElementById('createlink').style.display = "none";
            }



            // creating file system  

            let folderidfile;
            function createFile(folderid) {
                folderidfile = folderid;
                document.getElementById('createfolder').style.display = "none";
                document.getElementById('createlink').style.display = "none";
                document.getElementById('createfile').style.display = "block";
            }

            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#filesubmit').on('click', function(event) {
                    event.preventDefault();
                    var file_name = document.getElementById('filename').value;
                    var user_id = document.getElementById('user_filename').value;
                    $.ajax({
                    type: 'POST',
                    url: "createfile",
                    data: {
                        filename: file_name,
                        user: user_id,
                        parentFolder: folderidfile
                    },
                    success: function(data) {
                        document.getElementById('filename').value = '';
                      console.log(data)
                      var txt2 = `<a href="" style="display:flex" ><img src="{{ asset('image/file.png') }}" width="20px" alt="">${file_name}</a>`;
                      $(`#${data.parent_folder}`).append(txt2);
                    }
                })
                });
            });




            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#savecontentbutton').on('click', function(event) {
                    event.preventDefault();
                    var file_name = document.getElementById("saveidform").value;
                    var datatosave = editor.getValue();
                    console.log(file_name,datatosave)
                    $.ajax({
                    type: 'POST',
                    url: "savefile",
                    data: {
                        filename: file_name,
                        file_content: datatosave
                    },
                    success: function(data) {
                        // document.getElementById('filename').value = '';
                      console.log(data)
                    //   var txt2 = `<a href="" style="display:flex" ><img src="{{ asset('image/file.png') }}" width="20px" alt="">${file_name}</a>`;
                    //   $(`#${data.parent_folder}`).append(txt2);
                    }
                })
                });
            });







            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#savecommentbutton').on('click', function(event) {
                    event.preventDefault();
                    var file_name = document.getElementById("saveidform1").value;
                    var comment = document.getElementById("comment").value;
                    $.ajax({
                    type: 'POST',
                    url: "savecomment",
                    data: {
                        filename: file_name,
                        comment: comment
                    },
                    success: function(data) {
                        // document.getElementById('filename').value = '';
                      console.log(data)
                    //   var txt2 = `<a href="" style="display:flex" ><img src="{{ asset('image/file.png') }}" width="20px" alt="">${file_name}</a>`;
                    //   $(`#${data.parent_folder}`).append(txt2);
                    }
                })
                });
            });





            let editor;

            window.onload = function() {
                editor = ace.edit("editor");
                editor.setTheme('ace/theme/monokai');
                editor.session.setMode('ace/mode/c_cpp');
            }

            function changeLanguage() {
                let language = $("#languages").val();

                if (language == 'c' || language == 'cpp') editor.session.setMode("ace/mode/c_cpp");
                else if (language == 'php') editor.session.setMode("ace/mode/php");
                else if (language == 'python') editor.session.setMode("ace/mode/python");
                else if (language == 'node') editor.session.setMode("ace/mode/javascript");
                else if (language == 'sql') editor.session.setMode("ace/mode/sql");
                else if (language == 'html') editor.session.setMode("ace/mode/html");
                else if (language == 'css') editor.session.setMode("ace/mode/css");
            }
        </script>
</x-app-layout>