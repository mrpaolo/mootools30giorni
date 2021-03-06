<h2>Displaying elements with Fx.Slide</h2>

<p>Welcome to day 23 of 30 days of Mootools 1.2 tutorials.  If you haven&#8217;t already, be sure to check out <a href="index.php?day=01">the rest of our mootools series</a>.  Continuing with our tutorials about the Fx plugins, we are going to take a look at Fx.Slide.  This plugin lets you display content by sliding it into view.  It is very simple to use and makes a great addition to your UI toolkit.</p>

<h3>The Basics</h3>
<p>Like all the other classes we have looked at, the first thing you need to do is initiate a new instance of the Fx.Slide class and apply it to an element.</p>
<p>First, lets set up our html for the slide element.</p>

<pre class="prettyprint">
&lt;div id=&quot;slide_element&quot; class=&quot;slide&quot;&gt;Here is some content to slide.&lt;/div&gt;
</pre>

<p>And our css doesn&#8217;t need to be anything fancy.</p>

<pre class="prettyprint">
.slide {
	margin: 20px 0; 
	padding: 10px;
	width: 200px;
	background-color: #DAF7B4;
}
</pre>

<p>Finally, we initiate a new instance of Fx.Slide and pass it our element variable.</p>

<pre class="prettyprint">
var slideElement = $('slide_element');
var slideVar = new Fx.Slide(slideElement, {

	//Fx.Slide Options
	mode: 'vertical', //default is 'vertical'

	//Fx Options
	transition: 'sine:in',
	duration: 300, 

	//Fx Events
	onStart: function(){
		$('start').highlight("#EBCC22");
	}
});
</pre>

<p>Since Fx.Slide is an extension of Fx, you can use any of the <a href="index.php?day=11">Fx options and events</a>, but Fx.Slide does come with a set of options itself.</p>

<h3>Fx.Slide options</h3>
<p>There are only two Fx.Slide options, &#8216;mode&#8217; and &#8216;wrapper.&#8217;  Frankly, I have never found myself using &#8216;wrapper&#8217; (I have never come across the need), but &#8216;mode&#8217; is what determines whether you want to slide horizontally or vertically.</p>

<h4>mode</h4>
<p>Mode gives you two choices, &#8216;vertical&#8217; or &#8216;horizontal&#8217;.  Vertical reveals from top to bottom and horizontal reveals from left to right.  There are no options to go from bottom to top or from right to left, tho I understand that hacking the class itself to accomplish this is relatively simple.  In my opinion, it&#8217;s an option I would like to see standard, and if anyone has hacked the class to allow this options, please drop us a note.</p>

<h4>wrapper</h4>
<p>By default, Fx.Slide throws a wrapper around your slide element, giving it &#8216;overflow&#8217;: &#8216;hidden&#8217;.  Wrapper allows you to set another element as the wrapper.  Like I said above, I am not clear on where this would come in handy and would be interested to hear any thoughts (thanks to horseweapon at <a href="http://www.mooforum.net">mooforum.net</a> for helping me clear this up).</p>

<h3>Fx.Slide methods</h3>
<p>Fx.Slide also features many methods for showing and hiding your element.</p>

<h4>.slideIn()</h4>
<p>As the name implies, this method will fire the start event and reveal your element.</p>

<h4>.slideOut()</h4>
<p>Slides your element back to the hidden state.</p>

<h4>.toggle()</h4>
<p>This will either slide the element in or out, depending on its current state.  Very useful method to add to click events.</p>

<h4>.hide()</h4>
<p>This will hide the element without a slide effect.</p>

<h4>.show()</h4>
<p>This will show the element without a slide effect</p>

<h4>override mode with methods</h4>
<p>Each of the methods above also accept &#8216;mode&#8217; as an optional parameter, letting you override anything set in the options.</p>

<pre class="prettyprint">
slideVar.slideIn('horizontal');
</pre>

<h3>Fx.Slide shortcuts</h3>
<p>The Fx.Slide class also provides some handy shortcuts for adding the effect to an element.</p>

