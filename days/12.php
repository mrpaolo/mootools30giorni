<h2>Drag.Move - Drag and Drop with Mootools 1.2</h2>
<p>If you haven&#8217;t already, be sure and check out the rest of the <a href="index.php?day=01">Mootools 1.2 tutorials</a> in our 30 days series.</p>

<p>Welcome to Day 12 of 30 Days of Mootools.  Today we are going to take a close look at Drag.Move, a powerful Mootools class that lets you add drag and drop functionality to your web application.  It is set up like the rest of the plugins we have looked at: you create your &#8220;new&#8221; Drag.Move object and pass it to a var.  Then you define your options and events.  That&#8217;s pretty much all there is to it, but be sure to check out the description of IE CSS quirks in the example.</p>

<h3>The Basics</h3>
<h4>Drag.Move</h4>
<p>Setting up your drag object is very easy.  Just take a look below.  Notice how we have separated out our Drag.Move options and events from our Drag options and events.  Drag.Move extends Drag, so it will accept both its options and events, as well as Drag&#8217;s.  We are not going to look at Drag specifically today, but we are going to explore a few of the useful options and events.  Take a look at the code below, then read on to learn the specifics. </p>

<pre class="prettyprint">
var myDrag = new Drag.Move(dragElement, {
	// Drag.Move Options
	droppables: dropElement,
	container: dragContainer,

	// Drag Options
	handle: dragHandle,
	
	// Drag.Move Events
	// the Drag.Move events pass the dragged element, 
	// and the dropped into droppable element
	onDrop: function(el, dr) {
		//will alert the id of the dropped into droppable element
		alert(dr.get('id'));
	},
	// Drag Events
	// Drag events pass the dragged element
	onComplete: function(el) {
		alert(el.get('id'));
	}
});
</pre>

<p>Let&#8217;s break this down a bit&#8230;</p>
<h4>Drag.Move Options</h4>

<p>The Drag.Move options let you set two important elements:</p>

<p><strong>droppables</strong> - Set the selector of droppable elements (which elements will register on drop related events)</p>

<p><strong>container</strong> - Set the drag element&#8217;s container (will keep the element inside)</p>

<p>Setting the options is simple:</p>

<pre class="prettyprint">
//here we define a single element by id 
var dragElement = $('drag_element');

//here we define an array of elements by class
var dropElements = $$('.drag_element');

var dragContainer = $('drag_container');

//now we set up our Drag.Move object
var myDrag = new Drag.Move(dragElement , {
	// Drag.Move Options
	// set up our droppables element with the droppables var we defined above
	droppables: dropElements ,
	// set up our container element with the container element var
	container: dragContainer 
});
</pre>

<p>Now your draggable element is contained and you have a class that will accept drops.</p>

<h4>Drag.Move Events</h4>
<p>The events give you the ability to fire a function at different points, such as when you start to drag the object or when you drop it.  Each Drag.Move event will pass the dragged element and the dropped into element (as long as its droppable) as parameters.</p>

<p><strong>onDrop</strong> - this will fire when you drop the draggable element into a droppable element</p>
<p><strong>onLeave</strong> - fires when a draggable element leaves a droppable element&#8217;s bounds</p>
<p><strong>onEnter</strong> - fires when a draggable element enters a droppable element</p>

<p>Each of these events will call a function and that function will fire when the event happens.</p>

<pre class="prettyprint">
var dragContainer = $('drag_container');
 
var myDrag = new Drag.Move(dragElement , {
	
	// Drag.Move Options
	droppables: dropElements ,
	container: dragContainer ,

	// Drag.Move Options
	// the Drag.Move functions will pass the draggable element ('el' in this case)
	// and the droppable element the draggable is interacting with ('dr' here)
	onDrop: function(el, dr) {

		// roughly translates to, "if the element you drop onto is NOT a droppable element
		if (!dr) { 
			//dont do anything
		}
		// otherwise (logically meaning, if the element you drop onto IS droppable
		// do this other thing here
		else {
			//have something happen when you drop on a droppable
		};
	},
	onLeave: function(el, dr) {
		// this will fire when a draggable leaves a droppable element
	},
	onEnter: function(el, dr) {
	// this will fire when a draggable enters a droppable element
	}
});
</pre>

