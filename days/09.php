<!-- Working Examples for Day 09 -->
<script type="text/javascript" src="days/js/09.js" ></script>

<h2>String Functions</h2>
<p>Hey Folks, today we&#8217;re going to be taking a look at some of the additional functionality Mootools gives us to deal with strings. This is a partial view of the mootools string capabilities, and doesn&#8217;t include a few more estoteric functions (e.g. toCamelCase()) or any of the string functionality dealing with regular expressions.</p>

<p>We&#8217;re going to take a day to go over the basics of regular expressions and their use within mootools a bit later. If you haven&#8217;t already, I&#8217;d recommend checking out the rest of the <a href="index.php">30 Days of Mootools Tutorials</a> before continuing.</p>

<p>Before going into it, I want to take a moment too look at how these string functions are being called. For my examples I&#8217;ll be calling these functions on variables with strings in them like so :</p>

<pre class="prettyprint">
var my_text_variable = "Heres some text";
//  result               text variable    name of the function
var result_of_function = my_text_variable.someStringFunction();
</pre>

<p>While this makes it clearer for the sake of explanation, you should be aware that these string functions can also e called on strings without declaring a variable like so :</p>

<pre class="prettyprint">
var result_of_function = "Heres some text".someStringFunction();
</pre>

<p>Note that this also holds true for all of mootools number functions as well :</p>

<pre class="prettyprint">
//Note the use of parentheses for numbers as
//opposed to single quotes for strings
var limited_number = (256).limit(1, 100);
</pre>

<p>Also, I want to stress again that input filtering done with javascript <b>IS NOT</b> for sanitizing user input before sending it server-side. Anything you write in javascript can be seen, manipulated, and disabled by the person viewing your web page. We&#8217;ll be having some light discussion of PHP filtering techniques when we get to the Mootools Request class. In the meantime, just keep to the rule that anything security related should be done server-side, not with the javascript.
</p>

<h3>trim()</h3>
<p>The trim function provides a straightforward way to strip whitespace off the front and end of any strings you care to hand it.</p>

<pre class="prettyprint">
//This is the String we're trimming
var text_to_trim =  "    \nString With Whitespace     ";

//  trimmed_text is "String With Whitespace"
var trimmed_text = text_to_trim.trim();
</pre>

<p>If you haven&#8217;t seen that \n yet, it&#8217;s basically shorthand for Newline. Throw it in a string when you want to seperate it out into multiple lines. New lines are counted as whitespace by trim, so it gets rid of them as well.</p>
<p>One thing Trim very specifically does not do is get rid of any extra whitespace <i>inside</i> of the string The example below shows you what happens to a string with newlines that gets trimmed:</p>

<pre class="prettyprint">
var trimDemo = function(){
	//Load up the text we're going to trim
	var text_to_trim =  '            \ntoo       much       whitespace\n              ';
 
	//Trim it
	var trimmed_text = text_to_trim.trim();
 
	//Report the results
	alert('Before Trimming : \n' + 
		'|-' + text_to_trim + '-|\n\n' +
		'After Trimming : \n' +  
		'|-' + trimmed_text + '-|'
	);
}
</pre>

<p><button id="trim_text" class="btn btn-primary">Trim</button></p>

<h3>clean()</h3>
<p>Makes sense, you wouldn&#8217;t necessarily want to remove all of the whitespace in a string. Fortunately for those of you feeling wreckless, Mootools generously provides you with clean(). </p>

<pre class="prettyprint">
//This is the String we're trimming
var text_to_clean =  "    \nString     \nWith    Lots \n \n    More     \nWhitespace  \n   ";

// cleaned_text  is "String With Lots More Whitespace"
var cleaned_text  = text_to_trim.clean();
</pre>

<p>clean() is trim with one important difference. Instead of restricting itself to the whitespace at the beginning and end of the string it just goes ahead and takes out <b>ALL</b> of the whitespace from the string you pass it. This means any amount of spaces more than one, and all linebreaks and tabs in the string. Compare the result to trim to see what I mean.

</p>

<pre class="prettyprint">
var cleanDemo = function(){
	//Load up the text we're going to clean
	var text_to_clean =  '            too\n       much\n       whitespace              ';

	//Clean it
	var cleaned_text = text_to_clean.clean();
 
	//Report the results
	alert('Before Cleaning : \n' + 
		'|-' + text_to_clean + '-|\n\n' +
		'After Cleaning : \n' +  
		'|-' + cleaned_text + '-|'
	);
}
</pre>

<p><button id="clean_text" class="btn btn-primary">Clean</button></p>

<h3>contains()</h3>
<p>Like trim() and clean(), contains() does one thing in a very straightforward, no frills manner. It checks a string to see if it contains a search string you define, returns true if it finds the search string and false if it can&#8217;t.</p>

<pre class="prettyprint">
//Our string to search
var string_to_match = "Does this contain thing work?";
 
//Looks for 'contain', did_string match is true
var did_string_match = string_to_match.contains('contain');
 
//Looks for propane, did_string_match is false
did_string_match = string_to_match.contains('propane');
</pre>

<p>
This thing can come in handy in all sorts of situations, and when you use it in combination with other tools like the Array.each() function we went over on <a href="index.php?day=03">day 3</a> you can accomplish some decently complex tasks with relatively little code.</p>
<p>For example, if we take a list of words in an array and run it through each, we can look for multiple phrases in the same block of text with relatively little code :</p>

