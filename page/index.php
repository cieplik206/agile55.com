<?php
class page_index extends Page {
    function init(){
        parent::init();

        $this->add('AgileTeam',null,'Team','Team')
            ->setSource(array (
                    4 => array ( 'name' => 'Romans', 'title' => 'CTO', 'email' => '',
                        'descr' => 'Romans is a recognised thought leader and an innovator in Open Source and Data Scalability, having founded a number of successful software development companies in the past as well as being the inventor of the Agile Toolkit. Romans is a skilled manager with a great eye for technical talent with panache for managing large and complex projects, often under great pressure and tight timelines.',
                        'thumb' => 'romans',
                    ),
                    12 => array ( 'name' => 'Alex', 'title' => 'Development Manager', 'email' => '',
                        'descr' => 'With over 10 year experience of project management, Alex Chizhevski is the leader of the client project development division of Agile Technologies. He oversees the process as a project coordinator and resource manager.',
                        'thumb' => 'alex',
                    ),
                    5 => array ( 'name' => 'Vadim', 'title' => 'Framework Developer', 'email' => '',
                        'descr' => 'Vadim discovered Agile Toolkit after 6+ years experience developing in Ruby on Rails and Symfony. He quickly realised the potential behind Agile Toolkit and was very eager to join our core team at Agile Technologies. Vadim works on client projects, including Elexu™ and Plugin Manager.',
                        'thumb' => 'vadim',
                    ),
                    14 => array ( 'name' => 'Oleksii', 'title' => 'Framework Developer', 'email' => '',
                        'descr' => 'Oleksii has over 7 years experience in web-development and mobile applications.',
                        'thumb' => 'alf',
                    ),
                    15 => array ( 'name' => 'Konstantin', 'title' => 'Framework Developer', 'email' => 'konstantin@agiletech.ie',
                        'descr' => 'Konstantin has over 5 years experience in web-development.',
                        'thumb' => 'kostya',
                    ),
                    13 => array ( 'name' => 'Serhij', 'title' => 'Scalability Expert', 'email' => '',
                        'descr' => 'Stas is a system programmer, Linux administrator and our scalability specialist. He has over 10 years experience of working with companies relying on Linux, advising a number of large corporations on how to improve the scalability, security and efficiency of their server infrastructure. In addition to his commercial work, Stas is a part-time university professor and lecturer.',
                        'thumb' => 'stas',
                    ),
                    6 => array ( 'name' => 'Gita', 'title' => 'Lead Q/A Manager', 'email' => '',
                        'descr' => 'Gita is an accomplished Quality Assurance expert, having had a long standing career in the software industry and is an expert at helping development organizations regain (and retain) focus on delivering commercially-viable products which deliver high levels of customer satisfaction and retention.',
                        'thumb' => 'gita',
                    ),
                    8 => array ( 'name' => 'Dmitry', 'title' => 'Designer', 'email' => '',
                        'descr' => 'Dmitry is the pixel-perfect designer behind Agile Toolkit and many client User Interface designs. He learned Photohop at the age of 14. Dmitry also participates in projects as a Creative Designer, CSS/HTML coder and UI usability expert.',
                        'thumb' => 'm',
                    ),
                    9 => array ( 'name' => 'Janis', 'title' => 'Senior Developer', 'email' => '',
                        'descr' => 'Janis is our development lead and web software architect who manages a team of developers reporting to him. Janis helps ensure our standards of development are consistent throughout the teams he manages. Janis knows exactly how to solve any technical problem and who to assign or bring in, when specific expertise is sought or required by our business partners.',
                        'thumb' => 'jancha',
                    ),
                )
            );
    }

    function defaultTemplate(){
        return array('page/index','_top');
    }
}
