<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{asset('css/styles.css')}}">

<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav flex-column" id="sidebar">
                    <div class="d-flex p-2 align-items-center folder-header">
                        <h4 class="navbar-brand">Folders</h4>
                        <button class="btn btn-primary text-center" id="createlink" onClick="createFolder()">Create folder</button>
                        <form class="create-file-folder" action="" method="" name="createfolder" id="createfolder" style="display: none;">
                            @csrf
                            <div class="formfolder">
                                <input class="input-file-folder" type="text" id="foldername" name="foldername" value="" placeholder="folder name">
                                <input type="hidden" name="user_id" id="user_foldername" value="{{ Auth::user()->id }}">
                                <button type="submit" id="submit"><img src="{{ asset('image/add-folder.png') }}" width="30px" alt=""></button>
                                <button type="button"><img src="{{ asset('image/x.png') }}" width="20px" alt=""></button>
                            </div>
                        </form>
                        <form action="" method="" name="createfile" id="createfile" style="display: none;">
                            @csrf
                            <div class="formfolder">
                                <input class="input-file-folder" type="text" id="filename" name="filename" value="dsfsd" placeholder="file name">
                                <input type="hidden" name="user_id" id="user_filename" value="{{ Auth::user()->id }}">
                                <button type="submit" id="filesubmit"><img src="{{ asset('image/add-folder.png') }}" width="30px" alt=""></button>
                                <button type="button"><img src="{{ asset('image/x.png') }}" width="20px" alt=""></button>
                            </div>
                        </form>
                    </div>
                    @foreach($data as $item)
                    <li class="nav-item" id="folder_li">
                        <a class="nav-link ml-1" aria-current="page" style="display:flex;justify-content:space-between;align-items: center;" onclick="myFunction('{{$item->id}}')">
                            <div style="display: flex;"><img class="mr-5" src="{{ asset('image/folder.png') }}" width="20px" alt=""><span class="ml-2">{{ $item->name }}</span></div><img onclick="deleteFolder({{$item->id}})" src="{{ asset('image/x.png') }}" width="15px" alt="">
                        </a>
                    <li class="file_li" id="{{$item->id}}" style="display: none;">
                        <div class="ml-5" style="display:flex; margin-left:1em;" onclick="createFile({{$item->id}})"><img src="{{ asset('image/plus.png') }}" class="ml-5" width="20px" alt="">Create new file</div>
                        @foreach($innerdata as $inneritem)
                        @if($inneritem->parent_folder == $item->id)
                        <a class="ml-5" onclick="createTab({{$inneritem}})" style="display:flex;justify-content: space-between;align-items: center;">
                            <div style="display: flex;"><img src="{{ asset('image/file.png') }}" width="20px" alt="">{{ $inneritem->name }}</div><img onclick="deleteFile({{$inneritem->id}})" src="{{ asset('image/x.png') }}" width="8px" alt="">
                        </a>
                        @endif
                        @endforeach
                    </li>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">
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
                    <div class="commentsshow">
                        <div class="header">Comments</div>
                        <!-- view single comment -->
                        <div class="comment-container"></div>
                        <div class="row comments">
                            <form action="" method="" id="savecomment" name="savecomment">
                                <textarea name="comment" placeholder="Add your comments here........" id="comment" cols="180" rows="5" style="margin-top: 10px; margin-bottom:10px;"></textarea>
                                <input type="hidden" name="savedid1" value="" id="saveidform1">
                                <button type="submit" id="savecommentbutton" class="btn btn-primary text-dark">Add Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
                <div class="container">
                    <span class="text-muted">&copy; 2022 Save My Code Editor</span>
                </div>
            </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('lib/ace.js') }}"></script>
    <script src="{{ asset('lib/theme-monokai.js') }}"></script>
    <script src="{{ asset('js/newsavecode.js') }}"></script>
    <script src="{{ asset('js/editorscript.js') }}"></script>
</x-app-layout>