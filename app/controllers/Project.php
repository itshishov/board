<?php

class Project extends Controller
{
    public function index() 
    {
		 $row = $this->model('ProjectModel');
		 $this->view('project/index', $row->getCategory(), $row->maingetAds(),$row->commentsUsers());    
    }
   
}