<h4>.set(&#8217;slide&#8217;);</h4>
<p>Instead of initiating a new class, you can create a new instance if you &#8217;set&#8217; slide on an element.</p>

<pre class="prettyprint">
slideElement.set('slide');
</pre>

<h4>setting options</h4>
<p>You can even set options with the shortcut:</p>

<pre class="prettyprint">
slideElement.set('slide', {duration: 1250});
</pre>

<h4>.slide()</h4>
<p>Once the slide is .set(), you can initiate it with the .slide() method.</p>

<pre class="prettyprint">
slideElement.slide('in');
</pre>

<p>.slide will accept:</p>

<ul>
	<li>&#8216;in&#8217;</li>
	<li>&#8216;out&#8217;</li>
	<li>&#8216;toggle&#8217;</li>
	<li>&#8217;show&#8217;</li>
	<li>&#8216;hide&#8217;</li>
</ul>

<p>&#8230;each corresponding to the methods above.</p>

<h3>Example</h3>
<p>That pretty much covers the basics.  The example below uses most of what we learned above, displays a few different types of slides, and provides some indicator divs so you can watch the events.</p>

<p>First, set up the html.</p>

<pre class="prettyprint">
&lt;div id=&quot;start&quot; class=&quot;ind&quot;&gt;Start&lt;/div&gt;
&lt;div id=&quot;cancel&quot; class=&quot;ind&quot;&gt;Cancel&lt;/div&gt;
&lt;div id=&quot;complete&quot; class=&quot;ind&quot;&gt;Complete&lt;/div&gt;
 
&lt;button id=&quot;openA&quot;&gt;open A&lt;/button&gt;
&lt;button id=&quot;closeA&quot;&gt;close A&lt;/button&gt;

&lt;div id=&quot;slideA&quot; class=&quot;slide&quot;&gt;Here is some content - A. Notice the delay before onComplete fires.  This is due to the transition effect, the onComplete will not fire until the slide element stops &quot;elasticing.&quot; Also, notice that if you click back and forth, it will &quot;cancel&quot; the previous call and give the new one priority.&lt;/div&gt;
 
&lt;button id=&quot;openB&quot;&gt;open B&lt;/button&gt;
&lt;button id=&quot;closeB&quot;&gt;close B&lt;/button&gt;

&lt;div id=&quot;slideB&quot; class=&quot;slide&quot;&gt;Here is some content - B. Notice how if you click me multiple times quickly I &quot;chain&quot; the events.  This slide is set up with the option &quot;link: &#39;chain&#39;&quot;&lt;/div&gt;
 
&lt;button id=&quot;openC&quot;&gt;toggle C&lt;/button&gt;

&lt;div id=&quot;slideC&quot; class=&quot;slide&quot;&gt;Here is some content - C&lt;/div&gt;
 
&lt;button id=&quot;openD&quot;&gt;toggle D&lt;/button&gt;

&lt;div id=&quot;slideD&quot; class=&quot;slide&quot;&gt;Here is some content - D. Notice how I am not hooked into any events.  This was done with the .slide shortcut.&lt;/div&gt;
 
&lt;button id=&quot;openE&quot;&gt;toggle E&lt;/button&gt;
 
&lt;div id=&quot;slide_wrap&quot;&gt;
	&lt;div id=&quot;slideE&quot; class=&quot;slide&quot;&gt;Here is some content - E&lt;/div&gt;
&lt;/div&gt;
</pre>

<p>Now, our css.  We can keep it pretty simple.</p>

<pre class="prettyprint">
.ind {
	width: 200px;
	padding: 10px;
	background-color: #87AEE1;
	font-weight: bold;
	border-bottom: 1px solid white;
}
 
.slide {
	margin: 20px 0; 
	padding: 10px;
	width: 200px;
	background-color: #DAF7B4;
}
 
#slide_wrap {
	padding: 30px;
	background-color: #D47000;
}
</pre>

<p>Finally, our mootools javascript:</p>

