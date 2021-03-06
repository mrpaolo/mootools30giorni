<h2>Mootools 1.2 Fx.Morph, Fx Options, and Fx Events</h2>
<p>If you haven&#8217;t already, be sure and check out the rest of the <a href="index.php?day=01">Mootools 1.2 tutorials</a> in our 30 days series.</p>

<p>Today, we are going continue exploring the Fx section of the library.  First, we will learn how to use Fx.Morph (which essentially lets you tween multiple style properties), then we are going check out some of the Fx options that apply to both Fx.Tween and Fx.Morph, finally we will see how to use Fx events like &#8220;onComplete&#8221; and &#8220;onStart.&#8221;  With these options and events, we will gain finer control over animated transitions. </p>

<h3>Fx.Morph</h3>
<h4>Creating a new Fx.Morph</h4>
<p>Initiating a new morph looks a lot like creating a new tween, except you have to account for multiple style properties.</p>

<pre class="prettyprint">
//first, lets throw our element into a var
var morphElement = $('morph_element');

//now, we create our morph
var morphObject = new Fx.Morph(morphElement);

//now we can set the style properties just like Fx.Tween
//except now we can set multiple style properties
morphObject.set({
	'width': 100,
	'height': 100,
	'background-color': '#eeeeee'
});
 
//we can also start our morph like we would start a tween
//except we can now input multiple style properties
morphObject.start({
	'width': 300,
	'height': 300,
	'background-color': '#d3715c'
});
</pre>

<p>And that is all there is to creating, setting and starting a morph.</p>

<p>To set this up proper, we should create our variables, separate out our functions and create a few events to control the whole thing:</p>

<pre class="prettyprint">
var morphSet = function(){
	//now we can set the style properties just like Fx.Tween
	//except now we can set multiple style properties
	this.set({
		'width': 100,
		'height': 100,
		'background-color': '#eeeeee'
	});
}
 
var morphStart = function(){
	//we can also start out morph like we would start a tween
	//except we can now input multiple style properties
	this.start({
		'width': 300,
		'height': 300,
		'background-color': '#d3715c'
	});
}
 
 
var morphReset = function(){
	//set the values back to start
	this.set({
		'width': 0,
		'height': 0,
		'background-color': '#ffffff'
	});
}
 
window.addEvent('domready', function() {
    //first, lets throw our element into a var
	var morphElement = $('morph_element');
 
	//now, we create our morph
	var morphObject = new Fx.Morph(morphElement);
 
	//here we add the click event to the buttons
	//and we bind morphObject and the function
	//allowing us to use "this" above
	$('morph_set').addEvent('click', morphSet.bind(morphObject));  
	$('morph_start').addEvent('click', morphStart.bind(morphObject));
	$('morph_reset').addEvent('click', morphReset.bind(morphObject));
});
</pre>


<pre class="prettyprint">
&lt;div id=&quot;morph_element&quot;&gt;&lt;/div&gt;
&lt;button id=&quot;morph_set&quot;&gt;Set&lt;/button&gt;
&lt;button id=&quot;morph_start&quot;&gt;Start&lt;/button&gt;
&lt;button id=&quot;morph_reset&quot;&gt;reset&lt;/button&gt;
</pre>

<div id="morph_element"></div>
<p>
	<button id="morph_set" class="btn btn-primary">Set</button>
	<button id="morph_start" class="btn btn-primary">Start</button>
	<button id="morph_reset" class="btn btn-primary">Reset</button>
</p>

<h3>The Fx Options</h3>
<p>The following options are accepted by both Fx.Tween and Fx.Morph.  They are simple to implement and give you a ton of control over your effects.  To set these options, use the following syntax:</p>

<pre class="prettyprint">
//set up your tween or morph
//then just set up your options between the { }

var morphObject = new Fx.Morph(morphElement, {
    //first state the name of the option
    //place a :
    //then define your option
    duration: 'long',
    transition: 'sine:in'
});
</pre>

<h4>fps (frames per second)</h4>
<p>This option determines the frames per second of the animation.  The default is 50, and it will accept numbers and variables that contain numbers</p>

<pre class="prettyprint">
//set up your tween or morph
//then just set up your options between the { }
var morphObject = new Fx.Morph(morphElement, {
    fps: 60
});
 
//or
var framesPerSecond = 60;
 
var tweenObject = new Fx.Tween(tweenElement, {
    fps: framesPerSecond
});
</pre>

<h4>unit</h4>
<p>This option sets the number unit.  For example, do you want &#8216;100&#8242; to mean px, % or ems?</p>

<pre class="prettyprint">
//set up your tween or morph
//then just set up your options between the { }
var morphObject = new Fx.Morph(morphElement, {
    unit: '%'
});
</pre>

