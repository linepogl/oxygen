<?php

class KeywordsBox extends Box {

	private $width = '200px';
	public function WithWidth($value){ $this->width = $value; return $this; }

	private $height = '60px';
	public function WithHeight($value){ $this->width = $value; return $this; }

	private $css_style = '';
	public function WithCssStyle($value){ $this->css_style = $value; return $this; }

	private $css_class = '';
	public function WithCssClass($value){ $this->css_class = $value; return $this; }

	public function Render(){

		TextBox::Make($this->name,$this->value)->WithWidth($this->width)->WithReadOnly($this->readonly)->WithMode($this->mode)->Render();

		echo '<script type="text/javascript" src="oxy/jsc/jquery-tagsinput.js"></script>';
		echo Js::BEGIN;
		echo "jQuery('#$this->name').tagsInput({defaultText:'+',width:".new Js($this->width).",height:".new Js($this->height).",interactive:".new Js(!$this->readonly)."});";
		echo Js::END;

/*
		<link rel="stylesheet" type="text/css" href="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.css" />
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
			<script type="text/javascript" src="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.js"></script>
			<!-- To test using the original jQuery.autocomplete, uncomment the following -->
			<!--
			<script type='text/javascript' src='http://xoxco.com/x/tagsinput/jquery-autocomplete/jquery.autocomplete.min.js'></script>
			<link rel="stylesheet" type="text/css" href="http://xoxco.com/x/tagsinput/jquery-autocomplete/jquery.autocomplete.css" />
			-->
			<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js'></script>
			<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />


			<script type="text/javascript">

				function onAddTag(tag) {
					alert("Added a tag: " + tag);
				}
				function onRemoveTag(tag) {
					alert("Removed a tag: " + tag);
				}

				function onChangeTag(input,tag) {
					alert("Changed a tag: " + tag);
				}

				$(function() {

					$('#tags_1').tagsInput({width:'auto'});
					$('#tags_2').tagsInput({
						width: 'auto',
						onChange: function(elem, elem_tags)
						{
							var languages = ['php','ruby','javascript'];
							$('.tag', elem_tags).each(function()
							{
								if($(this).text().search(new RegExp('\\b(' + languages.join('|') + ')\\b')) >= 0)
									$(this).css('background-color', 'yellow');
							});
						}
					});
					$('#tags_3').tagsInput({
						width: 'auto',

						//autocomplete_url:'test/fake_plaintext_endpoint.html' //jquery.autocomplete (not jquery ui)
						autocomplete_url:'test/fake_json_endpoint.html' // jquery ui autocomplete requires a json endpoint
					});


		// Uncomment this line to see the callback functions in action
		//			$('input.tags').tagsInput({onAddTag:onAddTag,onRemoveTag:onRemoveTag,onChange: onChangeTag});

		// Uncomment this line to see an input with no interface for adding new tags.
		//			$('input.tags').tagsInput({interactive:false});
				});

			</script>
				<form>
					<p><label>Defaults:</label>
					<input id="tags_1" type="text" class="tags" value="foo,bar,baz,roffle" /></p>

					<p><label>Technologies: (Programming languages in yellow)</label>
					<input id="tags_2" type="text" class="tags" value="php,ios,javascript,ruby,android,kindle" /></p>

					<p><label>Autocomplete:</label>
					<input id='tags_3' type='text' class='tags'></p>

				</form>

		*/


	}
}



