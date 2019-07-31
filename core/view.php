<?php

class View{

    private $path;

    public function __construct(){
        $this->path = Path::getInstance();
    }

    function generate($content_view, $template_view, $data = null){

        include $this->path->getPath("view", $template_view );
    }

    function generateErrorView($content_view){
        include $this->path->getPath("view_error", $content_view);
    }
}