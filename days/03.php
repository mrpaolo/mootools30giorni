<h2>Intro to Using Arrays in Mootools 1.2</h2>
<p>If you haven&#8217;t already, be sure and check out <a href="index.php?day=2">yesterday&#8217;s tutorial - Day 2 - Selectors</a></p>

<p>In the last tutorial, we looked at selectors, many of which created arrays (a special list that gives you a lot control over the contents).  Today, we are going to take a look at how to use arrays to manage DOM elements.</p>

<h3>The Basics</h3>
<h4>.each();</h4>
<p>.each(); is your best friend when dealing with arrays.  It provides an easy way to iterate through a list of elements, applying whatever script logic is necessary.  For example, lets say you wanted to call one alert box for every div within a page:</p>

<pre class="prettyprint">
$$('div').each(function() {
    alert('a div');
});
</pre>

<p>With this html, the code above would fire two alert boxes, one for each div.</p>

<pre class="prettyprint">
&lt;div&gt;One&lt;/div&gt;
&lt;div&gt;Two&lt;/div&gt;
</pre>

<p>.each(); doesn&#8217;t require you use $$.  Another way to create an array (liked we talked about yesterday), is to use .getElements();.</p>

<pre class="prettyprint">
$('body_wrap').getElements('div').each(function() {
    alert('a div');
});
</pre>

<pre class="prettyprint">
&lt;div id=&quot;body_wrap&quot;&gt;
    &lt;div&gt;One&lt;/div&gt;
    &lt;div&gt;Two&lt;/div&gt;
&lt;/div&gt;
</pre>

<p>Still another way to accomplish the same task is to send the array to a variable, then use .each(); on that variable:</p>

<pre class="prettyprint">
//first you declare your variable by saying "var VARIABLE_NAME"
//then you use the equal sign "=" to define what goes in that variable
//in this case, an array of divs

var myArray = $('body_wrap').getElements('div');
 
//now, you can use that array variable just like an array selector
myArray.each(function() {

    alert('a div');
});
</pre>

<p>Finally, you are going to want to separate out your function from the selector and .each();. We are going to talk more in depth about how to use functions in tomorrow&#8217;s tutorial, but for now, we can create a very simple one like this:</p>

<pre class="prettyprint">
var myArray = $('body_wrap').getElements('div');
 
//to create a new function, you declare a variable just like before, then name it
//after the equal sign you say "function()" to declare the variable as a function
//finally, you place your function code between { and };
var myFunction = function() {

    alert('a div');
};
 
//here you just call the function inside .each();.
myArray.each(myFunction);
</pre>

<p><strong>Note</strong>: When you call a function like we did here inside of .each();, you do not put any quotes around the function name.</p>

<h3>Making a Copy of an Array</h3>
<h4>$A</h4>
<p>Mootools provides a way to simply copy an array with the $A function.  Lets set up another array with a variable like we did above:</p>

<pre class="prettyprint">
//create your array variable
var myArray = $('body_wrap').getElements('div');
</pre>

<p>To create a copy of the array:</p>

<pre class="prettyprint">
//create a new variable, called "myCopy," then assign the copy of "myArray" to your new variable
var myCopy = $A(myArray );
</pre>

<p>Now myCopy contains the same elements as myArray.</p>

<h3>Grab a Specific Element within an Array</h3>
<h4>.getLast();</h4>
<p>.getLast(); will return the last element within an array.  First we set up our array:</p>

<pre class="prettyprint">
var myArray = $('body_wrap').getElements('div');
</pre>

<p>Now we can grab the last element within the array:</p>

<pre class="prettyprint">
var lastElement = myArray.getLast();
</pre>

<p>The variable lastElement now represents the last element within myArray.</p>
<h4>.getRandom();</h4>

<p>Works just like .getLast();, but will get a random element from the array.</p>

<pre class="prettyprint">
var randomElement = myArray.getRandom();
</pre>

<p>The variable randomElement is now represents a randomly chosen element within myArray.</p>

<h3>Add an Element to an Array</h3>
<h4>.include();</h4>
<p>With this method, you can add another item into an array.  Simply place the element selector within .include(); and attach it to your array.  With the following html setup:</p>

<pre class="prettyprint">
&lt;div id=&quot;body_wrap&quot;&gt;
    &lt;div&gt;one&lt;/div&gt;
    &lt;div&gt;two&lt;/div&gt;
    &lt;span id=&quot;add_to_array&quot;&gt;add to array&lt;/span&gt;
