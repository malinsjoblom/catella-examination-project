<?php
/**
 * ACF flexible content (Page sections)
 *
 * For more information about AcfBuilder and the pattern used,
 * got to: https://github.com/StoutLogic/acf-builder/wiki
 */
use StoutLogic\AcfBuilder\FieldsBuilder;
defined('ABSPATH') or die;

$site_options = new FieldsBuilder('site_options');

$site_options->setLocation('options_page', '==', 'footer');

$site_options
	->addTab('Footer')
		->addText('heading', [ 'label' => __('Heading', 'digitalisland') ])
		->addText('text_large', [ 'label' => __('Text large', 'digitalisland')])
		->addText('button', [ 'label' => __('Text button', 'digitalisland') ])
		->addText('heading_2', [ 'label' => __('Heading 2', 'digitalisland') ])
		->addTextArea('text_box_risk', [ 'label' => __('Text box Riskinformation', 'digitalisland') ])
		->addText('company', ['label' => __('Heading Small Mobile, Company Name', 'digitalisland')])
		->addText('address', ['label' => __('Visiting address', 'digitalisland')])
		->addText('post_address', ['label' => __('Postal address', 'digitalisland')])
		->addText('telephone', ['label' => __('Phonenumber', 'digitalisland')])
		->addText('email', ['label' => __('Email', 'digitalisland')])
        ->addText('cookie_policy', ['label' => __('Cookie policy link', 'digitalisland')])
        ->addText('integrity_policy', ['label' => __('Integrity policy link', 'digitalisland')])

    ->addTab('Banner')
         ->addText('banner_heading', ['label' => __('Heading', 'digitalisland')])
         ->addTextArea('banner_risk', ['label' => __('Banner Riskinformation', 'digitalisland') ])

    ->addTab('Menu buttons')
        ->addText('button_register', ['label' => __('Register Button', 'digitalisland')])
        ->addText('button_login', ['label' => __('Login Button', 'digitalisland')])
    ;

add_action('acf/init', function() use ($site_options) {
	acf_add_local_field_group($site_options->build());
}, 100 );