<h4>A few Drag events and options</h4>
<p>There are quite a few options and events for Drag, but here we are just going to look at a few.</p>

<p><strong>snap - option</strong></p>
<p>Snap lets you set how many px the user must drag their cursor before the draggable element starts dragging.  The default is 6, and you can set it any number or variable representing a number.  Clearly, there are limits to what is reasonable (setting snap to 1000 wouldn&#8217;t be all that useful), but this does come in handy by letting you customize the user experience that much more.</p>

<pre class="prettyprint">
var myDrag = new Drag.Move(dragElement , {
	// Drag Options
	snap: 10 
});
</pre>

<p><strong>handle - option</strong></p>
<p>Handle adds a handle to your draggable element.  The handle becomes the only element that will accept the &#8216;grab,&#8217; letting you use the rest of the element for other things.  To set up a handle, just call the element.</p>

<pre class="prettyprint">
// here we are setting up an array using a class selector
// this will let us easily add multiple handles if we decide to have multiple draggables
var dragHandle = $('drag_handle');
var myDrag = new Drag.Move(dragElement , {
	// Drag Options
	handle: dragHandle 
});
</pre>

<p><strong>onStart - event</strong></p>
<p>On start does what it says, fires an event on the start of drag.  If you have a long snap set, then this event wouldn&#8217;t fire until the mouse had gone that distance.</p>

<pre class="prettyprint">
var myDrag = new Drag.Move(dragElement , {
	// Drag Options
	// Drag options will pass the dragged element as a parameter
	onStart: function(el) {
		// put whatever you want to happen on start in here
	}
});
</pre>

<p><strong>onDrag - event</strong></p>
<p>This event, onDrag, will fire continuously while you are dragging an element.</p>

<pre class="prettyprint">
var myDrag = new Drag.Move(dragElement , {
	// Drag Options
	// Drag options will pass the dragged element as a parameter
	onDrag: function(el) {
		// put whatever you want to happen on drag in here
	}
});
</pre>

<p><strong>onComplete - event</strong></p>
<p>Finally, onComplete refers to when you drop a grabbable, and it will fire whether or not you land in a droppable.</p>

<pre class="prettyprint">
var myDrag = new Drag.Move(dragElement , {
	// Drag Options
	// Drag options will pass the dragged element as a parameter
	onComplete: function(el) {
		// put whatever you want to happen on complete
	}
});
</pre>

<h3>Example</h3>
<p>Let&#8217;s put this all together in a way that highlights when different events fire, and let&#8217;s use the options we looked at above to configure the Drag.Move object:</p>

<pre class="prettyprint">
window.addEvent('domready', function() {

	var dragElement = $('drag_me');
	var dragContainer = $('drag_cont');
	var dragHandle = $('drag_me_handle');
	var dropElement = $$('.draggable');
	var startEl = $('start');
	var completeEl = $('complete');
	var dragIndicatorEl = $('drag_ind');
	var enterDrop = $('enter');
	var leaveDrop = $('leave');
	var dropDrop = $('drop_in_droppable'); 

	var myDrag = new Drag.Move(dragElement, {
		// Drag.Move options
		droppables: dropElement,
		container: dragContainer,
		// Drag options
		handle: dragHandle,
		// Drag.Move Events
		onDrop: function(el, dr) {
			if (!dr) { }
			else {
				dropDrop.highlight('#FB911C'); //flashes orange
				el.highlight('#fff'); //flashes white
				dr.highlight('#667C4A'); //flashes green
			};
		},
		onLeave: function(el, dr) {
			leaveDrop.highlight('#FB911C'); //flashes orange
		},
		onEnter: function(el, dr) {
			enterDrop.highlight('#FB911C'); //flashes orange
		},
		// Drag Events
		onStart: function(el) {
			startEl.highlight('#FB911C'); //flashes orange
		},
		onDrag: function(el) {
			dragIndicatorEl.highlight('#FB911C'); //flashes orange
		},
		onComplete: function(el) {
			completeEl.highlight('#FB911C'); //flashes orange
		}
	});
});
</pre>

<p><strong>Note on the css:</strong> For the Drag.Move container to register properly in IE, you will need to be sure to include positioning spelled out in the following css.  The important part is to remember to set the container with &#8220;position: relative&#8221; and the draggable with &#8220;position: absolute,&#8221; then be sure to set the position of the draggable with &#8220;left&#8221; and &#8220;top.&#8221;  Now, if you are just building for all the other browsers that follow the rules, you can ignore this part:</p>

<pre class="prettyprint">
/* this is generally a good idea */
body {
	margin: 0
	padding: 0
}
 
/* make sure the draggable element has "position: absolute" 
 and then top and left are set for the start position */
#drag_me {
	width: 100px
	height: 100px
	background-color: #333
	position: absolute
	top: 0
	left: 0
}
 