&lt;/div&gt;
</pre>

<p>We can create an array like we did before by calling all the divs that are children of &#8216;body_wrap.&#8217;</p>

<pre class="prettyprint">
var myArray = $('body_wrap').getElements('div');
</pre>

<p>To add another element to that array, first add the element you want to include to a var, then use the method .include();.</p>

<pre class="prettyprint">
//first add your element to a var
var newToArray = $('add_to_array');
 
//then include the var in the array
myArray.include(newToArray);
</pre>

<p>Now, the array contains both the divs and the span element.</p>

<h4>.combine();</h4>
<p>Works just like .include();, except it lets you add an new array to an existing existing array without having to worry about duplicate content.  Say we had two arrays from the following html:</p>

<pre class="prettyprint">
&lt;div id=&quot;body_wrap&quot;&gt;
    &lt;div&gt;one&lt;/div&gt;
    &lt;div&gt;two&lt;/div&gt;
    &lt;span class=&quot;class_name&quot;&gt;add to array&lt;/span&gt;
    &lt;span class=&quot;class_name&quot;&gt;add to array, also&lt;/span&gt;
    &lt;span class=&quot;class_name&quot;&gt;add to array, too&lt;/span&gt;
&lt;/div&gt;
</pre>

<p>We could then build the following two arrays:</p>

<pre class="prettyprint">
//create your array just like we did before
var myArray= $('body_wrap').getElements('div');
 
//then create an array from all elements with .class_name
var newArrayToArray = $$('.class_name');
</pre>

<p>Now, we can use .combine(); to combine the two arrays, and the method will deal with any duplicate content so we don&#8217;t have to.</p>

<pre class="prettyprint">
//then combine newArrayToArray with myArray
myArray.combine(newArrayToArray );
</pre>

<p>Now myArray contains all the elements from newArraytoArray.</p>

<h3>Examples</h3>
<p>Arrays let you do iterate through a list of items, applying the same chunk of code to each one.  In this example, notice the use of &#8220;item&#8221; as a placeholder for the current element.</p>

<pre class="prettyprint">
//creates an array of all elements within #body_wrap with the class .class_name
var myArray = $('body_wrap').getElements('.class_name');
 
//first lets create a new element to add to our array
var addSpan = $('addtoarray');
//now lets create an array to combine with our array
var addMany = $$('.addMany');

//now we can include the new span
myArray.include(addSpan);
//and combine our addMany array with myArray
myArray.combine(addMany);
 
//create a function to go through each ITEM in the array
var myArrayFunction = function(item) {
	//item now refers to the current element within the array
	item.setStyle('background-color', '#eee');
}
 
//now you call the myArrayFunction for EACH item within the array
myArray.each(myArrayFunction);
</pre>

<pre class="prettyprint">
&lt;div id=&quot;body_wrap&quot;&gt;
    &lt;div class=&quot;class_name&quot;&gt;one&lt;/div&gt;&lt;!-- this has gray background --&gt;
    &lt;div&gt;two&lt;/div&gt;
    &lt;div class=&quot;class_name&quot;&gt;three&lt;/div&gt;&lt;!-- this has gray background --&gt;
    &lt;span id=&quot;addtoarray&quot;&gt;add to array&lt;/span&gt;  &lt;!-- this has gray background --&gt;
    &lt;br /&gt;&lt;span class=&quot;addMany&quot;&gt;one of many&lt;/span&gt;  &lt;!-- this has gray background --&gt;
    &lt;br /&gt;&lt;span class=&quot;addMany&quot;&gt;two of many&lt;/span&gt;  &lt;!-- this has gray background --&gt;
&lt;/div&gt;
</pre>

<h3>To Learn More&#8230;</h3>
<p>This tutorial does not begin to cover the wonderful things you can do with arrays, but hopefully it has given you an idea of what Mootools has to offer.  To find out more about arrays, take a closer look at:</p>

<ul>
	<li>the <a href="http://docs.mootools.net/Native/Array">array section within the docs</a></li>
	<li>this page has a lot of <a href="http://www.hunlock.com/blogs/Mastering_Javascript_Arrays">information about JavaScript arrays</a></li>
</ul>

<h4>Tomorrow</h4>
<p>Tomorrow we will look closer at <a href="index.php?day=04">functions and how to use them in Mootools</a>.</p>