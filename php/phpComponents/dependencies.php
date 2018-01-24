<?php
    //list of structures used to manipulate information for basic table objects
    
    //=================================//

    //user dependecy
    class User{
        private $userId;
        private $userName;
        private $email;
        private $password;
        private $socialHandle;
        private $description;
        private $phone;
        private $rank;
        private $score;
        private $clearance;
        private $salt;
        private $activationKey;
        private $emailActivation;
        private $execActivation;
        private $dateJoined;

        //constructor
        public function __construct($userId, $userName, $email, $password, $socialHandle, $description, $phone, $rank, $score, $clearance, $salt, $activationKey, $emailActivation, $execActivation, $dateJoined){
            $this->userId = $userId;
            $this->userName = $userName;
            $this->email = $email;
            $this->password = $password;
            $this->socialHandle = $socialHandle;
            $this->description = $description;
            $this->phone = $phone;
            $this->rank = $rank;
            $this->score = $score;
            $this->clearance = $clearance;
            $this->salt = $salt;
            $this->activationKey = $activationKey;
            $this->emailActivation = $emailActivation;
            $this->execActivation = $execActivation;
            $this->dateJoined = $dateJoined;
        }

        public function getUserData(){
            $userInfo = array("userId" => $this->userId,
                              "userName" => $this->userName,
                              "email" => $this->email,
                              "password" => $this->password,
                              "socialhandle" => $this->socialHandle,
                              "desciption" => $this->description,
                              "phone" => $this->phone,
                              "rank" => $this->rank,
                              "score" => $this->score,
                              "clearance" => $this->clearance,
                              "salt" => $this->salt,
                              "activationKey" => $this->activationKey,
                              "emailActivation" => $this->emailActivation,
                              "execActivation" => $this->execActivation,
                              "dateJoined" => $this->dateJoined);
            return $userInfo;
        }
    }

    //=================================//

    //badge dependency
    class Badge{
        private $badgeId;
        private $badgeTitle;
        private $badgeContent;

        public function __construct($badgeId, $badgeTitle, $badgeContent){
            $this->badgeId = $badgeId;
            $this->badgeTitle = $badgeTitle;
            $this->badgeContent = $badgeContent;
        }

        public function getBadgeData(){
            $badgeInfo = array("badgeId" => $this->badgeId,
                               "badgeTitle" => $this->badgeTitle,
                               "badgeContent" => $this->badgeContent);
            return $badgeInfo;
        }
    }

    //=================================//

    //chat dependency
    class Chat{
        private $chatId;
        private $chatName;
        private $dateCreated;

        public function __construct($chatId, $chatName, $dateCreated){
            $this->chatId=chatId;
            $this->chatName=chatName;
            $this->dateCreated=dateCreated;
        }

        public function getChatData(){
            $chatInfo = array("chatId" => $this->chatId,
                              "chatName" => $this->chatName,
                              "dateCreated" => $this->dateCreated);
            return $chatInfo;
        }
    }

    //=================================//

    //message dependency
    class Message{
        private $messageId;
        private $userId;
        private $chatId;
        private $content;
        private $dateCreated;

        public function __construct($messageId, $userId, $chatId, $content, $dateCreated){
            $this->messageId = $messageId;
            $this->userId = $userId;
            $this->chatId = $chatId;
            $this->content = $content;
            $this->dateCreated = $dateCreated;
        }

        public function getMessageData(){
            $messageInfo = array("messageId" => $this->messageId,
                                 "userId" => $this->userId,
                                 "chatId" => $this->chatId,
                                 "content" => $this->content,
                                 "dateCreated" => $this->dateCreated);
            return $messageInfo;
        }
    }

    //=================================//

    //poll dependency
    class Poll{
        private $pollId;
        private $pollStatement;
        private $pollDescription;
        private $totalVotes;
        private $likes;
        private $dateCreated;
        private $userId;
        private $userName;
        private $iconExtension;

        public function __construct($pollId, $pollStatement, $pollDescription, $totalVotes, $likes, $dateCreated, $userId, $userName, $iconExtension){
            $this->pollId = $pollId;
            $this->pollStatement = $pollStatement;
            $this->pollDescription = $pollDescription;
            $this->totalVotes = $totalVotes;
            $this->likes = $likes;
            $this->dateCreated = $dateCreated;
            $this->userId = $userId;
            $this->userName = $userName;
            $this->iconExtension = $iconExtension;
        }

        public function getPollData(){
            $pollInfo = array("pollId" => $this->pollId,
                              "pollStatement" => $this->pollStatement,
                              "pollDescription" => $this->pollDescription,
                              "totalVotes" => $this->totalVotes,
                              "likes" => $this->likes,
                              "dateCreated" => $this->dateCreated,
                              "userId" => $this->userId,
                              "userName" => $this->userName,
                              "iconExtension" => $this->iconExtension);
            return $pollInfo;
        }
    }

    //=================================//

    //poll_option dependency
    class PollOption{
        private $optionId;
        private $pollId;
        private $content;
        private $votes;

        public function __construct($optionId, $pollId, $content, $votes){
            $this->optionId = $optionId;
            $this->pollId = $pollId;
            $this->content = $content;
            $this->votes = $votes;
        }

        public function getPollOptionData(){
            $pollOptionInfo = array("optionId" => $this->optionId,
                                    "pollId" => $this->pollId,
                                    "content" => $this->content,
                                    "votes" => $this->votes);
            return $pollOptionInfo;
        }
    }

    //=================================//

    //post dependency
    class Post{
        private $postId;
        private $content;
        private $dateCreated;
        private $likes;
        private $userId;
        private $userName;
        private $iconExtension;

        public function __construct($postId, $content, $dateCreated, $likes, $userId, $userName, $iconExtension){
            $this->postId = $postId;
            $this->content = $content;
            $this->dateCreated = $dateCreated;
            $this->likes = $likes;
            $this->userId = $userId;
            $this->userName = $userName;
            $this->iconExtension = $iconExtension;
        }

        public function getPostData(){
            $postInfo = array("postId" => $this->postId,
                              "content" => $this->content,
                              "dateCreated" => $this->dateCreated,
                              "likes" => $this->likes,
                              "userId" => $this->userId,
                              "userName" => $this->userName,
                              "iconExtension" => $this->iconExtension);
            return $postInfo;
        }
    }

    //=================================//

    //imageUpload dependency
    class ImageUpload{
        private $imageId;
        private $fileName;
        private $description;
        private $dateCreated;
        private $likes;
        private $userId;
        private $userName;
        private $iconExtension;

        public function __construct($imageId, $fileName, $description, $dateCreated, $likes, $userId, $userName, $iconExtension){
            $this->imageId = $imageId;
            $this->fileName = $fileName;
            $this->description = $description;
            $this->dateCreated = $dateCreated;
            $this->likes = $likes;
            $this->userId = $userId;
            $this->userName = $userName;
            $this->iconExtension = $iconExtension;
        }

        public function getImageUploadData(){
            $imageUploadInfo = array('imageId' => $this->imageId,
                                     'fileName' => $this->fileName,
                                     'description' => $this->description,
                                     'dateCreated' => $this->dateCreated,
                                     'likes' => $this->likes,
                                     'userId' => $this->userId,
                                     'userName' => $this->userName,
                                     'iconExtension' => $this->iconExtension);
            return $imageUploadInfo;
        }
    }

    //=================================//

    //review dependency
    class Review{
        private $reviewId;
        private $locationName;
        private $dishList;
        private $foodRating;
        private $ambienceRating;
        private $serviceRating;
        private $valueForMoney;
        private $foodReview;
        private $xFactor;
        private $imageNameList;
        private $dateCreated;

        public function __construct($reviewId, $locationName, $dishList, $foodRating, $ambienceRating, $serviceRating, $valueForMoney, $foodReview, $imageNameList, $xFactor, $dateCreated){
            $this->reviewId = $reviewId;
            $this->locationName = $locationName;
            $this->dishList = $dishList;
            $this->foodRating = $foodRating;
            $this->ambienceRating = $ambienceRating;
            $this->serviceRating = $serviceRating;
            $this->valueForMoney = $valueForMoney;
            $this->foodReview = $foodReview;
            $this->imageNameList = $imageNameList;
            $this->xFactor = $xFactor;
            $this->dateCreated = $dateCreated;
        }

        public function getReviewData(){
            $reviewInfo = array("reviewId" => $this->reviewId,
                                "locationName" => $this->locationName,
                                "dishList" => $this->dishList,
                                "foodRating" => $this->foodRating,
                                "ambienceRating" => $this->ambienceRating,
                                "serviceRating" => $this->serviceRating,
                                "valueForMoney" => $this->valueForMoney,
                                "foodReview" => $this->foodReview,
                                "imageNameList" => $this->imageNameList,
                                "xFactor" => $this->xFactor,
                                "dateCreated" => $this->dateCreated);

            return $reviewInfo;
        }
    }

    class Dish{
        private $dishId;
        private $dishName;
        private $reviewId;

        public function __construct($dishId, $dishName, $reviewId){
            $this->dishId = $dishId;
            $this->dishname = $dishName;
            $this->reviewId = $reviewId;
        }

        public function getDishData(){
            $dishArray = array(
                "dishId" => $this->dishId,
                "dishName" => $this->dishName,
                "reviewId" => $this->reviewId
            );

            return $dishArray;
        }
    }
?>