<h4>link</h4>
<p>Link provides a way for you to manage multiple calls to start an effect.  For example, if you have a mouseover effect, do you want it to start over each time the user hovers?  Or, if a person mouses over the object twice, should it ignore the second call to start or should it chain them up and start a second time once it finishes the first round?  Link has three settings:</p>

<ul>
	<li>&#8216;ignore&#8217; (default) - ignore just ignores any calls to start until its done with the effect</li>
	<li>&#8216;cancel&#8217; - will cancel the current effect if another call is made, giving the newest call precedence</li>
	<li>&#8216;chain&#8217; - chain lets you &#8220;chain&#8221; the effects together and will stack the calls and execute them until it goes through all the chained calls</li>
</ul>

<pre class="prettyprint">
//set up your tween or morph
//then just set up your options between the { }
var morphObject = new Fx.Morph(morphElement, {
    link: 'chain'
});
</pre>

<h4>duration</h4>
<p>Duration lets you define how long the animation will take.  Duration is not the same thing as speed, so if you want an object to move 100px in a duration of 1 second, it will go slower than an object moving 1000px in 1 second.  You can input a number (measured in milliseconds), a variable containing a number, or one of three shortcuts:</p>

<ul>
	<li>&#8217;short&#8217; = 250ms</li>
	<li>&#8216;normal&#8217; = 500ms (default)</li>
	<li>&#8216;long&#8217; = 1000ms</li>
</ul>

<pre class="prettyprint">
//set up your tween or morph
//then just set up your options between the { }
var morphObject = new Fx.Morph(morphElement, {
    duration: 'long'
});
 
//or
var morphObject = new Fx.Morph(morphElement, {
    duration: 1000
});
</pre>

<h4>transition</h4>
<p>The last option, transition, gives you the ability to determine the transition type.  For example, should it be a smooth transition or should it start out slowly then speed up toward the end.  Check out these examples of the transitions available with the Mootools core library:</p>

<pre class="prettyprint">
var tweenObject = new Fx.Tween(tweenElement, {
    transition: 'quad:in'
});
</pre>

<p><strong>Note:</strong> the first transition bar fires a red highlight effect on start and an orange highlight effect on complete.  Check out how to use Fx events below.</p>

<div id="quadin" class="transitions">&#8216;quad:in&#8217;</div>
<div id="quadout" class="transitions zebra">&#8216;quad:out&#8217;</div>
<div id="quadinout" class="transitions">&#8216;quad:in:out&#8217;</div>
<div id="cubicin" class="transitions zebra">&#8216;cubic:in&#8217;</div>
<div id="cubicout" class="transitions">&#8216;cubic:out&#8217;</div>
<div id="cubicinout" class="transitions zebra">&#8216;cubic:in:out&#8217;</div>
<div id="quartin" class="transitions">&#8216;quart:in&#8217;</div>
<div id="quartout" class="transitions zebra">&#8216;quart:out&#8217;</div>
<div id="quartinout" class="transitions">&#8216;quart:in:out&#8217;</div>
<div id="quintin" class="transitions zebra">&#8216;quint:in&#8217;</div>
<div id="quintout" class="transitions">&#8216;quint:out&#8217;</div>
<div id="quintinout" class="transitions zebra">&#8216;quint:in:out&#8217;</div>
<div id="expoin" class="transitions">&#8216;expo:in&#8217;</div>
<div id="expoout" class="transitions zebra">&#8216;expo:out&#8217;</div>
<div id="expoinout" class="transitions">&#8216;expo:in:out&#8217;</div>
<div id="circin" class="transitions zebra">&#8216;circ:in&#8217;</div>
<div id="circout" class="transitions">&#8216;circ:out&#8217;</div>
<div id="circinout" class="transitions zebra">&#8216;circ:in:out&#8217;</div>
<div id="sinein" class="transitions">&#8217;sine:in&#8217;</div>
<div id="sineout" class="transitions zebra">&#8217;sine:out&#8217;</div>
<div id="sineinout" class="transitions">&#8217;sine:in:out&#8217;</div>
<div id="backin" class="transitions zebra">&#8216;back:in&#8217;</div>
<div id="backout" class="transitions">&#8216;back:out&#8217;</div>
<div id="backinout" class="transitions zebra">&#8216;back:in:out&#8217;</div>
<div id="bouncein" class="transitions">&#8216;bounce:in&#8217;</div>
<div id="bounceout" class="transitions zebra">&#8216;bounce:out&#8217;</div>
<div id="bounceinout" class="transitions">&#8216;bounce:in:out&#8217;</div>
<div id="elasticin" class="transitions zebra">&#8216;elastic:in&#8217;</div>
<div id="elasticout" class="transitions">&#8216;elastic:out&#8217;</div>
<div id="elasticinout" class="transitions zebra">&#8216;elastic:in:out&#8217;</div>

