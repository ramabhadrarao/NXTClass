<?php get_header( 'buddypress' ); ?>

	<div id="content">

		<?php do_action( 'bp_before_activation_page' ) ?>

		<div class="page" id="activate-page">

			<?php if( is_user_logged_in() ) : ?>

				<h3><?php _e( 'Activate your Account', 'huddle' ) ?></h3>
				<br />

				<p><?php _e( 'You are already logged in, so your account is activated.', 'huddle' ) ?></p>

			<?php elseif ( bp_account_was_activated() ) : ?>

				<h2 class="widgettitle"><?php _e( 'Account Activated', 'huddle' ) ?></h2>
				<br />

				<?php do_action( 'bp_before_activate_content' ) ?>

				<?php if ( isset( $_GET['e'] ) ) : ?>
					<p><?php _e( 'Your account was activated successfully! Your account details have been sent to you in a separate email.', 'huddle' ) ?></p>
				<?php else : ?>
					<p><?php _e( 'Your account was activated successfully! You can now log in with the username and password you provided when you signed up.', 'huddle' ) ?></p>
				<?php endif; ?>

			<?php else : ?>

				<h3><?php _e( 'Activate your Account', 'huddle' ) ?></h3>
				<br />

				<?php do_action( 'bp_before_activate_content' ) ?>

				<p><?php _e( 'Please provide a valid activation key.', 'huddle' ) ?></p>

				<form action="" method="get" class="standard-form" id="activation-form">

					<p class="editfield">
						<label for="key"><?php _e( 'Activation Key:', 'huddle' ) ?></label>
						<input type="text" name="key" id="key" value="" />
					</p>

					<p class="submit">
						<input type="submit" class="btn-gray" name="submit" value="<?php _e( 'Activate', 'huddle' ) ?>" />
					</p>

				</form>

			<?php endif; ?>

			<?php do_action( 'bp_after_activate_content' ) ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_activation_page' ) ?>

	</div><!-- #content -->

<?php get_footer( 'buddypress' ); ?>
