<?php
/**
 * Plugin Name: Order From
 * Description: Custom form for create order contact
 * Version: 1.0
 * 
 */

	add_action('graphql_register_types', function() {
		register_graphql_mutation('SubmitOrderForm', [
				'description' => 'Order Form',
				'inputFields' => [
						'first_name' => [
								'type' => ['non_null' => 'string'],
								'description' => 'Name of the person submitting the form',
						],
						'last_name' => [
							'type' => ['non_null' => 'string'],
							'description' => 'Last name of the person submitting the form',
						],
						'email' => [
								'type' => ['non_null' => 'string'],
								'description' => 'Email of the person submitting the form',
						],
						'address' => [
								'type' => 'string',
								'description' => 'Address of the person submitting the form',
						],
						'phone' => [
							'type' => 'string',
							'description' => 'Phone of the person submitting the form',
						],
						'apt' => [
							'type' => 'string',
							'description' => 'Apt/Suite of the person submitting the form',
						],
						'bedrooms' => [
							'type' => 'string',
							'description' => 'Bedrooms of the person submitting the form',
						],
						'bathrooms' => [
							'type' => 'string',
							'description' => 'Bathrooms of the person submitting the form',
						],
						'condition' => [
							'type' => 'string',
							'description' => 'Condition of the person submitting the form',
						],
						'people' => [
							'type' => 'string',
							'description' => 'People of the person submitting the form',
						],
						'extras' => [
							'type' => ['list_of' => 'string'],
							'description' => 'Extras of the person submitting the form',
						],
						'square' => [
							'type' => 'string',
							'description' => 'Square footage of your home the form was successfully submitted',
						],
						'is_allergies' => [
							'type' => 'boolean',
							'description' => 'Allergies the form was successfully submitted',
						],
						'is_pets' => [
							'type' => 'boolean',
							'description' => 'Pets the form was successfully submitted',
						],
						'services' => [
							'type' => 'string',
							'description' => 'Cleaning services of the person submitting the form',
						],
						'frequency' => [
							'type' => 'string',
							'description' => 'Often of the person submitting the form',
						],
						'message' => [
							'type' => 'string',
							'description' => 'Message of the person submitting the form',
						],
				],
				'outputFields' => [
						'first_name' => [
							'type' => ['non_null' => 'string'],
							'description' => 'Name of the person submitting the form',
						],
						'last_name' => [
							'type' => ['non_null' => 'string'],
							'description' => 'Last name of the person submitting the form',
						],
						'email' => [
								'type' => ['non_null' => 'string'],
								'description' => 'Email of the person submitting the form',
						],
						'address' => [
								'type' => 'string',
								'description' => 'Address of the person submitting the form',
						],
						'phone' => [
							'type' => 'string',
							'description' => 'Phone of the person submitting the form',
						],
						'apt' => [
							'type' => 'string',
							'description' => 'Apt/Suite of the person submitting the form',
						],
						'bedrooms' => [
							'type' => 'string',
							'description' => 'Bedrooms of the person submitting the form',
						],
						'bathrooms' => [
							'type' => 'string',
							'description' => 'Bathrooms of the person submitting the form',
						],
						'condition' => [
							'type' => 'string',
							'description' => 'Condition house of the person submitting the form',
						],
						'people' => [
							'type' => 'string',
							'description' => 'Number of people living in this house/apartment submitting the form',
						],
						'extras' => [
							'type' => ['list_of' => 'string'],
							'description' => 'Square footage of the person submitting the form',
						],
						'square' => [
							'type' => 'string',
							'description' => 'Square footage of the person submitting the form',
						],
						'is_allergies' => [
							'type' => 'boolean',
							'description' => 'Allergies of the person submitting the form',
						],
						'is_pets' => [
							'type' => 'boolean',
							'description' => 'Pets of the person submitting the form',
						],
						'services' => [
							'type' => 'string',
							'description' => 'Cleaning services of the person submitting the form',
						],
						'frequency' => [
							'type' => 'string',
							'description' => 'Frequency service of the person submitting the form',
						],
						'message' => [
							'type' => 'string',
							'description' => 'Message of the person submitting the form',
						],
						'success' => [
								'type' => 'boolean',
								'description' => 'Whether the form was successfully submitted',
						],
						'successMessage' => [
							'type' => 'string',
							'description' => 'Message return when successful',
						],
						'errors' => [
								'type' => ['list_of' => 'string'],
								'description' => 'Confirmation or error message',
						],
				],
				'mutateAndGetPayload' => function($input) {

					if(strpos($input['email'], '@') === false) {
						return [
							'errors' => ['Invalid email address']
						];
					}

					$id = wp_insert_post([
						'post_type' => 'orders',
						'post_title' => 'New Order: ' . $input['name']
					]);

					update_field('first_name', $input['first_name'], $id);
					update_field('last_name', $input['last_name'], $id);
					update_field('email', $input['email'], $id);
					update_field('address', $input['address'], $id);
					update_field('phone', $input['phone'], $id);
					update_field('apt', $input['apt'], $id);
					update_field('bedrooms', $input['bedrooms'], $id);
					update_field('bathrooms', $input['bathrooms'], $id);
					update_field('services', $input['services'], $id);
					update_field('people', $input['people'], $id);
					update_field('square', $input['square'], $id);
					update_field('is_allergies', $input['is_allergies'], $id);
					update_field('is_pets', $input['is_pets'], $id);
					update_field('extras', $input['extras'], $id);
					update_field('frequency', $input['frequency'], $id);
					update_field('message', $input['message'], $id);

					return [
						'first_name' => $input['first_name'],
						'last_name' => $input['last_name'],
						'email' => $input['email'],
						'phone' => $input['phone'],
						'address' => $input['address'],
						'apt' => $input['apt'],
						'bedrooms' => $input['bedrooms'],
						'bathrooms' => $input['bathrooms'],
						'services' => $input['services'],
						'people' => $input['people'],
						'square' => $input['square'],
						'is_allergies' => $input['is_allergies'],
						'is_pets' => $input['is_pets'],
						'extras' => $input['extras'],
						'frequency' => $input['frequency'],
						'message' => $input['message'],
						'success' => true,
						'successMessage' => 'Thanks for made order! We`ll get back to you soon.',
						'errors' => $input['errors'],
					];
				},
		]);
	});

	// NOTIFICATION ***
	function custom_wp_mail_from($original_email_address) {
    return 'cleanfox.company@gmail.com'; // from email address
	}

	add_filter('wp_mail_from', 'custom_wp_mail_from');

	function my_notification($post_id, $post, $update){
		// Check if this is not an autosave
			if ( wp_is_post_autosave( $post_id ) ) {
				return;
		}

		// Check if this is not a revision
		if ( wp_is_post_revision( $post_id ) ) {
				return;
		}

		// Check if it's a new post and not an update
		if ( $update ) {
				return;
		}

		// Check if the post type is the one we're targeting
		if ( 'orders' !== $post->post_type ) {
				return;
		}

		if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) || $update ) {
			return;
		}

		// Email header
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		// the email notification
		$to = 'rusbroadway@gmail.com'; // your email
		$subject = 'New Order Created';
		$message = 'A new cleaning order has been created.' . "\r\n";
		$message .= 'Title: ' . $post->post_title . "\r\n";
		$message .= 'Content: ' . $post->post_content . "\r\n";
		$message .= 'View it here: ' . get_permalink( $post_id );

		// Send the email
		wp_mail( $to, $subject, $message, $headers );
	}


	add_action( 'save_post', 'my_notification', 10, 3 );

	// NOTIFICATION ***
