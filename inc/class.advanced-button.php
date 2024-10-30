<?php
/**
* PHP rendering for the blockquote block
*/
class Massive_Blocks_advancedbutton
{
	var $fields = array(

		'alignment'        => 	array( 'type' => 'string', 'default' => 'center' ),
		'btnStyles'        => 	array( 'type' => 'string', 'default' => 'style-1' ),
		'btnText'          => 	array( 'type' => 'string', 'default' => 'Click Me' ),
		'btnLink'          => 	array( 'type' => 'string', 'default' => '#' ),
		'fontFamily'  => array( 'type' => 'string', 'default' => 'Open Sans' ),
		'uniqueId'         => 	array( 'type' => 'string', 'default' => 'btn-1' ),
		'icon_class'       => 	array( 'type' => 'string', 'default' => 'fas fa-angle-right' ),
		'btnSecondaryText' => 	array( 'type' => 'string', 'default' => 'Hover Text' ),
		'btnFontSize'      => 	array( 'type' => 'number', 'default' => '20px' ),
		'btnPadding'       => 	array( 'type' => 'string', 'default' => '20px' ),
		'btnWidth'         => 	array( 'type' => 'string', 'default' => '50%' ),
		'btnRadius'        => 	array( 'type' => 'string', 'default' => '15px' ),
		'btnTextColor'     => 	array( 'type' => 'string', 'default' => '#ffffff' ),
		'btnBGColor'       => 	array( 'type' => 'string', 'default' => '#7fb1d2' ),
		'btnHoverTextColor' => 	array( 'type' => 'string', 'default' => '#12e28b' ),
		'btnHoverBGColor'  => 	array( 'type' => 'string', 'default' => '#767676' ),
		'btnBorderColor'   => 	array( 'type' => 'string', 'default' => '#767676' ),
		'btnBorderHoverColor' => 	array( 'type' => 'string', 'default' => '#005075' ),
		'btnSecondaryBGcolor' => 	array( 'type' => 'string', 'default' => '#005075' ),
		'btnBorderPosition'   => 	array( 'type' => 'string', 'default' => 'top' ),
		'btnBorderStyles'     => 	array( 'type' => 'string', 'default' => 'solid' ),
		'btnBorderHeight'     => 	array( 'type' => 'string', 'default' => '3px' ),
		'btnMargin'           => 	array( 'type' => 'string', 'default' => '10px 0' ),
		'btnTarget'           => 	array( 'type' => 'string', 'default' => '_blank' ),
		'className'           => 	array( 'type' => 'string', 'default' => '' ),
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
		register_block_type( 'massive-blocks/advanced-button', array(
			'attributes' => $this->fields,
			'render_callback' => array( $this, 'render_block' ),
		));
	}


