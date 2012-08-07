<?php
class page_blog_view extends AWPage {
	function init(){
		parent::init();
		
		$this->js(true)->_selector('#nav')->find('a[title|=Blog]')->parent()->addClass('current-ancestor');
		
		$blog_url = $_GET['url'];
		/*
		$blogModel = $this->add('Model_Blog');
		$arrData   = $blogModel->getById($blog_id);
		*/
		$blogModel = $this->add('Model_Blog');
		$arrData   = $blogModel->getByUrl($blog_url);
		
		if ($arrData) {
		
			$this->api->html_title = $arrData['html_title'];
			$this->api->html_descr = $arrData['html_descr'];
			$this->api->html_keywords = $arrData['html_keywords'];

			if ($this->api->auth->isLoggedIn()){
				$this->add('AWEditable')->enableAdmin('admin/blog', Array('id' => $arrData['id']));
			}
			
            /*
			if ($arrData['is_commented'] != 'Y'){
				$this->template->tryDel('CommentFormContainer');
			} else {
				$this->template->tryDel('DisabledContainer');
			}
			if ($arrData['is_show_comments'] != 'Y'){
				$this->template->tryDel('CommentContainer');
			}
             */
			
			$prev = $blogModel->getNavigation($arrData['date'], 'prev');
			if ($prev) {
				$str = '<h3 class="prev">&larr; <a href="/blog/' . $prev['url'] . '">' . $prev['formated_date'] . '</a></h3>';
				$this->template->trySet('BlogBefore', $str);
			}
			
			$after = $blogModel->getNavigation($arrData['date'], 'next');
			if ($after) {
				$str = '<h3 class="next"><a href="/blog/' . $after['url'] . '"">' . $after['formated_date'] . '</a> &rarr;</h3>';
				$this->template->trySet('BlogNext', $str);
			}
		
			// var_dump($arrData);
			foreach ($arrData as $_k => $_v) {
				if ($_k == 'header_image' && '' == trim($_v)){
					continue;
				}
				$this->template->trySet('Blog' . ucfirst(strtolower($_k)), $_v);
			}

			if (trim($arrData['custom_view'])){
				$v=$this->add('View', 'custom_view','BlogCustomView',array('view/blog/' . $arrData['custom_view'], '_top'));
			}
		
			// $commentModel = $this->add('Model_Comment');
			// $arrComments  = $commentModel->getByBlogId($arrData['id']);
			if ($this->api->auth->isLoggedIn()){
				// $arrComments->add('AWEditable')->enableAdmin('admin/blog');
			}
			
			$c = $this->add('Comment','Comment','Comment','Comment');
			$c->add('AWEditable')->enableAdmin('admin/comment', Array('blog_id' => $arrData['id']));
			
			$this->api->stickyGET('url');
            /* comments disabled
			// $f = $this->add('AWForm', null, 'CommentForm');
			$f = $this->add('AWForm', null, 'CommentForm', Array('page/blog_comment_form', '_top'));
            // add('ASForm',null,null,array('form/blogcomment','_top'));
			$f->setSource('blog_comment');
			$f->setCondition('id', $_GET['edit']);
			$f->addField('line', 'name',    'Name')->setNotNull();
			$f->addField('line', 'email',   'E-Mail')->setNotNull()->template->set('after_field',' <ins>E-mail won\'t be published</ins>');
			$f->addField('line', 'url',     'Website')->setNotNull()->template->trySet('before_field','<span
					class="http_prefix">http://</span>');
			$f->addField('text', 'comment', 'Your Comment');
			$sec_image_field = $f->addField('line', 'sec_image', 'Security code')->setNotNull()->setNoSave()
				->setProperty('size', 10);
			;

			$session_name = $this->api->name;

			// $this->api->recall('captcha_keystring');
			// var_dump($_SESSION);
			$captcha_src = '/lib/kcaptcha/?' . $session_name . '=' . session_id();

		$kaptcha_img = $sec_image_field->getTag('img',array('src' => $captcha_src, 'id' => 'kpt' ));
		$kaptcha_img .= ' <a href="#" onclick="d=new Date(); (jQuery(\'#kpt\')'.
			'.attr(\'src\', \'' . $captcha_src . '&t=\' + d.getTime()));return false;">';
		$kaptcha_img .= '<i class="atk-icon atk-icons-nobg atk-icon-arrows-left3"></i>';
		$kaptcha_img .= ' reload</a>';
		$sec_image_field->template->set('after_field', '<ins>Enther the code you see below</ins> <span>' . $kaptcha_img . '</span>');



		//	$f->getElement('sec_image')->js(true)->parent()->addClass('form_captcha');
		$sec_image_field->js(true)->closest('dl')->addClass('form_captcha');
			
			$f->addSubmit('Post Comment');
			if($f->isSubmitted()){
				if(!$this->api->recall('captcha_keystring', false) || $this->api->recall('captcha_keystring') != $f->get('sec_image')){
					$this->js()->univ()->successMessage('Security image error')->execute();
					die('<h1><font color="Red">Spammer? He, he.... (=</font></h1>');
				}
			
				if ($arrData['is_commented'] != 'Y') {
					$this->js()->univ()->successMessage('Disabled')->execute();
				}
				else {
					$visitor = $this->add('Model_Visitor');
					$key = $visitor->generateUniqId();
					//var_dump($key);
					
					if (!$_COOKIE['_vtr'] || trim($_COOKIE['_vtr']) == '') {
						//TODO: write insert action
						$visitor_id = $visitor->insert($key);
						$this->setCookieForVisitor($key);
					}
					else {
						$visitor = $this->add('Model_Visitor');
						$visitor_id = $visitor->getIdByKey($_COOKIE['_vtr']);
						if($visitor_id) {
							//TODO: update insert action
							$visitor->updateCount($visitor_id);
							$this->setCookieForVisitor($_COOKIE['_vtr']);
						}
						else {
							$visitor_id = $visitor->insert($key);
							$this->setCookieForVisitor($key);
						}
					}
					$f->dq->set('is_enable', 'Y');
					$f->dq->set('blog_id', $arrData['id']);
					$f->dq->set('visitor_id', $visitor_id);
					$f->update();
					
					$this->Notify = $this->add('NotifySender');
					// if (0) {
					$separator = '=~=~=~=~=~=~=~=~=~=~=';
					$mailBody  = 'Blog Url: http://' . $_SERVER['HTTP_HOST'] . '/blog/view.html?url='  . $arrData['url'] . PHP_EOL;
					$mailBody .= 'Name: ' . $f->get('name') . PHP_EOL;
					$mailBody .= $separator . PHP_EOL;
					$mailBody .= 'E-mail: ' . $f->get('email') . PHP_EOL;
					$mailBody .= 'Website: ' . $f->get('url') . PHP_EOL;
					$mailBody .= $separator . PHP_EOL;
					$mailBody .= 'Comment: ' . $f->get('comment') . PHP_EOL;
					$mailBody .= $separator . PHP_EOL;
					
					$this->Notify->send(Array(
						'mail'    => $this->api->getConfig('blog/mailto', 'r@agiletech.ie'),
						'subject' => 'New comment',
						'body'    => $mailBody,
					));
					// }
					
					$this->js()->univ()
							->successMessage('Success')
							->location($this->api->getDestinationURL('blog/view'))
							// $this->api->getDestinationURL('./view',array('id' => $_GET['details'])),
							->execute();
					
					/*
					$f->js()->univ() //->successMessage('Success')
						->page($this->api->getDestinationURL('view'))
						->execute();
				}
			}
             */
		}
		// $f->dq->debug();
	}
	function defaultTemplate(){
		return array('page/blog_view','_top');
	}
	
	function setCookieForVisitor($key){
		setcookie("_vtr", $key, time()+3600*24*365);
	}
}

class Comment extends CompleteLister {
	public $safe_html_output=false;
	function init(){
		parent::init();
        
        $blog_url = $_GET['url'];
		$blogModel = $this->add('Model_Blog');
		$arrData   = $blogModel->getByUrl($blog_url);
		
		$commentModel = $this->add('Model_Comment');
		$arrComments  = $commentModel->getByBlogId($arrData['id']);
		
		$this->setStaticSource($arrComments);
	}
}
