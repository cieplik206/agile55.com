<?
class page_demo_d4 extends AWPage {
	function init(){
		parent::init();

		$h1=$this->add('View_HtmlElement','h')->setElement('h1')->set('Get your project done - FASTER');
		$h1->js(true)->hide()->fadeIn(2000);

		$t=$this->add('View_HtmlElement','t1')->setElement('p')->set('
Other frameworks force you to create bunch of files, edit model and controller for every component.
Agile Toolkit offers everything as an option. Use only what you need. You don\'t have to make
template if you don\'t want to.
				');
		$t->js(true)->hide()->delay(1000)->fadeIn(2000);

		$t=$this->add('View_HtmlElement','t2')->setElement('p')->set('
In practice within just a few days you can get first version of your UI. That includes froms, menus,
grids, listers, sliders and much more. You don\'t have to question "How do I make it", it all works.
				');
		$t->js(true)->hide()->delay(3000)->fadeIn(2000);


		$h1=$this->add('View_HtmlElement','h2')->setElement('h1')->set('Customise without code polution');
		$h1->js(true)->hide()->delay(5000)->fadeIn(2000);

		$t=$this->add('View_HtmlElement','t3')->setElement('p')->set('
Once your initial application draft is working, you can work on perfecting pages, forms and views.
Here you get huge variety of tools. For instance - forms will lay out fields one under another by
default. You can specify custom layout to a form and arrange positions, styles, widths and comments
on your input fields. You can define multiple global form templates. You can put form into other elements
or change page template. Finally you can change field templates or manually change templates. If everything
else fails - you can use jQuery for HTML manipulation, which works with regular and AJAX requests seamlessly.
				');
		$t->js(true)->hide()->delay(7000)->fadeIn(2000);

		$t=$this->add('View_HtmlElement','t4')->setElement('p')->set('
You can inherit and redefine provided components. Create PaymentForm based on standard form class.
Introduce models and controllers which will initialise your views for you and consolidate business
actions. We try hard to keep our base clases clean and simple. Once you look under the hood you will find
a huge varietty of advanced customisation tools - callbacks, hooks, renderers, helpers etc.
');
		$t->js(true)->hide()->delay(10000)->fadeIn(2000);


		$h1=$this->add('View_HtmlElement','h3')->setElement('h1')->set('Recycling and reusing common code');
		$h1->js(true)->hide()->delay(12000)->fadeIn(2000);

		$t=$this->add('View_HtmlElement','t5a')->setElement('p')->set('
As you work on several projects, you will find the need to introduce "Shared" code. For example: payment back-end
is commonly used in many projects. Based on your code, you can develop your own extension, which is ideal
for adding into your projects. 
				');
		$t->js(true)->hide()->delay(14000)->fadeIn(2000);

		$t=$this->add('View_HtmlElement','t6')->setElement('p')->set('
But wait, check back with us as there might be a ready-to-use component already. Some of the components are
paid and come with premium support, extensive documentation and training.
				');
		$t->js(true)->hide()->delay(16000)->fadeIn(2000);


		$h1=$this->add('View_HtmlElement','h4')->setElement('h1')->set('Get Started today!');
		$h1->js(true)->hide()->delay(18000)->fadeIn(2000);

		$t=$this->add('View_HtmlElement','t7')->setElement('p')->set('
Those 3 qualities <b>Quick start</b>, <b>Flexible customisation</b> and <b>Reuse of your code</b> are the
the primary reasons why projects using Agile Toolkit are successful. Download either evaluation copy of
commercially-supported enterprise version or go after Free Community verison.
				');
		$t->js(true)->hide()->delay(20000)->fadeIn(2000);


		$h1=$this->add('View_HtmlElement','h5')->setElement('h1')->set('<a href="/contact/">Contact Us</a> or visit <a
				href="http://www.atk4.com/">www.atk4.com</a>. Thank you for watching.');
		$h1->js(true)->hide()->delay(22000)->fadeIn(2000);

		$this->js(true)->_selector('#footer')->delay(10000)->fadeIn(4000);
		$this->js(true)->_selector('#nav')->delay(10000)->slideDown(4000);
	}
}
