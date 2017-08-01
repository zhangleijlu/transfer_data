<?php

class mainTransfer {
    private $h;
    function __construct(){
        spl_autoload_register(array($this, 'loadClass'));
        $this->h = new mysqli("180.76.174.128", "root", "171play", "zawenblog_ori");

    }

    function main(){
        $this->getOri();

    }

    function getOri(){
        $sql = "SELECT * FROM `content_ori` WHERE `status` = 0";
        $res = $this->h->query($sql);
        return $res;
    }

    function mainParse(){

    }

    //  function

    function loadClass($className){
        include $className . '.php';
    }

}



