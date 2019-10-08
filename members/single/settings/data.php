<?php

/**
 * BuddyPress - Users Home
 *
 * @package bp-magic
 */

get_header( 'buddypress' ); ?>

<div id="content">
	<div class="padder">

		<?php do_action( 'bp_before_member_home_content' ); ?>

		<div id="item-header" role="complementary">

			<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>

		</div><!-- #item-header -->


		<div id="item-body">


			<?php do_action( 'bp_before_member_body' ); ?>

			<div class="item-list-tabs no-ajax" id="subnav">
				<ul>

					<?php bp_get_options_nav(); ?>

					<?php do_action( 'bp_member_plugin_options_nav' ); ?>

				</ul>
			</div><!-- .item-list-tabs -->
			<div class="item-body-content">
				<?php
				/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
				do_action( 'bp_before_member_settings_template' ); ?>

				<h2><?php _e( 'Data Export', 'bp-magic' ); ?></h2>

				<?php $request = bp_settings_get_personal_data_request(); ?>

				<?php if ( $request ) : ?>

					<?php if ( 'request-completed' === $request->status ) : ?>

						<?php if ( bp_settings_personal_data_export_exists( $request ) ) : ?>

							<p><?php esc_html_e( 'Your request for an export of personal data has been completed.', 'bp-magic' ); ?></p>
							<p><?php printf( esc_html__( 'You may download your personal data by clicking on the link below. For privacy and security, we will automatically delete the file on %s, so please download it before then.', 'bp-magic' ), bp_settings_get_personal_data_expiration_date( $request ) ); ?></p>

							<p>
								<strong><?php printf( '<a href="%1$s">%2$s</a>', bp_settings_get_personal_data_export_url( $request ), esc_html__( 'Download personal data', 'bp-magic' ) ); ?></strong>
							</p>

						<?php else : ?>

							<p><?php esc_html_e( 'Your previous request for an export of personal data has expired.', 'bp-magic' ); ?></p>
							<p><?php esc_html_e( 'Please click on the button below to make a new request.', 'bp-magic' ); ?></p>

							<form id="bp-data-export" method="post">
								<input type="hidden" name="bp-data-export-delete-request-nonce"
									   value="<?php echo wp_create_nonce( 'bp-data-export-delete-request' ); ?>"/>
								<button type="submit" name="bp-data-export-nonce"
										value="<?php echo wp_create_nonce( 'bp-data-export' ); ?>"><?php esc_html_e( 'Request new data export', 'bp-magic' ); ?></button>
							</form>

						<?php endif; ?>

					<?php elseif ( 'request-confirmed' === $request->status ) : ?>

						<p><?php printf( esc_html__( 'You previously requested an export of your personal data on %s.', 'bp-magic' ), bp_settings_get_personal_data_confirmation_date( $request ) ); ?></p>
						<p><?php esc_html_e( 'You will receive a link to download your export via email once we are able to fulfill your request.', 'bp-magic' ); ?></p>

					<?php endif; ?>

				<?php else : ?>

					<p><?php esc_html_e( 'You can request an export of your personal data, containing the following items if applicable:', 'bp-magic' ); ?></p>

					<?php bp_settings_data_exporter_items(); ?>

					<p><?php esc_html_e( 'If you want to make a request, please click on the button below:', 'bp-magic' ); ?></p>

					<form id="bp-data-export" method="post">
						<button type="submit" name="bp-data-export-nonce"
								value="<?php echo wp_create_nonce( 'bp-data-export' ); ?>"><?php esc_html_e( 'Request personal data export', 'bp-magic' ); ?></button>
					</form>

				<?php endif; ?>


				<?php

				/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
				do_action( 'bp_after_member_settings_template' );
				?>
			</div>

		</div><!-- #item-body -->

		<?php do_action( 'bp_after_member_settings_template' ); ?>

	</div><!-- .padder -->
</div><!-- #content -->

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>
