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

    .editior{
        display: flex;
        align-items: center;
        margin-top: 20px;
        flex-direction: column;
    }

    .top-header {
    font-size: 25px !important;
}
</style>
<x-app-layout>
    <div class="row">
        <div class="col-md-3 offset-1">
            <ul class="nav flex-column" id="sidebar">
                <h4>Folders</h4>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Folder1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Folder2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Folder3</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Folder4</a>
                </li>
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

                
                <h1 class="top-header">Add Your code to save your file on save my code</h1>
                <textarea id="textarea1" class="input shadow" name="name" rows="15" placeholder="Your text here ">
                </textarea>
                </div>
            </div>

        </div>

</x-app-layout>