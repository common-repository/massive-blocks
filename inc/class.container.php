<?php
/**
* PHP rendering for the alert block
*/
class Massive_Blocks_Container
{
	var $fields = array(
		'className'   => array( 'type' => 'string', 'default' => '' ),
		'alignment'   => array( 'type' => 'string', 'default' => 'left' ),
		'fontFamily'  => array( 'type' => 'string', 'default' => 'Open Sans' ),
		'text_color'  => array( 'type' => 'string', 'default' => '#0693E3' ),
		'borde_color' => array( 'type' => 'string', 'default' => '#0693E3' ),
		'bg_color'    => array( 'type' => 'string', 'default' => '#EEEEEE' ),
		'box_styles'  => array( 'type' => 'string', 'default' => '{
								"paddingTop": "10px",
								"paddingBottom": "10px",
								"paddingLeft": "10px",
								"paddingRight": "10px",
								"borderStyle": "solid",
								"borderTopWidth": "0px",
								"borderRightWidth": "0px",
								"borderBottomWidth": "0px",
								"borderLeftWidth": "0px"
							}' 
						),
	);
	
	function __construct(){
		add_action( 'init', array($this, 'register_block') );
	}

	function get_sc_attrs(){
		$attrs = array();
		foreach ($this->fields as $name => $field) {
			$attrs[$name] = (isset($field['default'])) ? $field['default'] : '' ;
		}
		return $attrs;
	}

	function register_block(){
		register_block_type( 'massive-blocks/container', array(
			'attributes' => $this->fields,
			'render_callback' => array( $this, 'render_block' ),
		));
	}

	function get_inline_styles($string){
		$inline_css = '';
		$styles_array = json_decode($string, true);
		foreach ($styles_array as $prop => $value) {
			$inline_css .= strtolower(preg_replace('%([a-z])([A-Z])%', '\1-\2', $prop)) .':'.$value.';';
		}
		return $inline_css;
	}

	function render_block($attributes, $content){
		$attrs = $this->get_sc_attrs();
		extract( shortcode_atts( $attrs, $attributes ) );
		$inline_css = $this->get_inline_styles($box_styles);
		ob_start();	 ?>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php echo urlencode($fontFamily); ?>:regular&subset=latin">
		<div class="massive-wrapper <?php echo $className; ?>">
			<div class="massive-container" style="<?php echo $inline_css; ?>
			color:<?php echo $text_color;  ?>;
			background-color:<?php echo $bg_color;  ?>;
			border-color:<?php echo $borde_color;  ?>;
			text-align:<?php echo $alignment;  ?>;
			">
				<span style="font-family:<?php echo $fontFamily; ?>;"><?php echo $content; ?></span>
			</div>
		</div>

		<?php return ob_get_clean();
	}
}
new Massive_Blocks_Container;
?>