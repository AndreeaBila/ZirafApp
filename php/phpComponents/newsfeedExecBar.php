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
    <div class="col-12">
    <button type="button" class="btn btn-lg float-right" id="postAnnouncementBtn">Post</button>
    </div>
    <div class="clear"></div>
</div>

<!-- UPLOAD PICTURE BOX -->
<div class="newsfeedAddPost row" id="uploadPicture">
    <div class="custom-file form-control-lg">
    <input type="file" class="custom-file-input" id="customFile">
    <span class="custom-file-control"></span>
    
    </label>
    </div>
    <textarea name="pictureTextarea" id="pictureTextarea" cols="30" rows="2" placeholder="Description" class="form-control form-control-lg"></textarea>
    <div class="col-12">
    <button type="button" class="float-right btn btn-lg" id="postPictureBtn">Post</button>
    </div>
    <div class="clear"></div>
</div>

<!-- CREATE POLL BOX -->
<div class="newsfeedAddPost row" id="createPoll">
    <input type="text" class="form-control form-control-lg" id="pollQuestion" placeholder="Poll Question">
    <input type="text" class="form-control form-control-lg" id="pollOptionInput" placeholder="Poll Option">
    <textarea name="pictureTextarea" id="pollTextarea" cols="30" rows="2" placeholder="Description" class="form-control form-control-lg"></textarea>
    <div class="col-12">
    <button type="button" class="float-right btn btn-lg" id="postPollBtn">Post</button>
    </div>
    <div class="clear"></div>
</div>

<!-- The js script for this file -->
<script src="../js/newsfeedExecBar.js"></script>