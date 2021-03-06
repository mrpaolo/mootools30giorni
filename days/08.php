<!-- Working Examples for Day 08 -->
<script type="text/javascript" src="days/js/08.js" ></script>

<h2>Numbers</h2>
<p>Hey folks, today we&#8217;re going to starting looking at how Mootools can make filtering user input a breeze. We&#8217;re going to be starting off with some basic number filtering today, and digging into the world of string filtering tommorrow.</p>

<p>If you haven&#8217;t already checked out the rest of the <a href="index.php">30 Days of Mootools tutorials</a>, I&#8217;d highly recommend doing so before continuing on. </p>

<p><strong>NOTE:</strong> Input filtering in Javascript is to ensure that your code runs smoothly, it should <strong>NOT</strong> be used as a substitute for the server side input filtering required to protect your applications against injection attacks.  </p>

<p>On Day 4 we ended with an example that took RGB values from textboxes and used them to change the background of the page, today we&#8217;re going to start by going over some of the code from that example and expanding upon it.</p>

<h3>rgbToHex()</h3>
<p>Technically speaking, the rgbToHex() function actually belongs to the <a href="http://docs.mootools.net/Native/Array">Array</a> collection. Since it&#8217;s an array function built to deal with numbers, we&#8217;re going to tackle it today. Functionally, rgbToHex() is pretty straightforward to use:

</p>

<pre class="prettyprint">
var changeColor = function(red_value, green_value, blue_value){
	var color = [red_value, green_value, blue_value].rgbToHex(); 
	alert('Converts to : ' + color); 
}
changeColor('28', '17', '47');
</pre>