<p>The 30 transition types above break down into 10 sets:</p>

<ul>
	<li>Quad</li>
	<li>Cubic</li>
	<li>Quart</li>
	<li>Quint</li>
	<li>Expo</li>
	<li>Circ</li>
	<li>Sine</li>
	<li>Back</li>
	<li>Bounce</li>
	<li>Elastic</li>
</ul>

<p>Each set has three options:</p>

<ul>
	<li>Ease In</li>
	<li>Ease Out</li>
	<li>Ease In Out</li>
</ul>

<h3>Fx Events</h3>
<p>The Fx event give you the opportunity to fire some code at different points throughout the animation effect.  This can be very useful for creating user feedback and gives you yet another level of control over your tweens and morphs:</p>

<ul>
	<li>onStart - will fire when the Fx starts</li>
	<li>onCancel - will fire when the Fx is cancelled</li>
	<li>onComplete - will fire when the Fx is complete</li>
	<li>onChainComplete - will fire when chained Fx completes</li>
</ul>

<p>When building a tween or a morph, you can set set up one of these events just like you would an option, except instead of a value, you give it a function:</p>

<pre class="prettyprint">
//first we pass the new Fx.Tween to a variable
//then we define the element to tween
quadIn = new Fx.Tween(quadIn, {
	//here are some options
	link: 'cancel',
	transition: ‘quad:in’,

	//here are some events
	onStart: function(passes_tween_element){
		//these event will pass the tween object
		//so here we are applying the "highlight" effect
		//when the animation starts
		passes_tween_element.highlight('#C54641');
	},

	//notice how the commas are consistent
	//between every option and event
	//and NO COMMA AFTER THE LAST option or event  
	onComplete: function(passes_tween_element){
		//and here we apply the highlight effect on complete
		passes_tween_element.highlight('#C54641');
	}
});
</pre>

<h3>Example</h3>
<p>To generate the transition code above, we can reuse our functions in a way we haven&#8217;t seen in this series before.  All of the transition elements above use two functions, one to tween out on mouse enter and one to tween back on mouse leave:</p>

<pre class="prettyprint">
//this is the function we use on mouse enter, tweens width to 700px
var enterFunction = function() {
	this.start('width', '700px');
}
 
//this is the function we use on mouse leave, tweens width back to 300px
var leaveFunction = function() {
	this.start('width', '300px');
}
 
window.addEvent('domready', function() {

    //here we create throw some elements into vars
    var quadIn = $('quadin');
    var quadOut = $('quadout');
    var quadInOut = $('quadinout');
 
    //then we create three tween elements, one for each var above
    quadIn = new Fx.Tween(quadIn, {
		link: 'cancel',
		transition: Fx.Transitions.Quad.easeIn,
		onStart: function(passes_tween_element){
			passes_tween_element.highlight('#C54641');
		},
		onComplete: function(passes_tween_element){
			passes_tween_element.highlight('#E67F0E');
		}	
    });
 
	quadOut = new Fx.Tween(quadOut, {
		link: 'cancel',
		transition: 'quad:out'
    });

    quadInOut = new Fx.Tween(quadInOut, {
		link: 'cancel',
		transition: 'quad:in:out'
    });
 
    //now we add the mouse enter and mouse leave events
    //notice the use of .addEvents
    //this works just like .addEvent
    //except you can add multiple events using the pattern below 
    $('quadin').addEvents({
        //first, you say what kind of event, place event type inside 'single quotes'
        //then place a :
        //finally you state your function
        //in this case, its a function that binds to the tween
        'mouseenter': enterFunction.bind(quadIn),
        'mouseleave': leaveFunction.bind(quadIn)
    });
 
    $('quadout').addEvents({
        //notice how we reuse the same functions here
        'mouseenter': enterFunction.bind(quadOut),
        'mouseleave': leaveFunction.bind(quadOut)
    });
 
    $('quadinout').addEvents({
        //we also use those same functions here
        //but each time they apply to an event on a different element
        //and bind to a different tween
        'mouseenter': enterFunction.bind(quadInOut),
        'mouseleave': leaveFunction.bind(quadInOut)
    });
});
</pre>

<h3>To Learn More&#8230;</h3>
<p>You can gain even finer grained control over your effects with the tools in the Fx library.  Be sure to read over the <a href="http://docs.mootools.net/Fx/Fx">Fx</a> section in the docs, as well as <a href="http://docs.mootools.net/Fx/Fx.Tween">tween</a>, <a href="http://docs.mootools.net/Fx/Fx.Morph">morph</a> and <a href="http://docs.mootools.net/Fx/Fx.Transitions">transitions</a></p>

<h4>Tomorrow&#8217;s Mootools 1.2 Tutorial</h4>
<p>Day 12 - <a href="index.php?day=12">Drag and Drop with Drag.Move</a></p>