<?php

class Topic{

    public static function getAllTopics($connection, $subject){

        $query = "SELECT topicId, topicTitle From topic 
                  WHERE lessonId IN (SELECT lessonId From lesson 
                                     WHERE subjectId = (SELECT subjectId From subject  
                                                        WHERE subjectTitle = '$subject'))";
        $data = $connection->query($query);

        return $data;

    }

}