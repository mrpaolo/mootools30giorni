<h2>MooTools classes part II</h2>
<p>Now that we&#8217;ve got our base class defined, we can access its functionality by creating another class which implements it. Note in the example below that our new class isn&#8217;t doing anything but implementing BaseClass.</p>

<pre class="prettyprint">
//Build a class called ImplementingClass
var ImplementingClass = new Class({
	//All we do is implement Baseclass
	Implements : BaseClass
});
</pre>

<p>Now we can create an instance of ImplementingClass and access the functionality defined in BaseClass completely transparently.</p>

<pre class="prettyprint">
var demo_one = function(){
	//Create a new instance of ImplementingClass
	var test_class = new ImplementingClass();

	//Call testFunction, which is defined in BaseClass
	test_class.testFunction();
}
</pre>

<p><button id="demo_one_button" class="btn btn-primary">demo_one()</button></p>

<p>You can do the same with variables and the initialize function. Pretty much everything you define in the base class will be transferred to the implementing class, as if you declared it in the implementing class.</p>

<p><strong>Note</strong>: We&#8217;re going to be using this version of BaseClass in the rest of the examples.</p>

<pre class="prettyprint">
var BaseClass = new Class({
	//Assign the parameter value
	//to the inputVariable variable
	//belonging to this class
	initialize: function(input){
		this.inputVariable = input;
	},
	
	//Display the value of inputVariable
	testFunction : function(){
		alert('BaseClass.testFunction() : ' + this.inputVariable);
	},
	//Define an internal variable
	//for all instances of this class
	definedVariable : "Defined in BaseClass"
});

var ImplementingClass = new Class({
	//Once again, all we're doing
	//is implementing the BaseClass
	Implements : BaseClass
});
</pre>

<p>The demo below demonstrates how the initialization routine, function calls, and variables are all accessed as if they belonged to the implementing class.</p>

<pre class="prettyprint">
var demo_two = function(){
	//Build an instance of ImplementingClass
	var test_class = new ImplementingClass('this is the input value');

	//Call testFunction() (defined in BaseClass)
	test_class.testFunction();

	//Display definedVariable
	alert('test_class.testVariable : ' + test_class.definedVariable);
}
</pre>

<p><button id="demo_two_button" class="btn btn-primary">demo_two()</button></p>

<p>Once you&#8217;ve implemented a class, you can add whatever functionality you want to the implementing class definition.</p>

<pre class="prettyprint">
var ImplementingClass = new Class({

	Implements : BaseClass,
	
	//Both of these are defined in BaseClass
	definedVariable : "Defined in ImplementingClass",

	testFunction : function(){
		alert('This function is also defined in BaseClass');
	},

	//Neither of these are defined in BaseClass
	anotherDefinedVariable : "Also Defined in ImplementingClass",
	anotherTestFunction : function(){
		alert('This function is defined in ImplementingClass');
	}
});
</pre>

<p>Note that we&#8217;re redefining testFunction and definedVariable in the implementing class as well as adding a new function and variable. Be aware that if you try to define a function or a variable that&#8217;s already declared in the base class <strong>using implements, the definition in the base class will supersede the definition in the implementing class</strong>. Check out the demo to see what I mean</p>

<pre class="prettyprint">
var demo_three = function(){

	//Build an instance of ImplementingClass
	var test_class = new ImplementingClass('this is the input value');

	//(defined in BaseClass)
	test_class.testFunction();

	//Display definedVariable (defined in BaseClass)
	alert('test_class.testVariable : ' + test_class.definedVariable);

	// (defined in ImplementingClass)
	test_class.anotherTestFunction();

	//Display anotherDefinedVariable (defined in ImplementingClass)
	alert('test_class.anotherDefinedVariable : ' + test_class.anotherDefinedVariable);
}
</pre>

<p><button id="demo_three_button" class="btn btn-primary">demo_three()</button></p>

<h3>Extends</h3>
<p>For situations where you want to overwrite what is defined in the base class you can use Extends. Simply replace the Implements with Extends.</p>

<pre class="prettyprint">
var ExtendingClass = new Class({

	//Note the use of Extends instead of Implements
	Extends : BaseClass,
	
	//Both of these are defined in BaseClass,
	//but since we're using extend instead of
	//implement, these override the ones defined
	//in BaseClass
	definedVariable : "Defined in ImplementingClass",
	testFunction : function(){
		alert('This function is also defined in BaseClass');
	}
});

var demo_four = function(){

	//Build an instance of ImplementingClass
	var test_class = new ExtendingClass('this is the input value');

	//Call testFunction() (defined in BaseClass and ExtendingClass)
	test_class.testFunction();

	//Display definedVariable (defined in BaseClass and ExtendingClass)
	alert('test_class.definedVariable : ' + test_class.definedVariable);
}
</pre>

<p><button id="demo_four_button" class="btn btn-primary">demo_four()</button></p>

<p>Another useful feature when using extends is the ability to overwrite the initialization function defined in the base class while still running the initialization function. So if you define this initialization function in a base class&#8230;</p>

<pre class="prettyprint">
initialize : function(){
	alert('base class');
}
</pre>

