<?php
/**
 * ACF flexible content (Page sections)
 *
 * For more information about AcfBuilder and the pattern used,
 * got to: https://github.com/StoutLogic/acf-builder/wiki
 */
use StoutLogic\AcfBuilder\FieldsBuilder;
defined('ABSPATH') or die;

$post_types = array_values(get_post_types(array('_builtin' => false, 'public' => true)));
$post_types_all = array_values(get_post_types());

$layouts = new FieldsBuilder('page');

$layouts->setLocation('post_type', '==', 'page');

$layouts
	->addFlexibleContent('sections')
		->addLayout('the_content')
		->addSelect('margin_bottom', [
			'return_format' => 'value',
			'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
			'default_value' => ['2rem']
		])


        ->addLayout('text_block')
			->addText('heading')
			->addTextarea('content')
			->addSelect('alignment')
				->setConfig('choices', ['left', 'center', 'right'])
				->setConfig('return_format', 'label')
			->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])



		->addLayout('shortcode')
			->addText('shortcode_text')
			->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])

		->addLayout('wysiwyg_content')
			->addWysiwyg('content')
			->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])

		->addLayout('contact_link_boxes')
			->addLink('box_1')
			->addLink('box_2')
			->addLink('box_3')
			->addLink('box_4')
			->addTrueFalse('is_resellers_page')
			->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])

		->addLayout('highlighted_article')
		  	->addLink('link')
		  	->addText('heading')
		  	->addTextarea('text')
		  	->addImage('image')
		  	->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])



		->addLayout('post_slider')
			->addNumber('count')
			->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])

		->addLayout('post_box')
			->addNumber('count')
			->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])

		->addLayout ('text_block_image')
		 	->addText('heading')
		 	->addTextarea('text')
		 	->addImage('image')
		 	->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])

		->addLayout('contact_form')
		  	->addText('heading')
		  	->addWysiwyg('content')
		  	->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])




		->addLayout('call_to_action')
		   	->addText('heading')
		   	->addTextarea('text')
		   	->addImage('image')
		   	->addLink('link')
		   	->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])


		->addLayout('img_text_cta_card')
			->addImage('image', [
				'label' => 'Image/CtA/Card Section - Image'
			])
			->addText('heading')
			->addTextarea('text')
			->addText('button_text')
			->addSelect('margin_bottom', [
				'return_format' => 'value',
				'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
				'default_value' => ['2rem']
			])

            ->addLayout('funds_slider')
                ->addText('heading')
                ->addImage('image_signature')
                ->addText('read_button')
                ->addText('buy_button')
                ->addText('funds_button')
                ->addSelect('margin_bottom', [
                    'return_format' => 'value',
                    'choices' => ['0', '2rem', '6rem','12rem', '18rem', '24rem'],
                    'default_value' => ['2rem']
         ])






	->endFlexibleContent();


add_action('acf/init', function() use ($layouts) {
	acf_add_local_field_group($layouts->build());
}, 100 );
