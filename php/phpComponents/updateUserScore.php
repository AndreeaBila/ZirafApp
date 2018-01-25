<?php
    function update($score, $db, $userId){
        //update the score
        $query = "UPDATE USERS SET score = score + ? WHERE userId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $score, $userId);
        $stmt->execute();
        $stmt->close();

        //get the user's current score
        $query = "SELECT score, rank FROM USERS WHERE userId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $stmt->bind_result($score, $rank);
        $stmt->fetch();
        $stmt->close();

        //check the type of score and update it
        if($score >= 0 && $score < 200){
            $supposedRank = "Newbie";
        }elseif($score >= 200 && $score < 500){
            $supposedRank = "Fan";
        }elseif($score >= 500 && $score < 1000){
            $supposedRank = "Pro";
        }elseif($score >= 1000 && $score < 2000){
            $supposedRank = "Superstar";
        }elseif($score >= 2000 && $score < 4000){
            $supposedRank = "Hardcore";
        }elseif($score >= 4000 && $score < 7500){
            $supposedRank = "All-Star";
        }elseif($score >= 7500 && $score < 12000){
            $supposedRank = "Elite";
        }elseif($score >= 12000 && $score < 20000){
            $supposedRank = "Ultimate";
        }elseif($score >= 20000){
            $supposedRank = "Master";
        }
        

        //if the rank it's not the same as the supposed rank then update
        if($rank !== $supposedRank){
            $query = "UPDATE USERS SET rank = ? WHERE userId = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("ss", $supposedRank, $userId);
            $stmt->execute();
            $stmt->close();
        }
    }
?>