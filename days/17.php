<h2>Mootools 1.2 Accordion Tutorial</h2>
<p>If you haven&#8217;t already, be sure and check out the rest of the <a href="index.php?day=01">Mootools 1.2 tutorials</a> in our 30 days series.</p>

<p>Continuing with our &#8220;more&#8221; library plugin tutorials, today we are going to look at maybe the most popular plugin, accordion. Creating and configuring the basic accordion is simple, but be sure to read through carefully, as the more advanced options can be a little tricky.</p>

<h3>The Basics</h3>
<h4>Creating a new accordion</h4>
<p>To create a new accordion you are going to need to select pairs of elements&mdash;the title and the content.  So first, assign a class to each title and a class to each content element:</p>

<pre class="prettyprint">
&lt;h3 class=&quot;togglers&quot;&gt;Toggle 1&lt;/h3&gt;
&lt;p class=&quot;elements&quot;&gt;Here is the content of toggle 1&lt;/p&gt;
&lt;h3 class=&quot;togglers&quot;&gt;Toggle 2&lt;/h3&gt;
&lt;p class=&quot;elements&quot;&gt;Here is the content of toggle 2&lt;/p&gt;
</pre>

<p>Now, we can select all elements with the class &#8220;togglers&#8221; and all elements with the class &#8220;elements,&#8221; throw them into vars, then initiate a new accordion object.</p>

<pre class="prettyprint">
var toggles = $$('.togglers');
var content = $$('.elements');

//set up your object var
//create a "new" Accordion object
//set the toggle array
//set the content array
var AccordionObject = new Accordion(toggles, content);
</pre>

<p>The default for setting for the accordion will give you something that looks like this:</p>

<h5 class="togglersA">Toggle 1</h5>
<p class="elementsA">Here is the content of toggle 1</p>
<h5 class="togglersA">Toggle 2</h5>
<p class="elementsA">Here is the content of toggle 2</p>
<h5 class="togglersA">Toggle 3</h5>
<p class="elementsA">Here is the content of toggle 3</p>

<h3>Options</h3>
<p>Of course, if you want something other than the default accordion, you are going to need to adjust the options.  Here we will go through each one:</p>
<h4>display</h4>
<p>This option determines which element shows on page load.  The default is 0, so the first element shows.  To set another element, just put in another integer that corresponds to its index.  Unlike &#8220;show,&#8221; display will transition the element open.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
	display: 0 //default is 0
});
</pre>

<h4>show</h4>
<p>Much like &#8220;display,&#8221; show determines which element will be open when the page loads, but instead of a transition, &#8220;show&#8221; will just make the content display on load without the transition.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
	display: 0 //default is 0
});
</pre>

<h4>height</h4>
<p>When set to true, the content will show with a height transition.  This is the standard accordion setting you see above.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
	height: true //default is true
});
</pre>

<h4>width</h4>
<p>Like &#8220;height,&#8221; but instead of transitioning the height to show the content, it will transition the width.  If you use &#8220;width&#8221; with a standard set up, like we used above, then the space between the title toggle will stay the same, based on the height of the content.  The &#8220;content&#8221; div will then transition from left to right to display in that space.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
	width: false //default is false 
});
</pre>

<h4>opacity</h4>
<p>Default is true</p>
<p>This option sets whether or not to show an opacity transition effect when you hide and display content.  Since we are using the default options above, you can see the effect there.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
    opacity: true //default is true
});
</pre>

<h4>fixedHeight</h4>
<p>To set a fixed height, you can set an integer here (for example, you could put 100 for content 100px tall).  This should be used with some kind of CSS overflow property if you are planning on having a fixed height smaller than the contents natural height.  Works as you would expect, thought it does not seem to register is you use the &#8220;show&#8221; option when you first load the page.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
	fixedHeight: false //default is false
});
</pre>

<h4>fixedWidth</h4>
<p>Just like &#8220;fixedHeight&#8221; above, this will set the width if you give this option an integer.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
	fixedWidth: false //default is false 
});
</pre>

<h4>alwaysHide</h4>
<p>This option lets you add a toggle control to the titles.  With this set to true, when you click on an open content title, it will close that content element without opening anything else.  You can see this in action in the full example below.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
	alwaysHide: false //default is false
});
</pre>

<h3>Events</h3>
<h4>onActive</h4>
<p>This will fire when you toggle open an element.  It will pass the toggle control element and the content element that is opening and parameters.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
	onActive: function(toggler, element) {
		toggler.highlight('#76C83D'); //green
		element.highlight('#76C83D');
	}
});
</pre>

<h4>onBackground</h4>
<p>This will fire when an element starts to hide and will pass all other elements that are closing, but not opening.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
	onBackground: function(toggler, element) {
		toggler.highlight('#DC4F4D'); //red
		element.highlight('#DC4F4D');	
	}
});
</pre>

<h4>onComplete</h4>
<p>This is your standard onComplete event.  It passes a variable containing the content element.  There may be a better way to get these, if anyone knows, drop a note.</p>

<pre class="prettyprint">
var AccordionObject = new Accordion(toggles, content { 
	onComplete: function(one, two, three, four){
		one.highlight('#5D80C8'); //blue
		two.highlight('#5D80C8');
		three.highlight('#5D80C8');
		four.highlight('#5D80C8'); 
	}
});
</pre>

<h3>Methods</h3>
<h4>.addSection();</h4>
<p>With this method, you can add a section (a toggle/content element pair).  It works like many of the other methods we have seen.  First refer to the accordion object, tack on .addSection, then you can call the id of the title, the id of the content, and finally state what position you want the new content to appear (0 being the first spot).</p>

<pre class="prettyprint">
AccordionObject.addSection('togglersID', 'elementsID', 2);
</pre>

