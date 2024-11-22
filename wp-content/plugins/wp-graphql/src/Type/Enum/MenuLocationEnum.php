<?php
namespace WPGraphQL\Type\Enum;

use WPGraphQL\Data\DataSource;
use WPGraphQL\Type\WPEnumType;

class MenuLocationEnum {

	/**
	 * Register the MenuLocationEnum Type to the Schema
	 *
	 * @return void
	 */
	public static function register_type() {
		$values = [];

		$locations = DataSource::get_registered_nav_menu_locations();

		if ( ! empty( $locations ) && is_array( $locations ) ) {
			foreach ( $locations as $location ) {
				$values[ WPEnumType::get_safe_name( $location ) ] = [
					'value'       => $location,
					'description' => sprintf(
						// translators: %s is the menu location name.
						__( 'Put the menu in the %s location', 'wp-graphql' ),
						$location
					),
				];
			}
		}

		if ( empty( $values ) ) {
			$values['EMPTY'] = [
				'value'       => 'Empty menu location',
				'description' => __( 'Empty menu location', 'wp-graphql' ),
			];
		}

		register_graphql_enum_type(
			'MenuLocationEnum',
			[
				'description' => __( 'Registered menu locations', 'wp-graphql' ),
				'values'      => $values,
			]
		);
	}
}
