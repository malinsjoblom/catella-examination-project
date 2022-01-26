<?php
/**
 * ACF flexible content (Site hero)
 *
 * For more information about AcfBuilder and the pattern used,
 * got to: https://github.com/StoutLogic/acf-builder/wiki
 */
use StoutLogic\AcfBuilder\FieldsBuilder;
defined('ABSPATH') or die;

$layouts = new FieldsBuilder('hero_fields');

$layouts->setLocation('page_type', '==', 'front_page');

$layouts
    ->addImage('image')
    ->addText('large_title')
    ->addText('small_heading')

    ->addTextArea('text')
    ->addText('button');



add_action('acf/init', function() use ($layouts) {
	acf_add_local_field_group($layouts->build());
}, 100 );
