<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Wrapper for static files (scripts, styles, images)
 * to use a cookie free sub-domain.
 * 
 * @package    CFD
 * @author     azampagl
 * @license    ISC
 */
abstract class Kohana_CFD {

	// Subdomain
	public static $subdomain = 'media';

	/**
	 * Gets the base domain of the current site.
	 * 
	 * @return  string
	 */
	protected static function _domain()
	{		
		if ( ! ($domain = parse_url(Kohana::$base_url, PHP_URL_HOST)))
		{
			$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
		}
		
		$subdomains = explode(".", $domain);
		$len = count($subdomains);
		
		return $subdomains[$len - 2].'.'.$subdomains[$len - 1];
	}

	/**
	 * Gets the complete base url of the cfd subdomain.
	 * 
	 * @param   string    protocol [optional]
	 * @param   boolean   use index? [optional]
	 * @return  string
	 */
	public static function base($protocol = NULL, $index = FALSE)
	{
		$base_url = Kohana::$base_url;

		if ($index === TRUE AND ! empty(Kohana::$index_file))
		{
			// Add the index file to the URL
			$base_url .= Kohana::$index_file.'/';
		}

		if ($protocol instanceof Request)
		{
			// Use the current protocol
			$protocol = $protocol->protocol();
		}
		elseif ($protocol === NULL)
		{
			if ( $scheme = parse_url($base_url, PHP_URL_SCHEME))
			{
				$protocol = $scheme;
			}
			else
			{
				$protocol = strtolower(Request::$current->protocol());
			}	
		}

		return $protocol.'://'.CFD::$subdomain.'.'.CFD::_domain().$base_url;
	}

	/**
	 * @see URL::site
	 */
	public static function site($file, $protocol = NULL, $index = FALSE)
	{		
		return CFD::base($protocol, $index).$file;
	}

	/**
	 * @see HTML::image
	 */
	public static function image($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		return HTML::image(CFD::site($file, $protocol, $index), $attributes, $protocol, $index);
	}

	/**
	 * @see HTML::script
	 */
	public static function script($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		return HTML::script(CFD::site($file, $protocol, $index), $attributes, $protocol, $index);
	}

	/**
	 * @see HTML::style
	 */
	public static function style($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		return HTML::style(CFD::site($file, $protocol, $index), $attributes, $protocol, $index);
	}

} // End Kohana_CFD