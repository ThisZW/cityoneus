<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'AvadaReduxFramework_select' ) ) {
	class AvadaReduxFramework_select {

		/**
		 * Field Constructor.
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since AvadaReduxFramework 1.0.0
		 */
		public function __construct( $field = array(), $value = '', $parent ) {
			$this->parent = $parent;
			$this->field  = $field;
			$this->value  = $value;
		}

		/**
		 * Field Render Function.
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since AvadaReduxFramework 1.0.0
		 */
		public function render() {
			$sortable = ( isset( $this->field['sortable'] ) && $this->field['sortable'] ) ? ' select2-sortable"' : "";

			if ( ! empty( $sortable ) ) { // Dummy proofing  :P
				$this->field['multi'] = true;
			}

			if ( ! empty( $this->field['data'] ) && empty( $this->field['options'] ) ) {
				if ( empty( $this->field['args'] ) ) {
					$this->field['args'] = array();
				}

				if ( $this->field['data'] == "elusive-icons" || $this->field['data'] == "elusive-icon" || $this->field['data'] == "elusive" ) {
					$icons_file = AvadaReduxFramework::$_dir . 'inc/fields/select/elusive-icons.php';
					/**
					 * filter 'avadaredux-font-icons-file}'
					 *
					 * @param  array $icon_file File for the icons
					 */
					$icons_file = apply_filters( 'avadaredux-font-icons-file', $icons_file );

					/**
					 * filter 'avadaredux/{opt_name}/field/font/icons/file'
					 *
					 * @param  array $icon_file File for the icons
					 */
					$icons_file = apply_filters( "avadaredux/{$this->parent->args['opt_name']}/field/font/icons/file", $icons_file );
					if ( file_exists( $icons_file ) ) {
						require_once $icons_file;
					}
				}

				$this->field['options'] = $this->parent->get_wordpress_data( $this->field['data'], $this->field['args'] );
			}

			if ( ! empty( $this->field['data'] ) && ( $this->field['data'] == "elusive-icons" || $this->field['data'] == "elusive-icon" || $this->field['data'] == "elusive" ) ) {
				$this->field['class'] .= " font-icons";
			}
			//if

			if ( ! empty( $this->field['options'] ) ) {
				$multi = ( isset( $this->field['multi'] ) && $this->field['multi'] ) ? ' multiple="multiple"' : "";

				if ( ! empty( $this->field['width'] ) ) {
					$width = ' style="' . $this->field['width'] . '"';
				} else {
					$width = ' style="width: 40%;"';
				}

				$nameBrackets = "";
				if ( ! empty( $multi ) ) {
					$nameBrackets = "[]";
				}

				$placeholder = ( isset( $this->field['placeholder'] ) ) ? esc_attr( $this->field['placeholder'] ) : __( 'Select an item', 'avadaredux-framework' );

				if ( isset( $this->field['select2'] ) ) { // if there are any let's pass them to js
					$select2_params = json_encode( $this->field['select2'] );
					$select2_params = htmlspecialchars( $select2_params, ENT_QUOTES );

					echo '<input type="hidden" class="select2_params" value="' . $select2_params . '">';
				}

				if ( isset( $this->field['multi'] ) && $this->field['multi'] && isset( $this->field['sortable'] ) && $this->field['sortable'] && ! empty( $this->value ) && is_array( $this->value ) ) {
					$origOption             = $this->field['options'];
					$this->field['options'] = array();

					foreach ( $this->value as $value ) {
						$this->field['options'][ $value ] = $origOption[ $value ];
					}

					if ( count( $this->field['options'] ) < count( $origOption ) ) {
						foreach ( $origOption as $key => $value ) {
							if ( ! in_array( $key, $this->field['options'] ) ) {
								$this->field['options'][ $key ] = $value;
							}
						}
					}
				}

				$sortable = ( isset( $this->field['sortable'] ) && $this->field['sortable'] ) ? ' select2-sortable"' : "";

				echo '<select ' . $multi . ' id="' . $this->field['id'] . '-select" data-placeholder="' . $placeholder . '" name="' . $this->field['name'] . $this->field['name_suffix'] . $nameBrackets . '" class="avadaredux-select-item ' . $this->field['class'] . $sortable . '"' . $width . ' rows="6">';
				echo '<option></option>';

				foreach ( $this->field['options'] as $k => $v ) {

					if (is_array($v)) {
						echo '<optgroup label="' . $k . '">';

						foreach($v as $opt => $val) {
							$this->make_option($opt, $val, $k);
						}

						echo '</optgroup>';

						continue;
					}

					$this->make_option($k, $v);
				}
				//foreach

				echo '</select>';
			} else {
				echo '<strong>' . __( 'No items of this type were found.', 'avadaredux-framework' ) . '</strong>';
			}
		} //function

		private function make_option($id, $value, $group_name = '') {
			if ( is_array( $this->value ) ) {
				$selected = ( is_array( $this->value ) && in_array( $id, $this->value ) ) ? ' selected="selected"' : '';
			} else {
				$selected = selected( $this->value, $id, false );
			}

			echo '<option value="' . $id . '"' . $selected . '>' . $value . '</option>';
		}

		/**
		 * Enqueue Function.
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since AvadaReduxFramework 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_style( 'select2-css' );

			if (isset($this->field['sortable']) && $this->field['sortable']) {
				wp_enqueue_script('jquery-ui-sortable');
			}

			wp_enqueue_script(
				'avadaredux-field-select-js',
				AvadaReduxFramework::$_url . 'inc/fields/select/field_select' . AvadaRedux_Functions::isMin() . '.js',
				array( 'jquery', 'select2-js', 'avadaredux-js' ),
				time(),
				true
			);

			if ($this->parent->args['dev_mode']) {
				wp_enqueue_style(
					'avadaredux-field-select-css',
					AvadaReduxFramework::$_url . 'inc/fields/select/field_select.css',
					array(),
					time(),
					'all'
				);
			}
		} //function
	} //class
}