<p><button class="btn btn-primary" id="change_color_1_good">changeColor(&#8217;28&#8242;, &#8216;17&#8242;, &#8216;47&#8242;);</button></p>

<p>This works perfectly, as long as the values for red, green, and blue are numbers. Check out the behavior when you pass it something unexpected:</p>

<p><button id="change_color_1_bad" class="btn btn-primary">changeColor(&#8217;28&#8242;, &#8216;17&#8242;, &#8216;oops&#8217;);</button></p>

<p>The NaN you see at the end there stands for <strong>N</strong>ot <strong>a</strong> <strong>N</strong>umber. If you&#8217;re hard coding color values into the array, this situation probably isn&#8217;t going to come up. If you&#8217;re getting input from any other source though, you&#8217;re most likely going to run into situations where you have to deal with invalid input.</p>

<h3>toInt()</h3>
<p>
So now, we need a way to make sure that the rgbToHex() function is only getting numbers passed to it - that is where the <a href="http://docs.mootools.net/Native/Number#Number:toInt">toInt()</a> function comes in. toInt() is another relatively straightforward function. You call it on a variable and it does its best to get a regular integer from whatever the variable contains.</p>

<pre class="prettyprint">
var toIntDemo = function(make_me_a_number){
	var number = make_me_a_number.toInt();
	alert ('Best Attempt : ' + number);
}
</pre>

<p>
	<button id="to_int_1" class="btn btn-primary">toIntDemo(&#8217;613.234&#8242;)</button>
	<button id="to_int_2" class="btn btn-primary">toIntDemo(&#8217;83_hooray!&#8217;)</button>
	<button id="to_int_3" class="btn btn-primary">toIntDemo(&#8217;cant_get_83&#8242;)</button>
</p>

<p>As you can see, toInt() can&#8217;t handle every conceivable situation, but thanks to another piece of Mootools coolness called $type(), we can deal with that problem as well.</p>

<h3>$type()</h3>
<p>$type() is another one of the incredibly straightforward and useful goodies from the Mootools crew. It examines whatever variable you pass it, and returns a string telling you what type of variable it is:</p>

<pre class="prettyprint">
var checkType = function(variable_to_check){
	var variable_type = $type(variable_to_check);
	alert("Variable is a : " + variable_type);
}
</pre>

<p>
	<button id="type_number" class="btn btn-primary">checkType(43)</button>
	<button id="type_string" class="btn btn-primary">checkType(&#8217;a string&#8217;)</button>
	<button id="type_boolean" class="btn btn-primary">checkType(false)</button>
</p>

<p>There&#8217;s a buttload of other types that $type() detects - you can get a full list of them in the <a href="/http://docs.mootools.net/Core/Core#type">Core.$type() documentation</a>.</p>

<p>For now though, all we&#8217;re really worried about is detecting integers. If we take $type() and throw into the toIntDemo() function we can very easily deal with input that toInt() can&#8217;t handle:</p>

<pre class="prettyprint">
var toIntDemo = function(make_me_a_number){
	//Try to make the input number
	var number = make_me_a_number.toInt();
	//If That didn't work, set number to 0
	if ($type(number) != 'number'){
		number = 0;
	}
	alert('Best Attempt : ' + number);
}
</pre>

<p>
	<button id="to_int_4" class="btn btn-primary">toIntDemo_2(&#8217;613.234&#8242;)</button>
	<button id="to_int_5" class="btn btn-primary">toIntDemo_2(&#8217;83_hooray!&#8217;)</button>
	<button id="to_int_6" class="btn btn-primary">toIntDemo_2(&#8217;cant_get_83&#8242;)</button>
</p>

<p>When we pull it all together into changeColor(), we get a solution that works <strong>almost</strong> perfectly :</p>

<pre class="prettyprint">
var changeColor_2 = function(red_value, green_value, blue_value){
	//Try to make sure everything is an integer
	red_value = red_value.toInt();
	green_value = green_value.toInt();
	blue_value = blue_value.toInt();

	//Set default values on anything thats Not a Number
	if ($type(red_value)   != 'number'){ red_value = 0; }
	if ($type(green_value) != 'number'){ green_value = 0; }
	if ($type(blue_value)  != 'number'){ blue_value = 0; }

	//Calculate hex value
	var color = [red_value, green_value, blue_value].rgbToHex(); 
	alert('Converts to : ' + color); 
}
</pre>

<p>
	<button id ="change_color_2_clean" class="btn btn-primary">changeColor(&#8217;28&#8242;, &#8216;17&#8242;, &#8216;47&#8242;);</button>
	<button id ="change_color_2_default" class="btn btn-primary">changeColor(&#8217;28&#8242;, &#8216;17&#8242;, &#8216;oops&#8217;);</button>
	<button id ="change_color_2_breaks" class="btn btn-primary">changeColor(&#8217;428&#8242;, &#8216;317&#8242;, &#8216;265000&#8242;);</button>
</p>

<p>The last function is passing rgbToHex() numbers outside of the RGB range of 0 - 255, which quite dutifully converts the value into it&#8217;s hex equivalent. Unfortunately this means that if we receive a number outside of that range as input, we aren&#8217;t going to be able to get a valid hex color value. Fortunately, there&#8217;s of one more piece from the Mootools kit, we can throw in to take care of this problem too.</p>

<h3>limit()</h3>
<p>The Mootools <a href="http://docs.mootools.net/Native/Number#Number:limit">limit()</a> function is pretty no frills. You call it on a number with the lower and upper bounds you want to limit the number to as arguments, and if that number is outside of the range you define, it rounds appropriately.</p>

<p>It&#8217;s important to keep in mind that limit REQUIRES an integer to function, so it&#8217;s a generally a good idea to use toInt() on something you&#8217;re assuming to be a number before using limit (or anything else in the <a href="http://docs.mootools.net/Native/Number">Number Collection</a>).</p>

<pre class="prettyprint">
var limitDemo = function(number_to_limit){
	//Do our best to get an integer
	number_to_limit = number_to_limit.toInt();
	//Get the limited value
	var limited_number = number_to_limit.limit(0, 255);
	alert("Number Limited To : " + limited_number);
}
</pre>

<p><button id ="limit_demo" class="btn btn-primary">limitDemo(6535634);</button></p>

<h3>Stick a Fork in it</h3>

<pre class="prettyprint">
var changeColor = function(red_value, green_value, blue_value){
	//Try to make sure everything is an integer
	red_value   = red_value.toInt();
	green_value = green_value.toInt();
	blue_value  = blue_value.toInt();

	//Set default values on anything thats Not a Number
	if ($type(red_value)   != 'number'){red_value = 0;}
	if ($type(green_value) != 'number'){green_value = 0;}
	if ($type(blue_value)  != 'number'){blue_value = 0;}
 
	//Limit Everything to the RGB Scale (0 - 255)
	red_value   = red_value.limit(0, 255);
	green_value = green_value.limit(0, 255);
	blue_value  = blue_value.limit(0, 255);
 
	//Calculate hex value
	var color = [red_value, green_value, blue_value].rgbToHex(); 
	alert('Converts to : ' + color); 
}
</pre>

<p>
	<button id ="change_color_3_clean" class="btn btn-primary">changeColor(&#8217;28&#8242;, &#8216;17&#8242;, &#8216;47&#8242;);</button>
	<button id ="change_color_3_default" class="btn btn-primary">changeColor(&#8217;28&#8242;, &#8216;17&#8242;, &#8216;oops&#8217;);</button>
	<button id ="change_color_3_limit" class="btn btn-primary">changeColor(&#8217;428&#8242;, &#8216;317&#8242;, &#8216;265000&#8242;);</button>
</p>

<h3>To Learn More</h3>

<ul>
	<li><a href="http://www.w3schools.com/jsref/jsref_obj_number.asp">Standard Number Functionality</a></li>
	<li><a href="http://docs.mootools.net/Native/Number">Mootools Number Functionality</a></li>
	<li><a href="http://docs.mootools.net/Native/Array">Mootools Array Functionality</a></li>
</ul>

<h4>Tomorrow&#8217;s Tutorial</h4>
<p><a href="index.php?day=09">Input Filtering Part 2 -Strings</a></p>
