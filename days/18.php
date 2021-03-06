<h2>MooTools Classes part I

<p>If you haven&#8217;t already, be sure and check out the rest of the <a href="index.php?day=01">Mootools 1.2 tutorials</a> in our 30 days series.</p>

<p>Today we&#8217;re going to be taking a look at the basics of creating and using classes with Mootools.</p>
<p>To put it simply, a class is a container for a collection of variables and functions which operate on those variables to perform specific tasks. Classes are incredibly helpful when working on a more involved project.</p>

<h3>Variables</h3>
<p>You&#8217;ve already seen the use of Hashes with key/value pairs <a href="index.php?day=14">earlier in the series</a>, so the example below of building a class which only contains variables should look pretty familiar:</p>

<pre class="prettyprint">
//Create a new class named class_one
//with two internal variables
var Class_one = new Class({
	variable_one : "I'm First",
	variable_two : "I'm Second"
});
</pre>

<p>Similarly, you can access these variables in the same manner as you would access the variables in a hash, note in the code below that we&#8217;re creating a new class of the class_one type defined above.</p>

<pre class="prettyprint">
var run_demo_one = function(){
	//instantiate a Class_one class called demo_1
	var demo_1 = new Class_one();
	
	//Display the variables inside demo_one
	alert( demo_1.variable_one );
	alert( demo_1.variable_two );	
}
</pre>

<p><button id="run_demo_1" class="demo_button" class="btn btn-primary">run_demo_1()</button></p>

<h3>Methods/Functions</h3>
<p>Method is the term used to refer to functions which belong to a specific class. These methods have to be called from an instance of this class, and can&#8217;t be called on their own. You define a method just like you would define a variable, except instead of giving it a static value, you pass it an anonymous function:</p>

<pre class="prettyprint">
var Class_two = new Class({
	variable_one : "I'm First",
	variable_two : "I'm Second",
	function_one : function(){
		alert('First Value : ' + this.variable_one);
	},
	function_two : function(){
		alert('Second Value : ' + this.variable_two);
	}
});
</pre>

<p>Note the use of <b>this</b> in the example above. Because the variables that these methods operate on are internal to the class, you need to access those variables using this, otherwise you&#8217;ll just get an undefined value.</p>

<pre class="prettyprint">
//Works
working_method : function(){
	alert('First Value : ' + this.variable_one);
},
//Doesn't work
broken_method : function(){
	alert('Second Value : ' + variable_two);
}
</pre>

<p>Calling the methods of the newly created class works like accessing the class variables</p>

<pre class="prettyprint">
var run_demo_2 = function(){
	//Instantiate a version of class_two
	var demo_2 = new Class_two();
	//Call function_one
	demo_2.function_one();
	//Call function_two
	demo_2.function_two();
}
</pre>

<p><button id="run_demo_2" class="demo_button" class="btn btn-primary">run_demo_2()</button></p>

<h3>initialize : </h3>
<p>The initialize option in the Class object gives you a place to put any set-up work that needs to be done for the class, as well as giving you a place to setup user-configurable options and variables. You define it just like you define a method:</p>

<pre class="prettyprint">
var Myclass = new Class({
	//Define an initalization function with one parameter
	initialize : function(user_input){
		//create a value variable belonging to
		//this class and assign it the value
		//of the user input
		this.value = user_input;
	}
})
</pre>

<p>You can also use the initialization to change other options or behavior:</p>

<pre class="prettyprint">
var Myclass = new Class({
	initialize : function(true_false_value){
		if (true_false_value){
			this.message = "Everything this message says is true";
		} else {
			this.message = "Everything this message says is false";
		}
	}
})

//Will set myClass_instance.message to 
//"Everything this message says is true"
var myclass_instance = new Myclass(true);

//Will set myClass_instance.message to 
//"Everything this message says is false"
var myclass_instance = new Myclass(false);
</pre>

<p>All this works right alongside with any other variable or method declarations you&#8217;d like to make. Just remember the commas after each { key/value hash }.  It&#8217;s really easy to miss one and spend absurd amounts of time tracking down non-existent bugs.</p>

<pre class="prettyprint">
var Class_three = new Class({
	//Function run when class is created
	initialize : function(one, two, true_false_option){
		this.variable_one = one;
		this.variable_two = two;
		if (true_false_option){
			this.boolean_option = "True Selected";
		} else {
			this.boolean_option = "False Selected";
		}
	},
	//Method Definitions
	function_one : function(){
		alert('First Value : ' + this.variable_one);
	},
	function_two : function(){
		alert('Second Value : ' + this.variable_two);
	}	
});

var run_demo_3 = function(){
	var demo_3 = new Class_three("First Argument", "Second Argument");
	demo_3.function_one();
	demo_3.function_two();
}
</pre>

<p><button id="run_demo_3" class="btn btn-primary">run_demo_3()</button></p>

<h3>Implementing Options</h3>
<p>When building classes, it&#8217;s often helpful to define some default values for the class to start with if the user doesn&#8217;t provide any input. You can do this manually by setting up default values in the initialization function, checking each of them to see if a parameter was passed, and replacing the default values when necessary. Or you could just make use of the <a href="http://docs.mootools.net/Class/Class.Extras#Options">Options</a> class provided by Mootools in Class.extras.</p>

<p>Adding the options functionality to your class is as simple as adding another key/value pair to the initialization options for your class:</p>

<pre class="prettyprint">
var Myclass = new Class({
	Implements: Options
})
</pre>

<p>Don&#8217;t worry to much about the details of the Implements option, we&#8217;ll be digging into that in more detail tomorrow. So now that you&#8217;ve got a class with the Options functionality, you need to define your default options. Just like everything else, this is done by adding another key/value pair to the class initialization options. Instead of passing a single value however, you&#8217;ll be defining a nested key value/set like so:</p>

