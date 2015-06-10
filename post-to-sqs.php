<?php
/**
 * @package post-to-sqs
 */
/*
Plugin Name: Post to SQS
Plugin URI: https://github.com/kalatech/wp-posts-to-sqs
Description: On Post Update, send the post data to amazon sqs.
Version: 1.0
Author: Arvind Kala
Author URI: http://github.com/kala725
License: KLP
Text Domain: post-to-sqs
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

add_action('save_post', 'post_to_sqs');

function post_to_sqs($post_id)
{
	$url = "http://new.site.com/update/wp-post/".$post_id;
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_HEADER, TRUE); 
	curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
	$head = curl_exec($ch); 
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
	curl_close($ch);
}