<p><strong>Note:</strong> When you add a section like this, though it will show up in the spot of index 2, the actual index will be be +1 the last index.  So if you have 5 items in your array (0-4) and you add a 6th, its index would be 5 regardless of where you add it with .addSection();</p>

<h4>.display();</h4>
<p>This lets you open a given element.  You can select the element by its index (so if you have added an element pair and you want to display it, you will have a different index here than you would use above.</p>

<pre class="prettyprint">
AccordionObject.display(5); //would display the newly added element
</pre>

<h3>Example</h3>
<p>Here we have a full featured accordi0n utilizing all of the events and methods we see above, as well as many of the options.  Check out the live example and cross reference with the code to see how everything works.</p>

<pre class="prettyprint">
//send the toggle and content arrays to vars
var toggles = $$('.togglers');
var content = $$('.elements');

//set up your object var
//create a "new" Accordion object
//set the toggle array
//set the content array
//set your options and events 
var AccordionObject = new Accordion(toggles, content, {

	//when you load the page
	//will "show" the content (by index)
	//with NO transition, it will just be open
	//also note: if you use "fixedHeight," 
	//show will not work when the page first loads
	//"show" will override "display"
	show: 0, 

	//when you load the page
	//this will "display" the content (by index)
	//and the content will transition open
	//if both display and show are set, 
	//show will override display
	//display: 0,

	//defaults to true
	//this creates a vertical accordion
	height : true,

	//this is for horizontal accordions
	//tricky to use due to the css involved
	//maybe a tutorial for another day?
	width : false,

	//defaults to true
	//will give the content an opacity transition
	opacity: true,

	//defaults to false, can be integar - 
	//will fix height of all content containters
	//would need an overflow css rule
	//wont work on page load if you use "show"
	fixedHeight: false, 

	//can be false or an integer
	//similiar to fixedHeight above, 
	//but for horizontal accordions
	fixedWidth: false,

	//lets you toggle an open item closed
	alwaysHide: true,

	//standard onComplete event
	//passes a variable containing the element for each content element		
	onComplete: function(one, two, three, four, five){
		one.highlight('#5D80C8'); //blue
		two.highlight('#5D80C8');
		three.highlight('#5D80C8');
		four.highlight('#5D80C8'); 
		five.highlight('#5D80C8'); //the added section
		$('complete').highlight('#5D80C8');
	},

	//this will fire when you toggle open an element
	//will pass the toggle control element
	//and the content element that is opening
	onActive: function(toggler, element) {
		toggler.highlight('#76C83D'); //green
		element.highlight('#76C83D');
		$('active').highlight('#76C83D');
	},

	//this will fire when an element starts to hide
	//will pass all other elements
	//the one closing or not opening
	onBackground: function(toggler, element) {
		toggler.highlight('#DC4F4D'); //red
		element.highlight('#DC4F4D');	
		$('background').highlight('#DC4F4D');	
	}

});

$('add_section').addEvent('click', function(){
	//the new section is made up of a pair 
	//(the new toggle ID and the corresponding Content ID) 
	//followed by where you want to place it in the index
	AccordionObject.addSection('togglersID', 'elementsID', 0);    
});


$('display_section').addEvent('click', function(){
	//will determine which object displays first on page load
	//will override the options display setting
	AccordionObject.display(4);  
});
</pre>

<p>Here you can see when the various events fire.</p>

<div id="complete" class="ind">onComplete</div>
<div id="active" class="ind">onActive</div>
<div id="background" class="ind">onBackground</div>

<p>Try adding the a new section with the button below.</p>

<div id="accordion_wrap">
	<p class="togglers">Toggle 1</p>
	<p class="elements">Here is the content of toggle 1 Here is the content of toggle 1 Here is the content of toggle 1 Here is the content of toggle 1 Here is the content of toggle 1 Here is the content of toggle 1 Here is the content of toggle 1 Here is the content of toggle 1</p>
	<p class="togglers">Toggle 2</p>
	<p class="elements">Here is the content of toggle 2</p>
	<p class="togglers">Toggle 3</p>
	<p class="elements">Here is the content of toggle 3</p>
	<p class="togglers">Toggle 4</p>
	<p class="elements">Here is the content of toggle 4</p>
	<p id="togglersID">Toggle Add</p>
	<p id="elementsID">Here is the content of toggle 4</p>
</div>

<p>    
	<button id="add_section" class="btn btn-primary">add section</button>
	<button id="display_section" class="btn btn-primary">display section</button>
</p>

<h4>Quirks</h4>
<ul>
	<li>.display will recognize the index, but if you use addSection, that section will be the last index</li>
	<li>if you use &#8220;fixedHeight,&#8221; &#8220;show&#8221; will not work on page load, but &#8220;display&#8221; works fine</li>
</ul>

<h4>More Accordion options, events and methods</h4>
<p>Accordion extends the Fx.Element class, which extends the Fx class.  You can use the various options in these classes to further refine your accordion.  Though it performs a simple task, the accordion is a useful and powerful plugin.  I would love to see any examples of people really pushing what it can do.</p>

<h3>To Learn More&#8230;</h3>
<p>Check out the docs sections on <a href="http://docs.mootools.net/Plugins/Accordion">accordion</a>, as well as <a href="http://docs.mootools.net/Plugins/Fx.Elements">Fx.Elements</a> and <a href="http://docs.mootools.net/Fx/Fx">Fx</a>.  You can also see the <a href="http://demos.mootools.net/Accordion">accordion at the Mootools official demos</a>.</p>

<h4>Tomorrow&#8217;s tutorial</h4>
<p><a href="index.php?day=18">Classes, part 1</a></p>				