<?php
/**
* PHP rendering for the blockquote block
*/
class Massive_Blocks_AdvancedHeading
{
	var $fields = array(

		'headingText'     => array( 'type' => 'string', 'default' => 'Your Awesome Heading' ),
		'separatorColor'     => array( 'type' => 'string', 'default' => '#0693E3' ),
		'borderStyle'     => array( 'type' => 'string', 'default' => 'solid' ),
		'fontFamily'  => array( 'type' => 'string', 'default' => 'Open Sans' ),
		'boxBorderColor'  => array( 'type' => 'string', 'default' => '#0bea3b' ),
		'boxBGColor'      => array( 'type' => 'string', 'default' => '' ),
		'borderWidth'     => array( 'type' => 'string', 'default' => '5px' ),
		'separatorWidth'  => array( 'type' => 'string', 'default' => '100%' ),
		'fontSize'        => array( 'type' => 'number', 'default' => '28' ),
		'headingColor'    => array( 'type' => 'string', 'default' => '#8a0672' ),
		'sepMarginTop'    => array( 'type' => 'string', 'default' => '5px' ),
		'sepMarginBottom' => array( 'type' => 'string', 'default' => '5px' ),
		'letterSpacing'   => array( 'type' => 'string', 'default' => '' ),
		'box_styles'      => array( 'type'     => 'string', 
							'default' => '{
								"paddingTop": "0",
								"marginTop": "0",
								"paddingBottom": "0",
								"paddingLeft": "0",
								"borderStyle": "solid",
								"borderTopWidth": "0",
								"borderRightWidth": "0",
								"borderBottomWidth": "0",
								"borderLeftWidth": "0"
							}' 
		),
		'alignment'  	 => array( 'type' => 'string', 'default' => 'center' ),
		'className'      => array( 'type' => 'string', 'default' => '' ),
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
		register_block_type( 'massive-blocks/advanced-heading', array(
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
			
		<div class="massive-wrapper <?php echo $className; ?>">
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php echo urlencode($fontFamily); ?>:regular&subset=latin">

			<div class="massive-advanced-heading-box" style="<?php echo $inline_css; ?>
				border-color:<?php echo $boxBorderColor;  ?>;
				background-color:<?php echo $boxBGColor;  ?>;
				">
				<h3 style="
				color:<?php echo $headingColor;  ?>;
				font-family:<?php echo $fontFamily; ?>;
				text-align:<?php echo $alignment;  ?>;
				letter-spacing:<?php echo $letterSpacing;  ?>;
				font-size:<?php echo $fontSize.'px';  ?>;
				">
					<?php echo $headingText;  ?>
				</h3>

				<div style="
				text-align:<?php echo $alignment;  ?>;
				margin-top:<?php echo $sepMarginTop;  ?>;
				margin-bottom:<?php echo $sepMarginBottom;  ?>;
				">
					<span style="
					display: inline-block;
					width :<?php echo $separatorWidth;  ?>;
					border-bottom:<?php echo $borderWidth;  ?> <?php echo $borderStyle;  ?> <?php echo $separatorColor;  ?>;
					"></span>
				</div>
				<div class="massive-card-body">
					<?php echo $content; ?>
				</div>
			</div>
		</div>

		<?php return ob_get_clean();
	}
}
new Massive_Blocks_AdvancedHeading;
?>