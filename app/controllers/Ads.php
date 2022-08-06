<?php
class Ads extends Controller
{
    public function add()
    {
        $data=[];
        $ads = $this->model('AdsModel');
        $ads->setText($text);
        $isValid = $ads->validForm();
        if ($isValid == "Ваше объявление опубликуется после проверки модератором") {
			$ads->addAds();
			$data['success'] = $isValid;
        }
        $this->view('ads/index', $data, $ads->getCategory(), $ads->addingWithoutConfirmation(), $ads->commentsUsers()); 
       
    }
	
    public function myads()
    {    
        $ads = $this->model('AdsModel'); 
        $this->view('ads/myads', $ads->myads(), $ads->getCategory(), $ads->commentsUsers());
    } 
    
    public function delete()
    {    
        $ads = $this->model('AdsModel'); 
        $this->view('ads/delete', $ads->deleteOneAd());
    } 
	
    public function raise()
    {    
        $ads = $this->model('AdsModel'); 
        $this->view('ads/raise', $ads->raiseUp());
    }
	
    public function new()
    {    
        $new = $this->model('AdsModel');
        $this->view('ads/newads', $new->newAds());
		
    }
	
    public function moderation()
    {    
        $ad = $this->model('AdsModel');
		$this->view('ads/moderation', $ad->moderation((int) $qty));
    }
	
    public function main()
    {    
        $ad = $this->model('AdsModel');
        $this->view('ads/main', $ad->moderationMain($qty_main));
    }
    
    public function category()
    {    
        $ad = $this->model('AdsModel');
        $this->view('ads/category', $ad->categoryGetContent(), $ad->getCategory(), $ad->pagination(), $ad->commentsUsers());
    }
    
    
    public function automatic()
    {
        $ads = $this->model('AdsModel');
        $this->view('ads/automatic', $ads->automaticLifting($data_raise_vip, $data_omit_vip, $time_raise_vip));   
    }
    
}