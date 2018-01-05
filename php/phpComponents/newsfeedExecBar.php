<!-- ONLY VISIBLE FOR EXEC -->
<div id="newsfeedMenu" class="row">
    <button class="col-4 text-center" id="openAnnouncementBoxBtn">
    <p><i class="fa fa-bullhorn" aria-hidden="true"></i></p>
    <p>Write</p>
    <p>Announcement</p>
    </button>

    <button class="col-4 text-center" id="openPictureBoxBtn">
    <p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
    <p>Upload</p>
    <p>Picture</p>
    </button>

    <button class="col-4 text-center" id="openPollBoxBtn">
    <p><i class="fa fa-bar-chart" aria-hidden="true"></i></p>
    <p>Create</p>
    <p>Poll</p>
    </button>
</div>

<!-- WRITE ANNOUNCEMENT BOX -->
<div class="newsfeedAddPost row" id="writeAnnouncement">
    <textarea name="announcementTextarea" id="announcementTextarea" placeholder="Write Announcement..." class="form-control form-control-lg"></textarea>
    <div id="noMessageNewsfeedAlert" class="alert alert-danger alert-dismissible fade show col-12" role="alert">
        <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> No message entered
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="col-12">
        <button type="button" class="btn btn-lg bgZiraf float-right postBtn" id="postAnnouncementBtn">Post</button>
    </div>
    <div class="clear"></div>
</div>

<!-- UPLOAD PICTURE BOX -->
<div class="newsfeedAddPost row" id="uploadPicture">
    <form action="./phpDirectives/uploadImagePost.php" method="POST" enctype="multipart/form-data" name="uploadImagePostForm" id="uploadImagePostForm">
        <input id="upfile" name="upfile" type="file" value="upload"/>
        <textarea name="pictureTextarea" id="pictureTextarea" cols="30" rows="2" placeholder="Description" class="form-control form-control-lg"></textarea>
        
        <div id="noPictureAlert" class="alert alert-danger alert-dismissible fade show col-12" role="alert">
            <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> No picture uploaded
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div id="invalidFileNewsfeedAlert" class="alert alert-danger alert-dismissible fade show col-12" role="alert">
            <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> Invalid file type uploaded
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <input type="submit" value='Post' class='btn btn-lg bgZiraf float-right postBtn' id="postPictureBtn">
    </form>
    <!-- <div class="custom-file form-control-lg">
        <input type="file" class="custom-file-input" id="customFile">
        <span class="custom-file-control"></span>
    </div> -->
        
    <!-- <div class="col-12">
        <button type="button" class="float-right btn btn-lg bgZiraf postBtn" id="postPictureBtn">Post</button>
    </div> -->
    <div class="clear"></div>
</div>

<!-- CREATE POLL BOX -->
<div class="newsfeedAddPost row" id="createPoll">
    <input type="text" class="form-control form-control-lg" id="pollQuestion" placeholder="Poll Question">
    <div id="pollQuestionAlert" class="alert alert-danger alert-dismissible fade show col-12" role="alert">
        <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> You must provide a poll question
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="input-group mb-3">
        <input type="text" class="form-control form-control-lg" id="pollOptionInput" placeholder="Poll Option">
        <button type="button" class="btn plusBtn bgGreen" id="addPollOptionBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
    </div>

    <div id="pollOptionsAlert" class="alert alert-danger alert-dismissible fade show col-12" role="alert">
        <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> No poll options provided
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
    <!-- Display of options already added -->
    <div id="addedPollOptions">
        <!-- <div class="addedPollOptionsContainer row">
            <p class="addedPollOptions col-8">Abc</p>
            <button type="button" class="removeAddedPollOption col-4">remove &times;</button>
        </div> -->

    </div>
    

    <textarea name="pictureTextarea" id="pollTextarea" cols="30" rows="2" placeholder="Description" class="form-control form-control-lg"></textarea>
    
    <div class="col-12">
        <button type="button" class="float-right btn btn-lg bgZiraf postBtn" id="postPollBtn">Post</button>
    </div>
    <div class="clear"></div>
</div>

<!-- The js script for this file -->
<script src="../js/newsfeedExecBar.js"></script>