<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
* Main Class to register blocks and handle server side rendering
*/
class Massive_Blocks
{
	
	function __construct()
	{
		add_action( 'enqueue_block_assets', array( $this, 'enqueue_assets' ) );
        add_action( 'enqueue_block_editor_assets', array($this, 'block_editor_assets') );
        add_filter( 'block_categories', array($this, 'block_category'), 10, 2 );
        // remove_filter( 'the_content', 'wpautop' );
        // add_filter( 'the_content', array($this, 'reset_wpautop') );
	}

    function reset_wpautop($content){
        if (function_exists('has_blocks') && has_blocks()) {
            return $content;
        }

        return wpautop($content);
    }

	function enqueue_assets(){
        wp_enqueue_style(
            'mba-blocks-css',
            MBA_URL . '/dist/blocks.style.build.css',
            array(),
            filemtime( MBA_PATH . '/dist/blocks.style.build.css' )
        );
    }

    function gutenberg_install_notice() {
        $plugin_name = 'Massive Blocks';
        echo '
        <div class="updated">
          <p>'.sprintf('<strong>%s</strong> requires <strong>Gutenberg</strong> plugin to be installed and activated on your site.', $plugin_name).'</p>
        </div>';
    }

    function block_editor_assets(){
        wp_enqueue_script(
            'mba-blocks-editor-js',
            MBA_URL. '/dist/blocks.build.js',
            array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ),
            filemtime( MBA_PATH . '/dist/blocks.build.js' )
        );

        wp_enqueue_style(
            'mba-blocks-editor-css',
            MBA_URL . '/dist/blocks.editor.build.css',
            array('wp-edit-blocks'),
            filemtime( MBA_PATH . '/dist/blocks.editor.build.css' )
        );        
    }

    function block_category($categories){
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'massive_blocks',
                    'title' => __( 'Massive Blocks', 'massive-blocks' ),
                ),
            )
        );
    }

    function autoload( $directory ) {

        // Get a listing of the current directory
        $scanned_dir = scandir( $directory );

        if ( empty( $scanned_dir ) ) {
            return;
        }

        // Ignore these items from scandir
        $ignore = array( '.', '..' );

        // Remove the ignored items
        $scanned_dir = array_diff( $scanned_dir, $ignore );

        foreach ( $scanned_dir as $item ) {

            $filename = $directory . '/' . $item;
            $real_path = realpath( $filename );

            if ( false === $real_path ) {
                continue;
            }

            $filetype = filetype( $real_path );

            if ( empty( $filetype ) ) {
                continue;
            }

            // If it's a directory then recursively load it
            if ( 'dir' === $filetype ) {

                $this->autoload( $real_path );
            }

            // If it's a file, let's try to load it
            else if ( 'file' === $filetype ) {

                // Don't allow files that have been uploaded
                if ( is_uploaded_file( $real_path ) ) {
                    continue;
                }

                // Don't load any files that are not the proper mime type
                if ( 'text/x-php' !== mime_content_type( $real_path ) ) {
                    continue;
                }

                $filesize = filesize( $real_path );
                // Don't include empty or negative sized files
                if ( $filesize <= 0 ) {
                    continue;
                }

                // Don't include files that are greater than 100kb
                if ( $filesize > 100000 ) {
                    continue;
                }

                $pathinfo = pathinfo( $real_path );

                // An empty filename wouldn't be a good idea
                if ( empty( $pathinfo['filename'] ) ) {
                    continue;
                }

                // Sorry, need an extension
                if ( empty( $pathinfo['extension'] ) ) {
                    continue;
                }
                
                // Actually, we want just a PHP extension!
                if ( 'php' !== $pathinfo['extension'] ) {
                    continue;
                }
                
                // Only for files that really exist
                if ( true !== file_exists( $real_path ) ) {
                    continue;
                }

                if ( true !== is_readable( $real_path ) ) {
                    continue;
                }

                require_once( $real_path );
            }
        }
    }    
}
?>