<pre class="prettyprint">
window.addEvent('domready', function() {

	//EXAMPLE A
	var slideElement = $('slideA');

	var slideVar = new Fx.Slide(slideElement, {
		//Fx.Slide Options

		mode: 'horizontal', //default is 'vertical'
		//wrapper: this.element, //default is this.element

		//Fx Options
		link: 'cancel',
		transition: 'elastic:out',
		duration: 'long', 

		//Fx Events
		onStart: function(){
			$('start').highlight("#EBCC22");
		},
		onCancel: function(){
			$('cancel').highlight("#EBCC22");
		},
		onComplete: function(){
			$('complete').highlight("#EBCC22");
		}
	}).hide().show().hide(); //note, .hide and .show do not fire events 

	$('openA').addEvent('click', function(){
		slideVar.slideIn();
	});

	$('closeA').addEvent('click', function(){
		slideVar.slideOut();
	});

	//EXAMPLE B
	var slideElementB = $('slideB');

	var slideVarB = new Fx.Slide(slideElementB, {
		//Fx.Slide Options
		mode: 'vertical', //default is 'vertical'

		//Fx Options
		//notice how chaining lets you click multiple time 
		//then mouse away and the effects will keep going
		//for every click
		link: 'chain', 

		//Fx Events
		onStart: function(){
			$('start').highlight("#EBCC22");
		},
		onCancel: function(){
			$('cancel').highlight("#EBCC22");
		},
		onComplete: function(){
			$('complete').highlight("#EBCC22");
		}
	});

	$('openB').addEvent('click', function(){
		slideVarB.slideIn();
	});

	$('closeB').addEvent('click', function(){
		slideVarB.slideOut();
	});

	//EXAMPLE C
	var slideElementC = $('slideC');

	var slideVarC = new Fx.Slide(slideElementC, {
		//Fx.Slide Options

		mode: 'vertical', //default is 'vertical'
		//wrapper: this.element, //default is this.element

		//Fx Options
		//link: 'cancel',
		transition: 'sine:in',
		duration: 300, 

		//Fx Events
		onStart: function(){
			$('start').highlight("#EBCC22");
		},
		onCancel: function(){
			$('cancel').highlight("#EBCC22");
		},
		onComplete: function(){
			$('complete').highlight("#EBCC22");
		}
	}).hide();

	$('openC').addEvent('click', function(){
		slideVarC.toggle();
	});

	$('slideD').slide('hide');

	$('openD').addEvent('click', function(){
		$('slideD').slide('toggle');
	});

	//EXAMPLE C
	var slideElementE = $('slideE');
	var slideWrap = $('slide_wrap');

	var slideVarE = new Fx.Slide(slideElementE, {
		//Fx.Slide Options
		//mode: 'vertical', //default is 'vertical'
		wrapper: slideWrap //default is this.element
	}).hide(); 


	$('openE').addEvent('click', function(){
		slideVarE.toggle();
	});

});
</pre>

<div id="start" class="ind">Start</div>
<div id="cancel" class="ind">Cancel</div>
<div id="complete" class="ind">Complete</div>
<p>
	<button id="openA" class="btn btn-primary">open A</button>
	<button id="closeA" class="btn btn-primary">close A</button>
</p>

<div id="slideA" class="slide">Here is some content - A. Notice the delay before onComplete fires.  This is due to the transition effect, the onComplete will not fire until the slide element stops &#8220;elasticing.&#8221; Also, notice that if you click back and forth, it will &#8220;cancel&#8221; the previous call and give the new one priority.</div>

<p>
	<button id="openB" class="btn btn-primary">open B</button>
	<button id="closeB" class="btn btn-primary">close B</button>
</p>

<div id="slideB" class="slide">Here is some content - B. Notice how if you click me multiple times quickly I &#8220;chain&#8221; the events.  This slide is set up with the option &#8220;link: &#8216;chain&#8217;&#8221;</div>

<p><button id="openC" class="btn btn-primary">toggle C</button></p>

<div id="slideC" class="slide">Here is some content - C</div>

<p><button id="openD" class="btn btn-primary">toggle D</button></p>

<div id="slideD" class="slide">Here is some content - D. Notice how I am not hooked into any events.  This was done with the .slide shortcut.</div>

<p><button id="openE" class="btn btn-primary">toggle E</button></p>

<div id="slide_wrap">
	<div id="slideE" class="slide">Here is some content - E</div>
</div>

<h3>To Learn More&#8230;</h3>
<p>Fx.Slide is a versatile and incredibly useful plugin.  To learn more, check out the <a href="http://mootools.net/docs/Plugins/Fx.Slide">Fx.Slide docs</a>, the <a href="http://mootools.net/docs/Fx/Fx.Morph">Fx.Morph</a> and <a href="http://mootools.net/docs/Fx/Fx">Fx docs</a>.</p>

<p>Also, be sure to check <a href="index.php?day=11">our tutorials on Fx.Morph and the Fx options and events</a>.</p>
<h4>Tomorrow&#8217;s Tutorial</h4>
<p>Will post a link once it is published</p>			