<?php
class page_time extends Page {
    function init() {
        parent::init();

        $f = $this->add('Form');

        if(!$_GET['d']){
            if(!$_GET['t']){
                $dt=new DateTime('now');
            }else{
                if(strpos(':',$_GET['t'])===false){
                    if($_GET['t']>7 && $_GET['t']<12)$_GET['t'].='am';else $_GET['t'].='pm';
                }

                $dt=new DateTime(date('Y-m-d').' '.$_GET['t']);
            }
        }else{
            $dt=new DateTime($_GET['d'].' '.$_GET['t']);
        }

        // Need PHP5.3
        $till_date=$dt->diff(new DateTime('now'));
        if($till_date->format('d')>=1){
            $f->addField('line','d','Date')->set($dt->format('d/m/Y'));
        }

        $ff=$f->addField('line','time','Agile Time (UK / IRL)')->set($dt->format('H:i'));

        $dt->setTimezone(new DateTimeZone('GMT'));
        $ff=$f->addField('line','gmt','GMT')->set($dt->format('H:i'));

        $dt->setTimezone(new DateTimeZone('Europe/Riga'));
        $ff=$f->addField('line','lv','Latvia')->set($dt->format('H:i'));


        $dt->setTimezone(new DateTimeZone('Europe/Kiev'));
        $ff=$f->addField('line','ut','Ukraine')->set($dt->format('H:i'));

        $dt->setTimezone(new DateTimeZone('Asia/Calcutta'));
        $ff=$f->addField('line','in','Bhubaneswar')->set($dt->format('H:i'));

        $dt->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
        $ff=$f->addField('line','art','Buenos Aires')->set($dt->format('H:i'));


        /*
        $timezone_identifiers = DateTimeZone::listIdentifiers();
        for ($i=0; $i < 5000; $i++) {
                echo "$timezone_identifiers[$i]<br/>";
        }
        */
    }
    /*function defaultTemplate() {
        return array('page/index');
    }*/
}
