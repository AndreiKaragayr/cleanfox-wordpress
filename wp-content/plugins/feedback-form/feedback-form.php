<?php
/**
 * Plugin Name: Feedback Form
 * Description: Custom form for feedback contact
 * Version: 1.0
 * 
 */

	add_action('graphql_register_types', function() {
		register_graphql_mutation('SubmitFeedbackForm', [
				'description' => 'Feedback Form',
				'inputFields' => [
						'first_name' => [
								'type' => 'string',
								'description' => 'Name of the person submitting the form',
						],
						'last_name' => [
							'type' => 'string',
							'description' => 'Last name of the person submitting the form',
						],
						'zip' => [
								'type' => ['non_null' => 'string'],
								'description' => 'Zip of the person submitting the form',
						],
						'phone' => [
							'type' => ['non_null' => 'string'],
							'description' => 'Phone of the person submitting the form',
						],
						'message' => [
							'type' => 'string',
							'description' => 'Message of the person submitting the form',
						],
				],
				'outputFields' => [
						'first_name' => [
							'type' => 'string',
							'description' => 'Name of the person submitting the form',
						],
						'last_name' => [
							'type' => 'string',
							'description' => 'Last name of the person submitting the form',
						],
						'zip' => [
							'type' => ['non_null' => 'string'],
							'description' => 'Zip of the person submitting the form',
						],
						'phone' => [
							'type' => ['non_null' => 'string'],
							'description' => 'Phone of the person submitting the form',
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

					$id = wp_insert_post([
						'post_type' => 'feedback',
						'post_title' => 'Feedback Form: ' . $input['name']
					]);

					update_field('first_name', $input['first_name'], $id);
					update_field('last_name', $input['last_name'], $id);
					update_field('zip', $input['zip'], $id);
					update_field('phone', $input['phone'], $id);
					update_field('message', $input['message'], $id);

					return [
						'first_name' => $input['first_name'],
						'last_name' => $input['last_name'],
						'phone' => $input['phone'],
						'zip' => $input['zip'],
						'message' => $input['message'],
						'success' => true,
						'successMessage' => 'Thank you! We`ll get back to you soon.',
						'errors' => $input['errors'],
					];
				},
		]);
	});

	// NOTIFICATION ***
	function custom_wp_mail_from_feedback($original_email_address) {
    return 'andreikara404@gmail.com'; // from email address
	}

	add_filter('wp_mail_from', 'custom_wp_mail_from_feedback');

	function my_notification_feedback($post_id, $post, $update){
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
		if ( 'feedback' !== $post->post_type ) {
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
		$subject = 'New Feedback';
		$message = 'A new feedback from has been created.' . "\r\n";
		$message .= 'Title: ' . $post->post_title . "\r\n";
		$message .= 'Content: ' . $post->post_content . "\r\n";
		$message .= 'View it here: ' . get_permalink( $post_id );

		// Send the email
		wp_mail( $to, $subject, $message, $headers );
	}


	add_action( 'save_post', 'my_notification_feedback', 10, 4 );

	// NOTIFICATION ***
