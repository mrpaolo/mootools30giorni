<!-- Working Examples for Day 05 -->
<script type="text/javascript" src="days/js/05.js" ></script>

<h2>Event Handling in Mootools 1.2</h2>
<p>If you haven&#8217;t already, be sure and check out the rest of the <a href="index.php?day=04">Mootools 1.2 tutorials</a> in our 30 days series.</p>

<p>Welcome to Day 5 of <strong>30 Days of Mootools</strong>.  In the last tutorial we looked at different ways to create and use functions within Mootools 1.2.  The next step is to get a grasp on events.  Like selectors, events are an essential part of creating an interactive UI.  Once you get a hold of an element, you need to then decide what action will cause what effect.  Leaving the effects for a later tutorial, lets take a look at that middle step and explore some common events.</p>

<h3>Single Left Click</h3>
<p>The single left click is the most common event in web development.  Hyperlinks recognize the click event and take you to another URL.  Mootools can recognize the click event on other DOM elements, giving you tremendous flexibility in design and functionality.  The first step is to add the click event to an element:</p>

<pre class="prettyprint">
//$('id_name') defines the element
//.addEvent adds the event
//('click') defines the type of event
$('id_name').addEvent('click', function(){
	//put whatever you want to happen on click in here
	alert('this element now recognizes the click event');
});
</pre>

<p>You can accomplish the same thing by separating out the function from .addEvent();.</p>

<pre class="prettyprint">
var clickFunction = function(){
	//put whatever you want to happen in here
	alert('this element now recognizes the click event');
}
 
window.addEvent('domready', function() {
	$('id_name').addEvent('click', clickFunction);
});
</pre>


<pre class="prettyprint">
&lt;body&gt;
    &lt;div id=&quot;id_name&quot;&gt; &lt;! -- this element now recognizes the click event --&gt;
    &lt;/div&gt;
&lt;/body&gt;
</pre>

<p><strong>Note</strong>: Just like the click event recognized by hyperlinks, Mootools&#8217; click event actually recognizes &#8220;mouse up,&#8221; meaning when you let go of the mouse button, <strong>not</strong> when you push it down.  This is to give users a chance to change their mind by dragging the mouse cursor off of the clicked element before letting the mouse button up.</p>

<h3>Mouse Enter &#038; Mouse Leave</h3>
<p>Hyperlinks also recognize &#8220;hover&#8221; events, where the cursor is over the anchor element.  With Mootools, you can add a hover event to other DOM elements.  By splitting it up into mouseenter and mouseleave, you get greater control over manipulating the DOM upon users&#8217; actions.</p>
<p>Just like before, the first thing we have to do is attach an event to an element</p>

<pre class="prettyprint">
var mouseEnterFunction = function(){
	//put whatever you want to happen in here
	alert('this element now recognizes the mouse enter event');
}
 
window.addEvent('domready', function() {
	$('id_name').addEvent('mouseenter', mouseEnterFunction);
});
</pre>

<p>Mouseleave works the same way.  This event fires when the cursor leaves an element.</p>

<pre class="prettyprint">
var mouseLeaveFunction = function(){
	//put whatever you want to happen in here
	alert('this element now recognizes the mouse leave event');
}

window.addEvent('domready', function() {
	$('id_name').addEvent('mouseleave', mouseLeaveFunction);
});
</pre>

<h3>Remove an Event</h3>
<p>There are times when you will need to remove an event from an element once it is no longer needed.  Removing an event is just as easy as adding one, and even follows a similar structure.</p>

<pre class="prettyprint">
//works just like the previous examples, only replace .addEvent with .removeEvent
$('id_name').removeEvent('mouseleave', mouseLeaveFunction);
</pre>

<h3>Keystrokes in Textarea or Input</h3>
<p>Mootools also lets you recognize keystrokes in textareas and inputs.  The syntax for this is just like what we saw above:</p>

<pre class="prettyprint">
var keydownEventFunction = function () {
	alert('This textarea can now recognize keystroke events');
};
 
