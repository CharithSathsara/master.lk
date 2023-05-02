<?php

class instituteDetails
{
        public static function getInstituteDetails($connection){

            $query = "SELECT * FROM institute_details";

            $data = $connection->query($query);

            if ($data){
                return $data;
            }else{
                return false;
            }
        }

        public static function addInstituteDetails($connectopn,$instituteName,$number,$email,$fax,$address01,$address02){

            $query = "INSERT INTO institute_details (`instituteName`,`email`,`number`,`fax`,`address01`,`address02`) VALUES ('$instituteName','$email','$number','$fax','$address01','$address02')";

            $data = $connectopn->query($query);

            if($data){
                return true;
            }else{
                return false;
            }
        }

        public static function updateInstituteDetails($connection,$instituteName,$number,$email,$fax,$address01,$address02){

            $query = "UPDATE institute_details
                       SET instituteName ='$instituteName' ,email='$email',number='$number',fax='$fax',address01='$address01',address02='$address02'";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                return false;
            }
        }
}