<pre class="prettyprint">
var Myclass = new Class({
	Implements: Options,
	options: {
		option_one : "First Option",
		option_two : "Second Option"
	}
})
</pre>

<p>Now that we&#8217;ve got the default values set, we need a way for the user to override those default values when instantiating the class. All you need to do is add one line to your initialize function, and Options takes care of the rest:</p>

<pre class="prettyprint">
var Myclass = new Class({
	Implements: Options,
	options: {
		option_one : "First Default Option",
		option_two : "Second Default Option"
	}
	initialize: function(options){
		this.setOptions(options);
	}
})
</pre>

<p>Once this is set up, you can override any or all of the default options by passing it key/value pairs</p>

<pre class="prettyprint">
//Override both of the default options
var class_instance = new Myclass({
	options_one : "Override First Option",  
	options_two : "Override Second Option"
});

//Override one of the default options
var class_instance = new Myclass({
	options_two : "Override Second Option"
})
</pre>

<p>Note the use of the setOptions method in the initialization function. This is a method that is provided by Options, and also allows you to set the options once the class has been instantiated.</p>

<pre class="prettyprint">
var class_instance = new Myclass();
//Set the first option
class_instance.setOptions({
	options_one : "Override First Option"
});
</pre>

<p>Once the options have been set, you can access them through the options variable</p>

<pre class="prettyprint">
var class_instance = new Myclass();
//Get the value of the first option 
var class_option = class_instance.options.options_one;
//class_option is now equal to "First Default Option"
</pre>

<p>If you want to access the variable from inside the class, be sure to use the <i>this</i> syntax:</p>

<pre class="prettyprint">
var Myclass = new Class({
	Implements: Options,
	options: {
		option_one : "First Default Option",
		option_two : "Second Default Option"
	}
	test : function(){
		//Note that we're using this to
		//refer to the class 
		alert(this.option_two);
	}
});

var class_instance = new Myclass();
//Will pop-up an alert saying "Second Default Option"
class_instance.test();
</pre>

<p>All this wrapped together in a class looks like this :</p>

<pre class="prettyprint">
var Class_four = new Class({	
	Implements: Options,
	options: {
		option_one : "Default Value For First Option",
		option_two : "Default Value For Second Option",
	},
	initialize: function(options){
		this.setOptions(options);
	},   
	show_options : function(){
		alert(this.options.option_one + "\n" + this.options.option_two);
	},
});

var run_demo_4 = function ){
	var demo_4 = new Class_four({
		option_one : "New Value"
	});
	demo_4.show_options();
}

var run_demo_5 = function(){
	var demo_5 = new Class_four();
	demo_5.show_options();
	demo_5.setOptions({option_two : "New Value"});
	demo_5.show_options();
}

//Create a new class_four class with
//a new option called new_variable
var run_demo_6 = function(){
	var demo_6 = new Class_four({new_option : "This is a new option"});
	demo_6.show_options();
}
</pre>

<p>
	<button id="run_demo_4" class="btn btn-primary">demo_4()</button>
	<button id="run_demo_5" class="btn btn-primary">demo_5()</button>
	<button id="run_demo_6" class="btn btn-primary">demo_6()</button>
</p>

<h3>Example</h3>
<p>Those of you familiar with PHP may recognize the print_r() command used by the show_options method in the example below:</p>

<pre class="prettyprint">
show_options : function(){
	alert(print_r(this.options, true));
}
</pre>

<p>This isn&#8217;t a native javascript function, but is a piece of code from the <a href="http://kevin.vanzonneveld.net/techblog/category/php2js/">PHP2JS</a> project run by Kevin van Zonneveld. For those of you not versed in PHP, the print_r() function gives you a formatted string out the key/value pairs in an array. It&#8217;s an <a href="http://kevin.vanzonneveld.net/techblog/article/javascript_equivalent_for_phps_print_r/">incredibly useful tool for debugging</a> your scripts, a copy of the function is included in the downloadable zip and I highly recommend it&#8217;s use for testing and exploration.</p>

<pre class="prettyprint">
var Class_five = new Class({
	//We're using options
	Implements: Options,
	//Set our default options
	options : {
		option_one : "DEFAULT_1",
		option_two : "DEFAULT_2",	
	},
	//Have our initialization function 
	//set the options using setOptions
	initialize : function(options){
		this.setOptions(options);
	},
	//Method to send an alert with a
	//formatted printout of the options array
	show_options : function(){
		alert(print_r(this.options, true));
	},
	//Method to switch the values
	//of the two options using setOptions
	swap_options : function(){
		this.setOptions({
			option_one : this.options.option_two,
			option_two : this.options.option_one
		})
	}
});

function demo_7(){
	var demo_7 = new Class_five();
	demo_7.show_options();
	demo_7.setOptions({option_one : "New Value"});
	demo_7.swap_options();
	demo_7.show_options();
}
</pre>

<p><button id="run_demo_7" class="btn btn-primary">run_demo_7()</button></p>

<h3>To learn more</h3>
<p>
	<a href="http://docs.mootools.net/Class/Class">Mootools Class Documentation</a><br />
	<a href="http://docs.mootools.net/Class/Class.Extras">Mootools Class.extras Documentation</a><br />
	<a href="http://kevin.vanzonneveld.net/techblog/article/javascript_equivalent_for_phps_print_r/">print_r() reference</a>
</p>

<h4>Tomorrow&#8217;s Tutorial</h4>
<p><a href="index.php?day=19">Day 19 - Tooltips</a></p>					