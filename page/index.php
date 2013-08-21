<?php
class Page_index extends Page {
    function init(){
        parent::init();

        $this->api->add('AgileTeam',null,'Team','Team')
            ->setSource(array (
                    4 => array ( 'name' => 'Romans', 'title' => 'CTO', 'email' => '',
                        'descr' => 'Romans is a recognised thought leader and an innovator in Open Source and Data Scalability, having founded a number of successful software development companies in the past as well as being the inventor of the Agile Toolkit. Romans is a skilled manager with a great eye for technical talent with panache for managing large and complex projects, often under great pressure and tight timelines.',
                        'thumb' => 'romans',
                    ),
                    5 => array ( 'name' => 'David', 'title' => 'CEO', 'email' => '',
                        'descr' => 'David is a visionary social entrepreneur as well the CEO and founder of Elexu Portfolio, the parent company of Elexu Technologies. His experience working in the Media and Entertainment industry, as well as his commercial acumen help ensure Elexu Technologies provides a partnership.',
                        'thumb' => 'david',
                    ),
                    12 => array ( 'name' => 'Alex', 'title' => 'Development Manager', 'email' => '',
                        'descr' => 'With over 10 years\' experience in project management, Alex easily handles even the most complex and critical projects with ease. He oversees the process and resources throughout various projects ensuring consistent quality of communications and task outcomes, as well as providing leadership and mentoring to his peer Project Managers.',
                        'thumb' => 'alex',
                    ),
                    8 => array ( 'name' => 'Dmitry', 'title' => 'Designer', 'email' => '',
                        'descr' => 'Dmitry is a pioneer of cutting-edge design in both user interface and user journeys. Our design work is very much based upon a consultancy approach and Dmitry has a passion and a talent for eliciting from business partners, exactly what their design requirements are, even if they have difficulty themselves in expressing these needs. ',
                        'thumb' => 'm',
                    ),
                    9 => array ( 'name' => 'Janis', 'title' => 'Senior Developer', 'email' => '',
                        'descr' => 'Janis is our development lead and web software architect who manages a team of developers reporting to him. Janis helps ensure our standards of development are consistent throughout the teams he manages. Janis knows exactly how to solve any technical problem and who to assign or bring in, when specific expertise is sought or required by our business partners.',
                        'thumb' => 'jancha',
                    ),
                    13 => array ( 'name' => 'Serhij', 'title' => 'Scalability Expert', 'email' => '',
                        'descr' => 'Stas is a system programmer, Linux administrator and our scalability specialist. He has over 10 years experience of working with companies relying on Linux, advising a number of large corporations on how to improve the scalability, security and efficiency of their server infrastructure. In addition to his commercial work, Stas is a part-time university professor and lecturer.',
                        'thumb' => 'stas',
                    ),
                    6 => array ( 'name' => 'Gita', 'title' => 'Lead Q/A Manager', 'email' => '',
                        'descr' => 'Gita is an accomplished Quality Assurance expert, having had a long standing career in the software industry and is an expert at helping development organizations regain (and retain) focus on delivering commercially-viable products which deliver high levels of customer satisfaction and retention.',
                        'thumb' => 'gita',
                    ),
                    14 => array ( 'name' => 'Sam', 'title' => 'Security Consultant', 'email' => '',
                        'descr' => 'Sam has over 10 years experience in the data security domain, having working for the Australian Government of critical data security projects. He is also an active participant in the Open-Source community.',
                        'thumb' => 'sam',
                    ),
                    15 => array ( 'name' => 'Yanet', 'title' => 'Head of Human Talent', 'email' => '',
                        'descr' => 'Yanet helps us find, retain and reward our ever expanding team. An extensive traveller, Yanet oversees our recruitment strategies in the US, the UK and Eastern Europe.',
                        'thumb' => 'yanet',
                    ),
                )
            );




        $this->js('click')->_selector('.newsletter')
            ->univ()->dialogURL('Newsletter',$this->api->getDestinationURL('newsletter.html'),
                array('height'=>390));

        $f=$this->api->add('Form',null,'Contact');
        $f->addField('line', 'name', 'Company')->setMandatory('required');
        $f->addField('line', 'email', 'E-mail')->setMandatory('required');
        $f->addField('line', 'phone', 'Phone')->setMandatory('required');
        $f->addField('text', 'message', 'Message');
        $f->addSubmit('Send');

        if($f->isSubmitted()){
            $m=$this->add('TMail');
            $m->setTemplate('contact');
            //$m->addTransport('SES');
            $m->set($f->get());
            $m->set('subject','Contact Request from'.$f->get('name'));
            $x=$m->send('info@agiletech.ie');
            $this->js()->univ()->alert('Your message was delivered')->execute();


        }
    }

    function defaultTemplate(){
        return array('page/index','_top');
    }
}
