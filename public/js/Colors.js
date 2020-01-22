/**
 *   Link to colors.css file at your html document's header.
 *   This Colors.js file should be used through the <script> tag through the "src" attribute. Add to each tag that is going to be colored
 * data-colored="yes" attribute.
 * - in the window.onload function or in the $(document).ready(function() {}) call the random
 */

function randomClass() {

 var classes = [
  'hothead-red', 'hothead-yellow',
  'monkeybar-yellow', 'monkeybar-black',
  'glo-pink', 'glo-purple',
  'crowdshoes-green', 'crowdshoes-blue',
  'strabell-purple', 'strabell-orange',
  'spacebox-navy', 'spacebox-red', 'spacebox-yellow', 
  'crowdshoes-green', 'crowdshoes-blue',
  'aviance-purple', 'aviance-yellow',
  'hiveworks-blue', 'hiveworks-pink',
  'sonata-red', 'sonata-black',
  'eagleeye-turquoise', 'eagleeye-blue',
  'jive-blue', 'jive-orange',
  'stylus-white', 'stylus-orange',
  'greenfair-green', 'greenfair-yellow',
  'empire-orange', 'empire-black',
  'klutz-pink', 'klutz-blue',
  'blackandwhite', 'blackandwhite-inv'
 ];

 return classes[Math.round((classes.length-1) * Math.random())];
}