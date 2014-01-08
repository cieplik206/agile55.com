<?php
class page_team extends Page {
    function init(){
        parent::init();

        $this->add('AgileTeam',null,'Team','Team')
            ->setSource(array (
                    4 => array ( 'name' => 'Romans', 'title' => 'CTO', 'email' => '',
                        'descr' => 'Romans is a recognised thought leader and an innovator in Open Source and Data Scalability, having founded a number of successful software development companies in the past as well as being the inventor of the Agile Toolkit. Romans is a skilled manager with a great eye for technical talent with panache for managing large and complex projects, often under great pressure and tight timelines.',
                        'thumb' => 'romans',
                    ),
                    12 => array ( 'name' => 'Alex', 'title' => 'Executive Director', 'email' => '',
                        'descr' => 'Alex runs the company. He has 9 years of top managerial experience in complex multi-million development projects in different industries. Alex has financial and legal education from top ranking European business schools.',
                        'thumb' => 'alex',
                    ),
                    17 => array ( 'name' => 'Ben Slawson', 'title' => 'New Business Director', 'email' => '',
                        'descr' => 'Ben has over 10 years of digital expertise across website design, development
                        and e-commerce for SME and corporate business\'s both UK and globally.
                        With experience as a Creative Director working with web development teams he is
                        skilled at understanding and translating client needs and online requirements.
                        Ben works with the Agile55 team in a new business development capacity to
                        support clients in achieving their digital and commercial website project goals.',
                        'thumb' => 'benslawson',
                    ),
                    5 => array ( 'name' => 'Vadim', 'title' => 'Lead Developer', 'email' => '',
                        'descr' => 'Vadym is our development lead and web software architect who manages a team of developers reporting to him. Vadym helps ensure our standards of development are consistent throughout the teams he manages. Vadym knows exactly how to solve any technical problem and who to assign or bring in, when specific expertise is sought or required by our business partners.',
                        'thumb' => 'vadim',
                    ),
                    14 => array ( 'name' => 'Oleksii', 'title' => 'Framework Developer', 'email' => '',
                        'descr' => 'Oleksii has been a lead developer for web and mobile platforms for over 6 years. He extensively used technologies such as PHP, HTML, CSS, JavaScript, Agile Toolkit, Symfony, Ruby on Rails, Java for Android, MySQL and many others. He is a very crucial member of our team.',
                        'thumb' => 'alf',
                    ),
                    15 => array ( 'name' => 'Konstantin', 'title' => 'Framework Developer', 'email' => 'konstantin@agiletech.ie',
                        'descr' => 'Konstantin has patricipated in web software development of various complexity including platforms using Agile Toolkit, jQuery, CSS3 and HTML5 during the last 3 years. Previously worked with Wordpress and Joomla. With a total 7 years of web development experience Konstantin is a valuable member of our team.',
                        'thumb' => 'kostya2',
                    ),
                    16 => array ( 'name' => 'Katerina', 'title' => 'Professional Web Designer', 'email' => '',
                        'descr' => 'Katerina’s technical skills and experience include web design, interior design and 3-D modelling. Katerina looks at design as more than simply a choice of aesthetics but also a way to improve efficiency and enhance function. She is in love with colours, patterns, icons and anything about design.',
                        'thumb' => 'kat',
                    ),
                    8 => array ( 'name' => 'Dmitry', 'title' => 'Designer', 'email' => '',
                        'descr' => 'Dmitry is the pixel-perfect designer behind Agile Toolkit and many client User Interface designs. He learned Photohop at the age of 14. Dmitry also participates in projects as a Creative Designer, CSS/HTML coder and UI usability expert.',
                        'thumb' => 'm',
                    ),
                    9 => array ( 'name' => 'Janis', 'title' => 'Associate Senior Developer', 'email' => '',
                        'descr' => 'Janis is an associate web software architect; he joins our team for very complex projects. Janis knows exactly how to solve any technical problem.',
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
                )
            );
    }

    function defaultTemplate(){
        return array('page/team','_top');
    }
}
