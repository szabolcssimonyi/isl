<?php
require_once(__DIR__ . '/ModelBase.php');

class Users extends ModelBase{

    public function getQuery() {
        return "SELECT name, email, count(forms.id) as forms, sum(forms.downloads) as downloads, modified 
                FROM isl.users 
                LEFT JOIN forms ON forms.user_id=users.id
                GROUP BY users.id
                LIMIT :from,:to";
    }
    
    public function getDownloads(){
        $this->query="SELECT users.name,year(downloads.created) as year, month(downloads.created) as month, 
                        count(downloads.created) as downloads
                    FROM users 
                    LEFT JOIN downloads ON users.id=downloads.user_id
                    GROUP BY users.id, year(downloads.created), month(downloads.created)
                    LIMIT :from,:to;";
        return $this->getItems();
    }
    
    public function getFavorites(){
        $this->query="SELECT forms.title,users.name,count(clicks.id) as clicks
                        FROM (
                                SELECT id,user_id,form_id FROM downloads 
                                    WHERE year(downloads.created)=year(now()) 
                                        AND month(downloads.created)=month(now())
                              ) as clicks
                    INNER JOIN forms on forms.id=clicks.form_id
                    INNER JOIN users on users.id=clicks.user_id
                    GROUP BY forms.id, users.id
                    LIMIT 10;";
        $this->data=[];
        return $this->getItems();
    }
    
}