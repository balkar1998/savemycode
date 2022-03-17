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
                    </div>
                    @foreach($data as $item)
                    <li class="nav-item" id="folder_li">
                        <a class="nav-link active" aria-current="page" style="display:flex"  onclick="myFunction('{{$item->id}}')"><img src="{{ asset('image/folder.png') }}" width="20px" alt="">{{ $item->name }}</a>
                        <li class="file_li" id="{{$item->id}}" style="display: none;">
                           <a href="" style="display:flex" ><img src="{{ asset('image/file.png') }}" width="20px" alt="">dfsfsdf</a> 
                           <a href="" style="display:flex" ><img src="{{ asset('image/file.png') }}" width="20px" alt="">dfsfsdf</a> 
                           <a href="" style="display:flex" ><img src="{{ asset('image/file.png') }}" width="20px" alt="">dfsfsdf</a> 
                        </li>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <ul class="nav nav-tabs">
                        <li class="nav-item nav-tab">
                            <a class="nav-link " aria-current="page" href="#">Tab1</a>
                        </li>
                        <li class="nav-item nav-tab">
                            <a class="nav-link" href="#">tab2</a>
                        </li>
                        <li class="nav-item nav-tab">
                            <a class="nav-link" href="#">tab3</a>
                        </li>
                        <li class="nav-item nav-tab">
                            <a class="nav-link disabled">tab4</a>
                        </li>
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
                        <div class="button-container">Save File</div>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('lib/ace.js') }}"></script>
        <script src="{{ asset('lib/theme-monokai.js') }}"></script>
        <script type="text/javascript">

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
                        var txt1 = `<a class="nav-link active" aria-current="page" href="#" style="display:flex"><img src="{{ asset('image/folder.png') }}" width="20px" alt="">${form_name}</a>`; 
                        $("#folder_li").append(txt1);
                    }
                })
                });
                

            });

            function createFolder() {
                document.getElementById('createfolder').style.display = "block";
                document.getElementById('createlink').style.display = "none";
            }

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