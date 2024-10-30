<?php
/**
* PHP rendering for the blockquote block
*/
class Massive_Blocks_BlockQuote
{
	var $fields = array(

		// Quote Content Settings
		'quoteText'          => 	array( 'type' => 'string', 'default' => 'Hi, I am the quote content. Click to change me.' ),
		'quoteFontSize'      => 	array( 'type' => 'number', 'default' => '20' ),
		'quoteColor'         => 	array( 'type' => 'string', 'default' => '#0693E3' ),
		'quoteLetterSpacing' => 	array( 'type' => 'string', 'default' => '' ),
		'fontFamily'  		=> array( 'type' => 'string', 'default' => 'Open Sans' ),

		// Person Settings
		'personText'          => 	array( 'type' => 'string', 'default' => 'John Doe' ),
		'personFontSize'      => 	array( 'type' => 'number', 'default' => '29' ),
		'personColor'         => 	array( 'type' => 'string', 'default' => '#000000' ),
		'personLetterSpacing' => 	array( 'type' => 'string', 'default' => '' ),
		'personMargin'        => 	array( 'type' => 'string', 'default' => '0 0 10px 0' ),
		'fontFamilyPerson'  		=> array( 'type' => 'string', 'default' => 'Open Sans' ),

		// Company Content Settings
		'companyText'          => 	array( 'type' => 'string', 'default' => 'Company Inc..' ),
		'companyFontSize'      => 	array( 'type' => 'number', 'default' => '20' ),
		'companyColor'         => 	array( 'type' => 'string', 'default' => '#330a0a' ),
		'companyLetterSpacing' => 	array( 'type' => 'string', 'default' => '' ),
		'fontFamilyCompany'  		=> array( 'type' => 'string', 'default' => 'Open Sans' ),

		// Quote General Settings
		'quoteWidth'          => 	array( 'type' => 'string', 'default' => '50%' ),
		'quoteIconColor'      => 	array( 'type' => 'string', 'default' => '#0693E3' ),
		'quoteIconRadius'     => 	array( 'type' => 'string', 'default' => '50%' ),
		'quoteIconBGColor'    => 	array( 'type' => 'string', 'default' => '#f5d1d1' ),		
		'quoteBorderColor'    => 	array( 'type' => 'string', 'default' => '#0693E3' ),		
		'quoteBGColor'        => 	array( 'type' => 'string', 'default' => '#fff9f9' ),		
		'icon_class'  => 	array( 'type'     => 'string', 'default' => 'fas fa-quote-right' ),
		'box_styles'    => 	array( 'type'     => 'string', 
							'default' => '{
								"paddingTop": "0",
								"marginTop": "10px",
								"paddingBottom": "0",
								"paddingLeft": "0",
								"borderStyle": "solid",
								"borderTopWidth": "3px",
								"borderRightWidth": "0",
								"borderBottomWidth": "0",
								"borderLeftWidth": "0"
							}' 
		),
		'alignment'  => 	array( 'type'     => 'string', 'default' => 'left' ),
		'className'  => 	array( 'type'     => 'string', 'default' => '' ),
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
		register_block_type( 'massive-blocks/blockquote', array(
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
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php echo urlencode($fontFamilyPerson); ?>:regular&subset=latin">
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php echo urlencode($fontFamilyCompany); ?>:regular&subset=latin">

			<div class="pbb-blockquote-box" style="text-align:<?php echo $alignment;  ?>;">
            	<figure class="pbb-blockquote-fig" style="
            		<?php echo $inline_css; ?>
					max-width: <?php echo $quoteWidth;  ?>;
					background-color:<?php echo $quoteBGColor;  ?>;
					border-color: <?php echo $quoteBorderColor;  ?>;"
				>
            		<figcaption>
            			<i class="<?php echo $icon_class; ?>" style="
            				color: <?php echo $quoteIconColor; ?>;
            				background-color: <?php echo $quoteIconBGColor; ?>;
            				border-radius: <?php echo $quoteIconRadius; ?>;
            			"></i>
						<div style="
            				font-size: <?php echo $quoteFontSize.'px'; ?>;
            				color: <?php echo $quoteColor; ?>;
            				letter-spacing: <?php echo $quoteLetterSpacing; ?>;
            				font-family:<?php echo $fontFamily; ?>;"
            			>
            			<?php echo $quoteText; ?>
            			</div>
            		</figcaption>
            		<h3 style="
            				font-size: <?php echo $personFontSize.'px'; ?>;
            				color: <?php echo $personColor; ?>;
            				letter-spacing: <?php echo $personLetterSpacing; ?>;
            				margin: <?php echo $personMargin; ?>;
            				font-family:<?php echo $fontFamilyPerson; ?>;
        				">
            			<?php echo $personText ?>
            		</h3>
            		<h4 style="
            				font-size: <?php echo $companyFontSize.'px'; ?>;
            				color: <?php echo $companyColor; ?>;
            				letter-spacing: <?php echo $companyLetterSpacing; ?>;
            				font-family:<?php echo $fontFamilyCompany; ?>;
        				">
            			<?php echo $companyText ?>
            		</h4>
            	</figure>
        	</div>
		</div>

		<?php return ob_get_clean();
	}
}
new Massive_Blocks_BlockQuote;
?>