<pre class="prettyprint">
string_to_match = "string containing whatever words you want to try to match";
word_array = ['words', 'to', 'match'];

//Pass each word in the array as the variable word
word_array.each(function(word_to_match){
	//Look for current word
	if (string_to_match.contains(word_to_match)){
		alert('found ' + word_to_match);
	};
});
</pre>

<p>Throw in a textbox and a little imagination and you&#8217;ve got you&#8217;re very own swear (or whatever) word detector</p>

<pre class="prettyprint">
var containsDemo = function(){
	//Put our list of banned words into an array
	var banned_words = ['drat', 'goshdarn', 'fiddlesticks', 'kumquat'];	

	//Get the contents of the text area
	var textarea_input = $('textarea_1').get('value');
 
	//Iterate over each of the banned words
	banned_words.each(function(banned_word){
		//Look for the current banned 
		//word in the textarea contents
		if (textarea_input.contains(banned_word)){
			//Tell the user not to use that word
			alert(banned_word + ' is not allowed');
		};
	});
}
</pre>

<p>
	<textarea id="textarea_1" rows="2" cols="75">Banned Words : drat goshdarn fiddlesticks kumquat</textarea><br />
	<button id="check_textarea_1" class="btn btn-primary">Check for Banned Words</button><br />
</p>

<h3>substitute()</h3>
<p>substitute is a deceptively powerful tool. We&#8217;re just going to be touching the basics of it today, a lot of the power in substitute comes through it&#8217;s use of regular expressions, which we&#8217;re going to be looking at a little further on down the line. Still, the basic usage alone lets you do quite a bit.</p>

<pre class="prettyprint">
//This is the text that substitute will be 
//using for a template. Note that everything
//to be replaced is surrounded by {curly brackets}
var text_for_substitute = "One is {one},  Two {two}, Three is {three}.";
 
//This is the object that holds the substitution
//rules. The unquoted words on the right are
//the search terms, and the quoted sentences on
//the left are the sentences to be substituted
//for the search term
var substitution_object = {
	one   : 'the first variable', 
	two   : 'always comes second', 
	three : 'getting sick of bronze..'
};
 
//call substitute with the substitution
//object as the argument on text_for_substitute,
//place the result in the new_string variable.    
var new_string = text_for_substitute.substitute(substitution_object); 
 
//new_string is now "One is the first variable, Two always comes second, Three is getting sick of bronze..."
</pre>

<p>You don&#8217;t actually have to create the substitution_object to use substitute if it&#8217;s not appropriate, the following will work just as well:</p>

<pre class="prettyprint">
//Build the substitution string
var text_for_substitute = "{substitute_key} and the original text";

//Just include the substitution object as a paramater to substitute
var result_text = text_for_substitute.substitute({substitute_key : 'substitute_value'});
//result_text is "substitute_value and the original text"
</pre>

<p>You can go even farther with that one, and place calls to retrieve values from the DOM in as substitute values and it&#8217;ll work just fine.</p>

<pre class="prettyprint">
var substituteDemo = function(){
	//Get the original text from the textfield
	var original_text = $('substitute_span').get('html');
 
	//Substitute the values in the textfields for the
	//values in the text field
	var new_text = original_text.substitute({
		first  : $('first_value').get('value'),
		second : $('second_value').get('value'),
		third  : $('third_value').get('value'),
	});
 
	//Replace the contents of the span with the new text
	$('substitute_span').set('html', new_text);
 
	//Disable the substitute button and
	//enable the reset button 
	$('simple_substitute').set('disabled', true);
	$('simple_sub_reset').set('disabled', false);
}
 
var substituteReset = function(){
	//Create a variable to hold the original text
	var original_text = "|- {first} -- {second} -- {third} -|";
 
	//Replace the contents of the span with the original text
	$('substitute_span').set('html', original_text);
 
	//Disable the reset button and enable
	//the substitute button
	$('simple_sub_reset').set('disabled', true);
	$('simple_substitute').set('disabled', false);
}
</pre>

<p><span id="substitute_span">|- {first} &#8212; {second} &#8212; {third} -|</span></p>

<p>first_value<br /><input type="text" id="first_value"></p>
<p>second_value<br /><input type="text" id="second_value"></p>
<p>third_value<br /><input type="text" id="third_value"></p>

<p>
	<button id="simple_substitute" class="btn btn-primary">substituteDemo()</button>
	<button id="simple_sub_reset" class="btn btn-primary">substituteReset()</button>
</p>


<p>A quick note before  wrap up for today, if you call substitute on a string and don&#8217;t provide a key : value pair for each of the {replacement keys} in the text it will simply remove whats between the curly brackets. So be careful not to use this on any string with curly brackets that you wanna keep. For example, this :</p>

<pre class="prettyprint">
("{one} some stuff {two} some more stuff").substitute({one : 'substitution text'});
</pre>

<p>Will return &#8217;substitution text some stuff some more stuff&#8217;.</p>

<h3>To Learn More</h3>
<ul>
	<li><a href="http://www.quirksmode.org/js/strings.html">Quirksmode on Strings</a> (this guy is amazing)</li>
	<li><a href="http://www.w3schools.com/jsref/jsref_obj_global.asp">Javascript String function reference</a></li>
	<li><a href="http://docs.mootools.net/Native/String">Mootools String documentation</a></li>
</ul>

<h4>Tomorrow&#8217;s tutorial</h4>
<p>Be sure to check out Day 10, <a href="index.php?day=10">Mootools 1.2 Tween Effects</a>.</p>