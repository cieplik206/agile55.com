<?php
class MainMenu extends Menu {
    public $current_menu_class="atk-state-active";
    public $inactive_menu_class="";

    function init(){
        parent::init();

        $this->add("View_HtmlElement", null, "share")->setElement('img')
            ->setAttr('src', $p=$this->api->pm->base_path.'images/share.png')
            ->js("click")->univ()
            ->frameURL(
                "Share you thoughts",
                $this->api->url('share',array('link' => $this->api->url()->useAbsoluteUrl())),
                array("width" => 160,"resizable"=>false,"modal"=>true)
            );
    }
}