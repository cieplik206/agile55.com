<?php
/**
 *Created by Konstantin Kolodnitsky
 * Date: 18.11.13
 * Time: 16:44
 */
class page_share extends Page{
    function init(){
        parent::init();

        $this->add("View_HtmlElement")
            ->setElement('A')
            ->setAttr('href','#')
            ->addClass('twitter_share')
            ->js("click")->univ()
            ->redirect('https://twitter.com/intent/tweet?status='.$_GET['link']);

        $this->add("View_HtmlElement")->setElement('img')
            ->setElement('A')
            ->setAttr('href','#')
            ->addClass('facebook_share')
            ->js("click")->univ()
            ->redirect('https://www.facebook.com/sharer/sharer.php?u='.$_GET['link']);
    }
}