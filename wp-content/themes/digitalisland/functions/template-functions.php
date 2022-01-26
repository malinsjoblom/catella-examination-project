<?php



/**
 * Used for including acf 'layouts'
 * Includes template partial relative to THEME_DIR/templates/layouts/{$context}/{$layout}
 *
 * @param string $part path to template part
 */
function get_layout($context, $layout, $args=[] ) {
	$layout = 'templates/layouts/' . $context . '/' . untrailingslashit($layout) . '.php';
	if( locate_template( $layout, true, false, $args ) ) {
		return true;
	}
	trigger_error( "The layout '$layout' was not included", E_USER_WARNING );
	return false;
}


/**
 * Includes template partial relative to THEME_DIR/templates/parts/
 *
 * @param string $part path to template part
 */
function get_part($part, $args=[] ) {
	$part = 'templates/parts/' . untrailingslashit($part) . '.php';
	if( locate_template( $part, true, false, $args ) ) {
		return true;
	}
	trigger_error( "template part '$part' was not included", E_USER_WARNING );
	return false;
}


/**
 * Display a interactive list box, a nicer alternative to <select>.
 *
 * @param string $input_name
 * @param array $list An array containing a list of associative arrays with the following structure:
 * 	 'value'
 *   'name'
 *   'id'
 * @param array|null $options
 */
function di_list_box( string $input_name, array $list, $options = [] ) {

	try {
		$list = json_encode( $list, JSON_THROW_ON_ERROR );
		$list = str_replace('</script>', '<\/script>', $list );
	} catch( Error $th ) {
		trigger_error( $th->getMessage(), E_USER_WARNING );
		return;
	}

	// options
	$default_options = [
		'initial_id' => 0,
		'label' => '',
		'return' => false,
	];
	$options = wp_parse_args( $options, $default_options );

	ob_start();
	?>

	<div
		x-data='{
			_settings: {
				listJSON: JSON.parse( `<?= $list ?>` ),
				initialId: `<?= $options['initial_id'] ?>`
			},
			list: [],
			isOpen: false,
			selected: null,
			value: null,
			init() {
				this.list = this._settings.listJSON;
				console.log(this.list);
				this.onSelect({id: this._settings.initialId });
			},
			onSelect: function( details ) {
				this.selected = this.list.find( (item) => details.id == item.id ) || this.list[ 0 ];
				this.value = this.selected.value;
				this.isOpen = false;
			}
		}'
		x-init="init()"
		@select="onSelect( $event.detail )"
		@click.away="isOpen = false"
		@keydown.escape="isOpen = false"
	>

		<input type="hidden" name="<?= $input_name ?>" x-model="value" />
		<label class="block text-sm font-medium text-gray-700">
			<?= $options['label']; ?>
		</label>

		<div class="relative mt-1">
			<button x-on:click="(isOpen = !isOpen)" type="button" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label" class="relative w-full py-2 pl-3 pr-10 text-left bg-white border cursor-default list-box-btn border-green-accent focus:outline-none sm:text-sm">
				<span class="flex items-center">
					<span class="block ml-3 truncate" x-text="selected.name"></span>
				</span>
				<span class="absolute inset-y-0 right-0 flex items-center pr-2 ml-3 pointer-events-none">
					<svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
					</svg>
				</span>
			</button>

			<div
				class="absolute z-40 w-full mt-1 bg-white rounded shadow-lg"
				x-show="isOpen"
				x-transition:leave="transition ease-in duration-100"
				x-transition:leave-start="opacity-100"
				x-transition:leave-end="opacity-0"
			>
				<div>
					<ul tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-item-3" class="py-1 overflow-auto text-base rounded max-h-56 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
						<template x-if="list.length" x-for="(item) in list" x-bind:key="item.id">
							<li
								@click="$dispatch('select', { id: item.id })"
								class="relative py-2 pl-3 text-gray-900 cursor-pointer select-none pr-9"
								role="option"
							>
								<div class="flex items-center">
									<span x-text="item.name" class="block ml-3 font-normal truncate"></span>
								</div>

								<span x-show="selected.id === item.id" class="absolute inset-y-0 right-0 flex items-center pr-4">
									<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
									</svg>
								</span>
							</li>
						</template>
					</ul>
				</div>
			</div>
		</div>

	</div>
	<?php

	$html = ob_get_clean();

	if( $options['return'] ) {
		return $html;
	}

	echo $html;
}

function set_margin_bottom_class( ?string $class = null ) : string {
	switch ($class) {
	    case '0':     return 'mb-0';
		case '2rem':  return 'mb-8';
	    case '6rem':  return 'mb-32';
		case '12rem': return 'mb-48';
		case '18rem': return 'mb-72';
		case '24rem': return 'mb-96';
		default:      return 'mb-32';
	};
}
