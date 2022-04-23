<?php

namespace App\Domain\Note;

final class Note
{

    private $id;
    private $id_user;
    private $title;
    private $content;

    public function __construct($id, $id_user, $title, $content){
        $this->id = $id;
        $this->id_user = $id_user;
        $this->title = $title;
        $this->content = $content;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId_user(){
        return $this->id_user;
    }

    public function setId_user($id_user){
        $this->id_user = $id_user;
        return $this;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    
    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
    }
}