window.addEvent('domready', function() {
	$('myTextarea').addEvent('keydown', keydownEventFunction);
});
</pre>

<p>The above code will recognize any keystroke. To target a particular keystroke, we need to add a <strong>parameter</strong> and use an <strong>if</strong> statement:</p>

<pre class="prettyprint">
//notice the paramater "event" within the function parenthesis
var keyStrokeEvent = function(event){
    // this says, "if the event key that was pressed is equal to "k," do the following."
    if (event.key == "k") {  
	    alert("This tutorial has been brought you by the letter k.") 
    };
}
 
window.addEvent('domready', function() {
    $('myTextarea').addEvent('keydown', keyStrokeEvent);
});
</pre>

<p>For other controls, such as &#8220;shift&#8221; and &#8220;control,&#8221; the syntax is slightly different:</p>

<pre class="prettyprint">
var keyStrokeEvent = function(event){
    // this says, "if the event key that was pressed is "shift," do the following."
    if (event.shift) { 
	    alert("You pressed shift.") 
    };
}
 
window.addEvent('domready', function() {
    $('myTextarea').addEvent('keydown', keyStrokeEvent);
});
</pre>

<h3>Example</h3>

<p>Here are some working examples of the code we went over above:</p>
<p><strong>Note</strong>: try clicking on the single click example, but instead of letting the left click button up, move your cursor off of the block with the button still held down.  Notice how it does NOT fire the click event.</p>

<pre class="prettyprint">
var keyStrokeEvent = function(event){
    // this says, "if the event key that was pressed is "k," do the following."
    if (event.key == 'k') { 
	    alert("This Mootorial was brought to you by the letter 'k.'")  
    };
}

var mouseLeaveFunction = function(){
    //put whatever you want to happen in here
    alert('this element now recognizes the mouse leave event');
}

var mouseEnterFunction = function(){
    //put whatever you want to happen in here
    alert('this element now recognizes the mouse enter event');
}

var clickFunction = function(){
    //put whatever you want to happen in here
    alert('this element now recognizes the click event');
}

window.addEvent('domready', function() {
    $('click').addEvent('click', clickFunction);
    $('enter').addEvent('mouseenter', mouseEnterFunction);
    $('leave').addEvent('mouseleave', mouseLeaveFunction);
    $('keyevent').addEvent('keydown', keyStrokeEvent);
});
</pre>


<pre class="prettyprint">
&lt;div id=&quot;click&quot; class=&quot;block&quot;&gt;Single Left Click&lt;/div&gt;&lt;br /&gt;
&lt;div id=&quot;enter&quot; class=&quot;block&quot;&gt;Mouse Enter&lt;/div&gt;&lt;br /&gt;
&lt;div id=&quot;leave&quot; class=&quot;block&quot;&gt;Mouse Leave&lt;/div&gt;&lt;br /&gt;
&lt;textarea id=&quot;keyevent&quot;&gt;Type the letter 'k'&lt;/textarea&gt;
</pre>

<p><button class="btn btn-primary" id="click">Single Left Click</button></p>
<p><button class="btn btn-primary" id="enter">Mouse Enter</button></p>
<p><button class="btn btn-primary" id="leave">Mouse Leave</button></p>
<p><textarea class="input-xlarge" id="keyevent">Type the letter &#8216;k&#8217;</textarea></p>

<h3>To Learn More&#8230;</h3>
<h4>More about Events</h4>
<p>Mootools gives you a lot more control over events than we have covered here.  To learn more, check out some of the following links:</p>
<ul>
<li><a href="http://docs.mootools.net/Native/Event">Events</a> within the Mootools docs</li>
<li><a href="http://docs.mootools.net/Element/Element.Event">Element.Events</a> in the Mootools docs</li>
<li>Also, read over w3schools&#8217; page on <a href="http://www.w3schools.com/jsref/jsref_events.asp">JavaScript events</a></li>
</ul>
<h4>Tomorrow&#8217;s Tutorial - HTML</h4>
<p><a href="index.php?day=06">Day 6 - Manipulating HTML Elements</a></p>
