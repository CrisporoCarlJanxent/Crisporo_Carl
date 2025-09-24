<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

if (!function_exists('public_url'))
{
    /**
     * Build an absolute URL to a file in the public/ directory,
     * independent of base_url and index_page.
     *
     * @param string $path Relative path under public/ (e.g., 'image.png')
     * @return string Absolute URL path
     */
    function public_url($path = '')
    {
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $scriptDir = rtrim($scriptDir, '/');
        $base = $scriptDir === '' ? '/' : ($scriptDir === '/' ? '/' : $scriptDir . '/');
        $publicPath = 'public/' . ltrim($path, '/');
        return $base . $publicPath;
    }
}
?>

