<?php
/**
* PHP rendering for the alert block
*/
class Massive_Blocks_iHover
{
	var $fields = array(
		'className'   => array( 'type' => 'string', 'default' => '' ),
		'alignment'   => array( 'type' => 'string', 'default' => 'left' ),
		
		'headingText'  => array( 'type' => 'string', 'default' => 'Heading' ),
		'hdTextColor'  => array( 'type' => 'string', 'default' => '#ffffff' ),
		'hdletterSpacing' => array( 'type' => 'string', 'default' => '1px' ),
		'hdFontSize'    => array( 'type' => 'number', 'default' => 12 ),

		'descText'  => array( 'type' => 'string', 'default' => 'Description goes here' ),
		'descTextColor'  => array( 'type' => 'string', 'default' => '#111111' ),
		'descletterSpacing' => array( 'type' => 'string', 'default' => '1px' ),
		'descFontSize'    => array( 'type' => 'number', 'default' => 12 ),

		'boxBGColor'   => array( 'type' => 'string', 'default' => '#0073a8' ),
		'hrefLink'   => array( 'type' => 'string', 'default'=> '#' ),
		'imageURL'   => array( 'type' => 'string', 'default'=> '' ),
		'imageTitle'   => array( 'type' => 'string', 'default'=> '' ),
		'imageAltText'   => array( 'type' => 'string', 'default'=> '' ),
		'iHoverTypes'   => array( 'type' => 'string', 'default'=> 'massive-circle' ),
		'boxMargin'   => array( 'type' => 'string', 'default'=> '0 auto' ),
		'iHoverWidth'   => array( 'type' => 'string', 'default'=> '220px' ),
		'iHoverHeight'   => array( 'type' => 'string', 'default'=> '220px' ),
		'iHoverCircleStyles'   => array( 'type' => 'string', 'default'=> 'massive-style-2 ms_left_to_right' ),
		'iHoverSquareStyles'   => array( 'type' => 'string', 'default'=> 'massive-style-1 ms_left_and_right' ),
		'linkTarget'   => array( 'type' => 'string', 'default'=> '_blank' ),
		'sepColor'   => array( 'type' => 'string', 'default'=> '#462525' ),
		'sepHeight'   => array( 'type' => 'string', 'default'=> '1px' ),
		'sepStyles'   => array( 'type' => 'string', 'default'=> 'solid' ),
		
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
		register_block_type( 'massive-blocks/ihover', array(
			'attributes' => $this->fields,
			'render_callback' => array( $this, 'render_block' ),
		));
	}


	function render_block($attributes){
		$attrs = $this->get_sc_attrs();
		extract( shortcode_atts( $attrs, $attributes ) );
		ob_start();	 ?>
		
		<div class="massive-wrapper <?php echo $className; ?>">

			<div classs='massive-ihover-box'>
				<?php if ($iHoverTypes == 'massive-circle'): ?>

				<div class="<?php echo $iHoverTypes ?> <?php echo $iHoverCircleStyles ?> massive-ih-item" style="margin:<?php echo $boxMargin;  ?>;
				width:<?php echo $iHoverWidth;  ?>;
				height:<?php echo $iHoverHeight;  ?>;
				">
					<a href="<?php echo $hrefLink; ?>" target="<?php echo $linkTarget; ?>">
						<div class="masive-img-section" style="
							width:<?php echo $iHoverWidth;  ?>;
							height:<?php echo $iHoverHeight;  ?>;
							">
	        				<img src="<?php echo $imageURL; ?>" alt="<?php echo $imageAltText; ?>" title="<?php echo $imageTitle; ?>"/>
	        			</div>

	        			<?php if ($iHoverCircleStyles == 'massive-style-5' || $iHoverCircleStyles == 'massive-style-20 ms_top_to_bottom' || $iHoverCircleStyles == 'massive-style-20 ms_bottom_to_top'): ?>
	        				

	        				<div class="massive-info-section">
	            				<div class='massive-info-back' style="background-color: <?php echo $boxBGColor; ?>">
	                				<h3 style="
										font-size:<?php echo $hdFontSize;  ?>px;
										color:<?php echo $hdTextColor;  ?>;
										letter-spacing:<?php echo $hdletterSpacing;  ?>;
										"><?php echo $headingText; ?>
									</h3>
	                				<p style="
										font-size:<?php echo $descFontSize; ?>px;
										color:<?php echo $descTextColor; ?>;
										letter-spacing:<?php echo $descletterSpacing; ?>;
										border-top: <?php echo $sepHeight;  ?> <?php echo $sepStyles;  ?> <?php echo $sepColor;  ?>
										"><?php echo $descText; ?></p>
	                			</div>
	            			</div>
	        			<?php endif ?>


	        			<?php if ($iHoverCircleStyles != 'massive-style-5' && $iHoverCircleStyles != 'massive-style-20 ms_top_to_bottom' && $iHoverCircleStyles != 'massive-style-20 ms_bottom_to_top'): ?>
	        				
	        				<div class="massive-info-section" style="background-color: <?php echo $boxBGColor; ?>">
	            				<h3 style="
									font-size:<?php echo $hdFontSize;  ?>px;
									color:<?php echo $hdTextColor;  ?>;
									letter-spacing:<?php echo $hdletterSpacing;  ?>;
									"><?php echo $headingText; ?>
								</h3>
	            				<p style="
									font-size:<?php echo $descFontSize; ?>px;
									color:<?php echo $descTextColor; ?>;
									letter-spacing:<?php echo $descletterSpacing; ?>;
									border-top: <?php echo $sepHeight;  ?> <?php echo $sepStyles;  ?> <?php echo $sepColor;  ?>
									"><?php echo $descText; ?></p>
	            			</div>
	        			<?php endif ?>
					</a>
				</div>
				<?php endif ?>


				<?php if ($iHoverTypes == 'massive-square'): ?>
					
					<div class="<?php echo $iHoverTypes ?> <?php echo $iHoverSquareStyles ?> massive-ih-item" style="margin:<?php echo $boxMargin;  ?>;
					width:<?php echo $iHoverWidth;  ?>;
					height:<?php echo $iHoverHeight;  ?>;
					">
						<a href="<?php echo $hrefLink; ?>" target="<?php echo $linkTarget; ?>">

							<div class="masive-img-section">
	        					<img src="<?php echo $imageURL; ?>" alt="<?php echo $imageAltText; ?>" title="<?php echo $imageTitle; ?>"/>
	        				</div>

	        				<div class="massive-info-section" style="background-color: <?php echo $boxBGColor; ?>">
	            				<h3 style="
									font-size:<?php echo $hdFontSize;  ?>px;
									color:<?php echo $hdTextColor;  ?>;
									letter-spacing:<?php echo $hdletterSpacing;  ?>;
									"><?php echo $headingText; ?>
								</h3>
	            				<p style="
									font-size:<?php echo $descFontSize; ?>px;
									color:<?php echo $descTextColor; ?>;
									letter-spacing:<?php echo $descletterSpacing; ?>;
									border-top: <?php echo $sepHeight;  ?> <?php echo $sepStyles;  ?> <?php echo $sepColor;  ?>
									"><?php echo $descText; ?></p>
	            			</div>
						</a>
					</div>
				<?php endif ?>

			</div>
		</div>

		<?php return ob_get_clean();
	}
}
new Massive_Blocks_iHover;
?>