<?php
defined('ABSPATH') or die;

/**
 * Validates a list of arguments
 * Checks existence of keys, and type of values
 *
 * @param array	$args 				The list of arguments that is to be validated
 * @param array	$validation_map		A list of key-value pairs. Values are used for typechecking
 * @param bool	$typecheck			Set to true if the values of $args should be typecheked
 *
 * @return bool true if all entries pass, false otherwise
 */
function di_validate_arguments(array $args, array $validation_map, $typecheck = false) {
	$passing = true;

	foreach ($validation_map as $key => $map_value) {
		if (isset($args[$key])) {
			if( !$typecheck ) {
				continue;
			}

			if( is_array($map_value) ) {
				// recurse into array
				if (di_validate_arguments($args[$key], $validation_map[$key])) {
					continue;
				}
			}
			elseif( is_string($map_value) ) {
				// typecheck argument value
				if( gettype($args[$key]) == $map_value || in_array($map_value, ['mixed', ''], true) ) {
					continue;
				}
			}
		}

		$passing = false;
		break;
	}

	return $passing;
}


function di_prop_map( $list, $item_prop_map ) {
	$result = [];

	foreach ($list as $item_key => $item ) {
		$item = (array) $item;
		$result[ $item_key ] = [];

		foreach( $item_prop_map as $map_to => $map_from ) {
			$result[ $item_key ][ $map_to ] = $item[$map_from];
		}
	}
	return $result;
}