#drop_here {
	width: 200px
	height: 200px
	background-color: #eee
}
 
/* make sure the drag container is set with position relative */
#drag_cont {
	background-color: #ccc  
	height: 600px 
	width: 500px
	position: relative
	margin-top: 100px
	margin-left: 100px
}
 
#drag_me_handle {
	width: 100%
	height: auto
	background-color: #666

}
 
#drag_me_handle span {
	display: block
	padding: 5px
}
 
.indicator {
	width: 100%
	height: auto
	background-color: #0066FF
	border-bottom: 1px solid #eee
}
 
.indicator span {
	padding: 10px
	display: block
}
 
.draggable {
	width: 200px
	height: 200px
	background-color: blue
}
</pre>

<p>And now we set up our html:</p>

<pre class="prettyprint">
&lt;div id=&quot;drag_cont&quot;&gt;
	&lt;div id=&quot;start&quot; class=&quot;indicator&quot;&gt;&lt;span&gt;Start&lt;/span&gt;&lt;/div&gt;
	&lt;div id=&quot;drag_ind&quot; class=&quot;indicator&quot;&gt;&lt;span&gt;Drag&lt;/span&gt;&lt;/div&gt;
	&lt;div id=&quot;complete&quot; class=&quot;indicator&quot;&gt;&lt;span&gt;Complete&lt;/span&gt;&lt;/div&gt;
	&lt;div id=&quot;enter&quot; class=&quot;indicator&quot;&gt;&lt;span&gt;Enter Droppable Element&lt;/span&gt;&lt;/div&gt;
	&lt;div id=&quot;leave&quot; class=&quot;indicator&quot;&gt;&lt;span&gt;Leave Droppable Element&lt;/span&gt;&lt;/div&gt;
	&lt;div id=&quot;drop_in_droppable&quot; class=&quot;indicator&quot;&gt;&lt;span&gt;Dropped in Droppable Element&lt;/span&gt;&lt;/div&gt;
	&lt;div id=&quot;drag_me&quot;&gt;
		&lt;div id=&quot;drag_me_handle&quot;&gt;&lt;span&gt;handle&lt;/span&gt;&lt;/div&gt;
	&lt;/div&gt;
	&lt;div id=&quot;drop_here&quot; class=&quot;draggable&quot;&gt;&lt;/div&gt;
&lt;/div&gt;
</pre>

<div id="drag_cont">
<div id="start" class="indicator">
	<span>Start</span>
</div>

<div id="drag_ind" class="indicator">
	<span>Drag</span>
</div>

<div id="complete" class="indicator">
	<span>Complete</span>
</div>

<div id="enter" class="indicator">
	<span>Enter Droppable Element</span>
</div>

<div id="leave" class="indicator">
	<span>Leave Droppable Element</span>
</div>

<div id="drop_in_droppable" class="indicator">
	<span>Dropped in Droppable Element</span>
</div>

<div id="drag_me">
	<div id="drag_me_handle">
		<span>handle</span>
	</div>
</div>

<div id="drop_here" class="draggable"></div>
</div>

<h3>To Learn More&#8230;</h3>
<p>Here are few relevant sections from the docs:</p>

<ul>
	<li><a href="http://docs.mootools.net/Plugins/Drag">Drag</a></li>
	<li><a href="http://docs.mootools.net/Plugins/Drag.Move">Drag.Move</a></li>
</ul>

<h4>Tomorrow&#8217;s Tutorial</h4>
<p><a href="index.php?day=13">For Day 13, we are going to look at using regular expressions with Mootools 1.2</a></p>

					