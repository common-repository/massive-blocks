<?php
/**
* PHP rendering for the alert block
*/
class Massive_Blocks_RowSeparator
{
	var $fields = array(
		'className'     => 	array( 'type' => 'string', 'default' => '' ),
		'fontFamily'  => array( 'type' => 'string', 'default' => 'Open Sans' ),
		'alignment'     => 	array( 'type' => 'string', 'default' => 'center' ),
		'customHeading' => 	array( 'type' => 'string', 'default' => 'Heading Section' ),
		'rowType'       => 	array( 'type' => 'string', 'default' => 'simple' ),
		'borderStyle'   => 	array( 'type' => 'string', 'default' => 'solid' ),
		'borderColor'   => 	array( 'type' => 'string', 'default' => '#0693E3' ),
		'borderWidth'   => 	array( 'type' => 'string', 'default' => '5px' ),
		'maxWidth'      => 	array( 'type' => 'string', 'default' => '100%' ),
		'textColor'     => 	array( 'type' => 'string', 'default' => '#0693E3' ),
		'rowBoxBGColor' => 	array( 'type' => 'string', 'default' => '' ),
		'rowBoxBorderColor' => 	array( 'type' => 'string', 'default' => '' ),
		'fontSize'      => 	array( 'type' => 'number', 'default' => '20' ),
		'letterSpacing' => 	array( 'type' => 'string', 'default' => '1px' ),
		'uniqueId'      => 	array( 'type' => 'string', 'default' => 'rowsep-1' ),
		'box_styles'    => 	array( 'type' => 'string', 'default' => '{
				"paddingTop": "12px",
				"marginTop": "0",
				"paddingBottom": "12px",
				"paddingLeft": "0",
				"borderStyle": "solid",
				"borderTopWidth": "0",
				"borderRightWidth": "0",
				"borderBottomWidth": "0",
				"borderLeftWidth": "0"
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
		register_block_type( 'massive-blocks/row-separator', array(
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

	function render_block($attributes){
		$attrs = $this->get_sc_attrs();
		extract( shortcode_atts( $attrs, $attributes ) );
		$inline_css = $this->get_inline_styles($box_styles);
		ob_start();	 ?>
			
		<div class="massive-wrapper <?php echo $className; ?>">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php echo urlencode($fontFamily); ?>:regular&subset=latin">
			<div class="massive-row-separator-box" id="<?php echo $uniqueId; ?>" style="<?php echo $inline_css; ?>
			text-align: <?php echo $alignment;  ?>;
			background-color: <?php echo $rowBoxBGColor;  ?>;
			border-color: <?php echo $rowBoxBorderColor;  ?>;
			">

				<?php if ($rowType == 'simple'){ ?>
					<div class="massive-sep-simple" style="
						border-bottom: <?php echo $borderWidth; ?> <?php echo $borderStyle; ?> <?php echo $borderColor; ?>;
						width: <?php echo $maxWidth; ?>;" 
					></div>
				<?php }elseif ($rowType == 'heading') { ?>
					<h2 class="massive-sep-heading" style="
						color: <?php echo $textColor; ?>;
						letter-spacing: <?php echo $letterSpacing; ?>;
						font-size: <?php echo $fontSize; ?>px;
						font-family:<?php echo $fontFamily; ?>;
						max-width: <?php echo $maxWidth; ?>;"
					>
					<?php echo $customHeading; ?>		
					</h2>
				<?php } ?>
			</div>
			<style>
        		#<?php echo $uniqueId; ?> .massive-sep-heading:before, 
        		#<?php echo $uniqueId; ?> .massive-sep-heading:after { 
        			border-bottom: <?php echo $borderWidth; ?> <?php echo $borderStyle; ?> <?php echo $borderColor; ?>; 
        		}
	        </style>
		</div>

		<?php return ob_get_clean();
	}
}
new Massive_Blocks_RowSeparator;
?>