<?php

if (elgg_is_logged_in()) {
	forward();
}

$email = elgg_get_session()->get('emailsent', '');
if (!$email) {
	forward();
}

$shell = elgg_get_config('walled_garden') ? 'walled_garden' : 'default';

$title = elgg_echo('uservalidationbyemail:emailsent', [$email]);

$body = elgg_view_layout('default', [
	'title' => $title,
	'content' => elgg_echo('uservalidationbyemail:registerok'),
	'sidebar' => false,
]);

echo elgg_view_page(strip_tags($title), $body, $shell);