	function render_block($attributes){
		$attrs = $this->get_sc_attrs();
		extract( shortcode_atts( $attrs, $attributes ) );
		ob_start();	 

        $border = '';
		if ($btnBorderPosition == 'all') {
			$border = 'border: '.$btnBorderHeight.' '.$btnBorderStyles.' ' .$btnBorderColor. ';';
		} elseif ($btnBorderPosition == 'none') {
			$border = 'border: none;';
			$border .= 'border-width: 0;';		
		} else {
			$border .= 'border-width: 0;';
			$border .= 'border-'.$btnBorderPosition.'-color: '.$btnBorderColor.';';
			$border .= 'border-'.$btnBorderPosition.'-style: '.$btnBorderStyles.';';
			$border .= 'border-'. $btnBorderPosition .'-width: '.$btnBorderHeight.';';
		}

		?>
			
		<div class="massive-wrapper <?php echo $className; ?>" style="text-align: <?php echo $alignment; ?>; margin: <?php echo $btnMargin; ?>;">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php echo urlencode($fontFamily); ?>:regular&subset=latin">

			<div class="massive-btn-wrapper" id="<?php echo $uniqueId; ?>">

				<a 
					class="massive-button <?php echo $btnStyles; ?>" 
					data-text="<?php echo $btnSecondaryText ?>" 
					href="<?php echo $btnLink ?>" 
					target="<?php echo $btnTarget; ?>"
					style="
					font-size: <?php echo $btnFontSize;  ?>;
					width: <?php echo $btnWidth;  ?>;
					border-radius: <?php echo $btnRadius;  ?>;
					<?php echo $border; ?>px;"
				>
					<?php if ($icon_class != '' && $btnStyles != 'style-4' && $btnStyles != 'style-5'): ?>	
					<i class="<?php echo $icon_class; ?>"></i>
					<?php endif ?>

					<span style="font-family:<?php echo $fontFamily;  ?>;"> <?php echo $btnText; ?> </span>
				</a>
        	</div>

        	<style>

        		/*style 2 CSS*/
        		<?php if ($btnStyles == 'style-2'): ?>
					#<?php echo $uniqueId; ?> .style-2::before {
						border-radius: <?php echo $btnRadius; ?>;
						background-color: <?php echo $btnHoverBGColor; ?>;

					}
					#<?php echo $uniqueId; ?> .style-2 {
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
						padding: <?php echo $btnPadding; ?>;
					} 
					#<?php echo $uniqueId; ?> .style-2:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
					}
        		<?php endif ?>

        		/*Style 3 CSS*/
        		<?php if ($btnStyles == 'style-3'): ?>
					#<?php echo $uniqueId; ?> .style-3::before {
						border-radius: <?php echo $btnRadius; ?>;
						background-color: <?php echo $btnHoverBGColor; ?>;

					}
					#<?php echo $uniqueId; ?> .style-3 {
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
						padding: <?php echo $btnPadding; ?>;
					} 
					#<?php echo $uniqueId; ?> .style-3:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
					}
        		<?php endif ?>

        		/*Style 4 CSS*/
        		<?php if ($btnStyles == 'style-4'): ?>
					#<?php echo $uniqueId; ?> .style-4::after, #<?php echo $uniqueId; ?> .style-4 > span {
						padding: <?php echo $btnPadding; ?>;

					}
					#<?php echo $uniqueId; ?> .style-4 {
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
					} 
					#<?php echo $uniqueId; ?> .style-4:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						background-color: <?php echo $btnHoverBGColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
					}
        		<?php endif ?>

        		/*Style 5 CSS*/
        		<?php if ($btnStyles == 'style-5'): ?>
					#<?php echo $uniqueId; ?> .style-5::before {
						background-color: <?php echo $btnHoverBGColor; ?>;
					}
					#<?php echo $uniqueId; ?> .style-5::before, #<?php echo $uniqueId; ?> .style-5 > span {
						border-radius: <?php echo $btnRadius; ?>;
						padding: <?php echo $btnPadding; ?>;
					}
					#<?php echo $uniqueId; ?> .style-5 {
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
					} 
					#<?php echo $uniqueId; ?> .style-5:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
					}
        		<?php endif ?>


        		/*Style 6 CSS*/
        		<?php if ($btnStyles == 'style-6'): ?>
					#<?php echo $uniqueId; ?> .style-6:hover::after {
						background-color: <?php echo $btnHoverBGColor; ?>;
					}
					#<?php echo $uniqueId; ?> .style-6::after {
						background-color: <?php echo $btnBGColor; ?>;
					}
					#<?php echo $uniqueId; ?> .style-6::before {
						border-radius: <?php echo $btnRadius; ?>;
						background-color: <?php echo $btnBGColor; ?>;
					}
					#<?php echo $uniqueId; ?> .style-6 {
						color: <?php echo $btnTextColor; ?>;
						padding: <?php echo $btnPadding; ?>;
					} 
					#<?php echo $uniqueId; ?> .style-6:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
					}
        		<?php endif ?>


        		/*Style 7 CSS*/
        		<?php if ($btnStyles == 'style-7'): ?>
					#<?php echo $uniqueId; ?> .style-7::before {
						border-radius: <?php echo $btnRadius; ?>;
					}
					#<?php echo $uniqueId; ?> .style-7 {
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
						padding: <?php echo $btnPadding; ?>;
					} 
					#<?php echo $uniqueId; ?> .style-7:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						background-color: <?php echo $btnHoverBGColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
					}
        		<?php endif ?>


        		/*Style 8 CSS*/
        		<?php if ($btnStyles == 'style-8'): ?>
					#<?php echo $uniqueId; ?> .style-8::before {
						border-radius: <?php echo $btnRadius; ?>;
						background-color: <?php echo $btnHoverBGColor; ?>;
					}
					#<?php echo $uniqueId; ?> .style-8 {
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
						padding: <?php echo $btnPadding; ?>;
					} 
					#<?php echo $uniqueId; ?> .style-8:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;	
					}
        		<?php endif ?>


        		/*Style 9 CSS*/
        		<?php if ($btnStyles == 'style-9'): ?>
					#<?php echo $uniqueId; ?> .style-9::after {
						border-radius: <?php echo $btnRadius; ?>;
						background-color: <?php echo $btnHoverBGColor; ?>;
					}
					#<?php echo $uniqueId; ?> .style-9 {
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
						padding: <?php echo $btnPadding; ?>;
					} 
					#<?php echo $uniqueId; ?> .style-9:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
					}
        		<?php endif ?>

        		/*Style 10 CSS*/
        		<?php if ($btnStyles == 'style-10'): ?>
					#<?php echo $uniqueId; ?> .style-10 {
						padding: <?php echo $btnPadding; ?>;
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
					}
					#<?php echo $uniqueId; ?> .style-10:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
						background: radial-gradient(circle, <?php echo $btnHoverBGColor; ?> 0.2em, transparent 0.25em) 0 0/1.25em 1.25em, radial-gradient(circle, <?php echo $btnHoverBGColor; ?> 0.2em, transparent 0.25em) 6.25em 6.25em/1.25em 1.25em;	
					}
        		<?php endif ?>

        		/*Style 11  and 1 CSS*/
        		<?php if ($btnStyles == 'style-11' || $btnStyles == 'style-1'): ?>
					#<?php echo $uniqueId; ?> .<?php echo $btnStyles; ?> {
						padding: <?php echo $btnPadding; ?>;
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
					}
					#<?php echo $uniqueId; ?> .<?php echo $btnStyles; ?>:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
						background-color: <?php echo $btnHoverBGColor; ?>;	
					}
        		<?php endif ?>

        		/*Style 12 CSS*/
        		<?php if ($btnStyles == 'style-12'): ?>
					#<?php echo $uniqueId; ?> .style-12 {
						padding: <?php echo $btnPadding; ?>;
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
					}
					#<?php echo $uniqueId; ?> .style-12:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
						background: repeating-linear-gradient(45deg, <?php echo $btnHoverBGColor; ?> 0, <?php echo $btnHoverBGColor; ?> 0.25em, transparent 0.25em, transparent 0.5em);	
					}
        		<?php endif ?>

        		/*Style 13 CSS*/
        		<?php if ($btnStyles == 'style-13'): ?>
					#<?php echo $uniqueId; ?> .style-13 {
						color: <?php echo $btnTextColor; ?>;
						background-color: <?php echo $btnBGColor; ?>;
						padding: <?php echo $btnPadding; ?>;
						box-shadow: 1vw 1vw 0 <?php echo $btnSecondaryBGcolor; ?>;
					} 
					#<?php echo $uniqueId; ?> .style-13:hover {
						color: <?php echo $btnHoverTextColor; ?>;
						background-color: <?php echo $btnHoverBGColor; ?>;
						border-color: <?php echo $btnBorderHoverColor; ?>!important;
						box-shadow: 0.2vw 0.2vw 0 <?php echo $btnSecondaryBGcolor; ?>;
					}
        		<?php endif ?>
        		
        	</style>

		</div>

		<?php return ob_get_clean();
	}
}
new Massive_Blocks_advancedbutton;
?>