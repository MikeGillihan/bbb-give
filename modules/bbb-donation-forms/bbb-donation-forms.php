<?php

/**
 * This is the basic Give Donation Form module.
 *
 * @class BBB_Donation_Forms
 */
class BBB_Donation_Forms extends FLBuilderModule {

	/**
	 * Constructor function for the module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct( array(
			'name'          => __( 'Donation Form', 'bbb-give' ),
			'description'   => __( 'An basic example for coding new modules.', 'bbb-give' ),
			'category'      => __( 'Give Modules', 'bbb-give' ),
			'dir'           => BBB_GIVE_DIR . 'modules/bbb-donation-forms/',
			'url'           => BBB_GIVE_DIR . 'modules/bbb-donation-forms/',
			'editor_export' => true, // Defaults to true and can be omitted.
			'enabled'       => true, // Defaults to true and can be omitted.
		) );
	}

	/**
	 * Get all GiveWP donation forms
	 *
	 * @return array List of GiveWP forms
	 */
	public static function list_forms() {
		$list = array( '' => __( 'None', 'bbb-give' ) );

		$forms = get_posts( array(
			'post_type'      => 'give_forms',
			'posts_per_page' => - 1,
		) );

		foreach ( $forms as $form ) {
			$list[ $form->ID ] = $form->post_title;
		}

		return $list;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'BBB_Donation_Forms', array(
	'form' => array( // Tab
		'title'    => __( 'General', 'bbb-give' ), // Tab title
		'sections' => array( // Tab Sections
			'select_form' => array( // Section
				'title'  => '', // Section Title
				'fields' => array( // Section Fields
					'select_form_field' => array(
						'type'    => 'select',
						'label'   => __( 'Select Form', 'bbb-give' ),
						'default' => '',
						'options' => BBB_Donation_Forms::list_forms()
					),
					'show_title'        => array(
						'type'    => 'select',
						'label'   => __( 'Show Title', 'bbb-give' ),
						'default' => 'true',
						'options' => array(
							'true'  => 'Show',
							'false' => 'Hide'
						)
					),
					'show_goal'         => array(
						'type'    => 'select',
						'label'   => __( 'Show Goal', 'bbb-give' ),
						'default' => 'true',
						'options' => array(
							'true'  => 'Show',
							'false' => 'Hide'
						)
					),
					'show_content'      => array(
						'type'    => 'select',
						'label'   => __( 'Show Content', 'bbb-give' ),
						'default' => '',
						'options' => array(
							''      => ' - ',
							'none'  => 'No Content',
							'above' => 'Display content ABOVE the fields.',
							'below' => 'Display content BELOW the fields.'
						)
					),
					'display_style'     => array(
						'type'    => 'select',
						'label'   => __( 'Donation Fields', 'bbb-give' ),
						'default' => '',
						'options' => array(
							''       => ' - ',
							'onpage' => 'Show on page.',
							'reveal' => 'Reveal on click.',
							'modal'  => 'Popup on click'
						)
					),
					'float_labels'      => array(
						'type'    => 'select',
						'label'   => __( 'Floating Labels', 'bbb-give' ),
						'default' => '',
						'options' => array(
							''         => ' - ',
							'enabled'  => 'Enabled',
							'disabled' => 'Disabled',
						)
					),
				)
			)
		)
	)
) );