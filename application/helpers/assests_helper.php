<?php 

/**
 * Helper asset_url()
 * ------------------------------------------------------------------------
 * @access    public
 * @param    string
 * @return    string
 */
if ( ! function_exists('asset'))
{
    function asset($uri)
    {
        $_ci =& get_instance();
        return $_ci->config->base_url('assets/'.$uri);
    }
} 