<p>&#8230;and then define this initialization function in the extending class, you&#8217;ll get two alerts saying &#8220;base class&#8221; and &#8220;extending class.&#8221;</p>

<pre class="prettyprint">
initialize : function(){
	//Call parent constructor
	this.parent();
	alert('extending class');
}
</pre>

<p>If the parent initialization function is expecting input, make sure to require the same input and pass it on to the parent constructor. In the example below, note that we&#8217;re not assigning the input value to anything here&mdash;simply passing it on to the parent constructor which takes care of it for us.</p>

<pre class="prettyprint">
var ExtendingClass = new Class({
	//Once again, we're extending, not implementing
	Extends : BaseClass,

	initialize: function(input){
		//Calling this.parent runs the initialization
		//function defined in the baseclass
		this.parent(input);

		//Doing so allows us to do additional
		//setup tasks during initialization without
		//rewriting the initalization code from the
		//base class
		this.otherVariable = "Original Input Was : " + input;
	}
});

var demo_five = function(){
	//Build our class
	var test_class = new ExtendingClass('this is the input value');	
	
	//run testFunction
	test_class.testFunction();
	
	//display otherVariable
	alert("test_class.otherVariable : " + test_class.otherVariable);
}
</pre>

<p><button id="demo_five_button" class="btn btn-primary">demo_five()</button></p>

<h3>.implement()</h3>
<p>Not only can you use implement and extends within your class definitions, you can also use them on preexisting classes to add functionality one piece at a time. For this example we&#8217;re going to be using a simple calculator class which can add and subtract two numbers that you define when creating the class.</p>

<pre class="prettyprint">
var Calculator = new Class({

	//Set two variables during initialization
	initialize: function(first_number, second_number){
		this.first  = first_number;
		this.second = second_number;
	},
	//Function to add the two internal
	//variables and return the result
	add : function(){
		result = this.first + this.second;
		alert(result);
	},
	//Function to subtract the two internal
	//variables and return the result
	subtract : function(){
		result = this.first - this.second;
		alert(result);
	}
});
</pre>

<p>While that&#8217;s all well and good if you&#8217;re just looking to add or subtract numbers, what if you want to multiply them? Using .implement(), we can just add a function on to the class and use it as if we had created another class that implemented Calculator as a base.</p>

<pre class="prettyprint">
var demo_six = function(){
	//implement a new function
	//in the calculator class
	Calculator.implement({
		//Function to multiply the two internal
		//variables and return the result
		multiply : function(){
			result = this.first * this.second;
			alert(result);
		}
	});	

	//Build a calculator class
	var myCalculator = new Calculator(100, 50);

	//Call the multiply function
	myCalculator.multiply();
}
</pre>

<p><button id="demo_six_button" class="btn btn-primary">demo_six()</button></p>

<p>In part I of Classes, we used the print_r function for <a href="http://kevin.vanzonneveld.net/techblog/article/javascript_equivalent_for_phps_print_r/">javascript debugging</a>. Using implement, we can make it incredibly painless to print out the contents of the variable class simply by implementing a function in the Calculator class.</p>

<pre class="prettyprint">
var demo_seven = function(){
	//Implement a function to print out
	//the contents of the Calculator class
	Calculator.implement({
		show_class : function(){
			alert(print_r(this, true));
		}
	});

	//Build a calculator
	var myCalculator = new Calculator(100, 50);

	//Show the class details
	myCalculator.show_class();
}
</pre>

<p><button id="demo_seven_button" class="btn btn-primary">demo_seven()</button></p>

<h3>Example</h3>
<p>While neat, this isn&#8217;t a particularly useful feature for the calculator class due to its relatively straightforward nature. However, since most of the Mootools objects are built as classes, we can use the same methodology on them to get something a little more useful.</p>

<p>The example below implements a function which throws out a pop-up window containing the structure of whatever HTML element you&#8217;d like to examine. This functionality is now automatically added to any HTML element you interact with, so all you have to do is add a showStructure() command to your element to get a full description of what that element is holding.</p>

<pre class="prettyprint">
var demo_eight = function(){
	Element.implement({
		showStructure : function(){

			//the &lt; and &gt; have been removed from the pre tags
			//because they're interpreted by the browser, and
			//wordpress isn't taking nicely to character codes
			//embedded in pre blocks
			var structure = 'pre' + print_r(this, true) + '/pre';

			//Open a popup window
			newWindow = window.open('','Element Debug','height=600,width=600,scrollbars=yes');
			
			//Write the structure into the popup window
			newWindow.document.write(structure);
		}
	});

	$('demo_eight').showStructure();

}
</pre>

<p><strong>Note</strong>: you&#8217;ll need to disable popup blockers for this to work.</p>

<p><button id="demo_eight_button" class="btn btn-primary">demo_eight()</button></p>

<h3>To Learn More</h3>
<p><a href="http://mootools.net/docs/Class/Class">Mootools Class Docs</a><br />
An <a href="http://www.mootorial.com/wiki/mootorial/02-class">excellent discussion</a> of some of the finer points of classes in Mootools.</p>

<h4>Tomorrow&#8217;s tutorial</h4>
<p><a href="index.php?day=22">Morph multiple elements with Fx.Morph</a></p>					