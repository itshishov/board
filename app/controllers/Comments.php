<?php
class Comments extends Controller
{
	
        public function index()
        {
            $mess = [];
            $comments = $this->model('CommentsModel');
            $comments->getFromForm($text);
            $validComment=$comments->validComment();
            if ($validComment == "Ваш комментарий отправлен на проверку") {
                $comments->addComment();
                $mess["success"] = $validComment;
            }
            $this->view('comments/index',$comments->getCategory(), 
            $comments->rules(), $comments->getContent(), $comments->getComment(), $comments->vipUsers(),$mess);
        }
    
        public function new()
        {  
            $comments = $this->model('CommentsModel');
            $this->view('comments/new', $comments->newComment());    
        }
    
        public function moderation()
        { 
            $comments = $this->model('CommentsModel');
            $this->view('comments/moderation', $comments->moderationComment());
        }
    
        public function ads()
        {
            $comments = $this->model('CommentsModel');
            $this->view('comments/ads', $comments->getCategory(), $comments->vipUsers(),$comments->commentsUsers()); 
        }
    
        public function delete()
        {
            $comments = $this->model('CommentsModel');
            $this->view('comments/delete', $comments->delete());  
        }

}