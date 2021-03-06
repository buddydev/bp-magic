<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
	<ul>
		<?php bp_group_admin_tabs(); ?>
	</ul>
</div><!-- .item-list-tabs -->

<form action="<?php bp_group_admin_form_action(); ?>" name="group-settings-form" id="group-settings-form" class="standard-form" method="post" enctype="multipart/form-data" role="main">

<?php do_action( 'bp_before_group_admin_content' ); ?>

<?php /* Edit Group Details */ ?>
<div class="clearfix item-body" id="group-create-body">
<?php if ( bp_is_group_admin_screen( 'edit-details' ) ) : ?>

	<?php do_action( 'bp_before_group_details_admin' ); ?>
         <div class="row">
            <label for="group-name"><?php _e( 'Group Name (required)', 'bp-magic' ); ?></label>
            <input type="text" name="group-name" id="group-name" value="<?php bp_group_name(); ?>" aria-required="true" />
         </div>
        <div class="row">
            <label for="group-desc"><?php _e( 'Group Description (required)', 'bp-magic' ); ?></label>
            <textarea name="group-desc" id="group-desc" aria-required="true"><?php bp_group_description_editable(); ?></textarea>
        </div>   
	<?php do_action( 'groups_custom_group_fields_editable' ); ?>

	<div class="row">
		<label for="group-notifiy-members"><?php _e( 'Notify group members of changes via email', 'bp-magic' ); ?></label>
                <div class="input">
                    <label><input type="radio" name="group-notify-members" value="1" /> <?php _e( 'Yes', 'bp-magic' ); ?></label>&nbsp;
                <label><input type="radio" name="group-notify-members" value="0" checked="checked" /> <?php _e( 'No', 'bp-magic' ); ?></label>&nbsp;
                </div>
        </div>       

	<?php do_action( 'bp_after_group_details_admin' ); ?>

	<p><input type="submit" value="<?php _e( 'Save Changes', 'bp-magic' ); ?>" id="save" name="save" /></p>
	<?php wp_nonce_field( 'groups_edit_group_details' ); ?>

<?php endif; ?>

<?php /* Manage Group Settings */ ?>
<?php if ( bp_is_group_admin_screen( 'group-settings' ) ) : ?>

	<?php do_action( 'bp_before_group_settings_admin' ); ?>
        <div class="clear"></div>
       
	<?php if ( bp_is_active( 'forums' ) ) : ?>
                
		<?php if ( bp_forums_is_installed_correctly() ) : ?>
                         <div class="row">
                        <label for="group-show-forum"><?php _e( 'Enable discussion forum', 'bp-magic' ); ?></label>
			<div class="input">
				<input type="checkbox" name="group-show-forum" id="group-show-forum" value="1"<?php bp_group_show_forum_setting(); ?> /> 
			</div>

                         </div>

		<?php endif; ?>

	<?php endif; ?>

	<div class="row">
              <h4><?php _e( 'Privacy Options', 'bp-magic' ); ?></h4>

	<div class="radio group-privacy">
		<label>
			<input type="radio" name="group-status" value="public"<?php bp_group_show_status_setting( 'public' ); ?> />
			<strong><?php _e( 'This is a public group', 'bp-magic' ); ?></strong>
			<ul>
				<li><?php _e( 'Any site member can join this group.', 'bp-magic' ); ?></li>
				<li><?php _e( 'This group will be listed in the groups directory and in search results.', 'bp-magic' ); ?></li>
				<li><?php _e( 'Group content and activity will be visible to any site member.', 'bp-magic' ); ?></li>
			</ul>
		</label>

		<label>
			<input type="radio" name="group-status" value="private"<?php bp_group_show_status_setting( 'private' ); ?> />
			<strong><?php _e( 'This is a private group', 'bp-magic' ); ?></strong>
			<ul>
				<li><?php _e( 'Only users who request membership and are accepted can join the group.', 'bp-magic' ); ?></li>
				<li><?php _e( 'This group will be listed in the groups directory and in search results.', 'bp-magic' ); ?></li>
				<li><?php _e( 'Group content and activity will only be visible to members of the group.', 'bp-magic' ); ?></li>
			</ul>
		</label>

		<label>
			<input type="radio" name="group-status" value="hidden"<?php bp_group_show_status_setting( 'hidden' ); ?> />
			<strong><?php _e( 'This is a hidden group', 'bp-magic' ); ?></strong>
			<ul>
				<li><?php _e( 'Only users who are invited can join the group.', 'bp-magic' ); ?></li>
				<li><?php _e( 'This group will not be listed in the groups directory or search results.', 'bp-magic' ); ?></li>
				<li><?php _e( 'Group content and activity will only be visible to members of the group.', 'bp-magic' ); ?></li>
			</ul>
		</label>
	</div>
        </div>         
	 <div class="row">
	 
	<h4><?php _e( 'Group Invitations', 'bp-magic' ); ?></h4> 

	<p><?php _e( 'Which members of this group are allowed to invite others?', 'bp-magic' ); ?></p> 

	<div class="radio"> 
		<label> 
			<input type="radio" name="group-invite-status" value="members"<?php bp_group_show_invite_status_setting( 'members' ); ?> /> 
			<strong><?php _e( 'All group members', 'bp-magic' ); ?></strong> 
		</label> 

		<label> 
			<input type="radio" name="group-invite-status" value="mods"<?php bp_group_show_invite_status_setting( 'mods' ); ?> /> 
			<strong><?php _e( 'Group admins and mods only', 'bp-magic' ); ?></strong> 
		</label>
		
		<label> 
			<input type="radio" name="group-invite-status" value="admins"<?php bp_group_show_invite_status_setting( 'admins' ); ?> /> 
			<strong><?php _e( 'Group admins only', 'bp-magic' ); ?></strong> 
		</label> 
 	</div> 
 </div>
	
	<?php do_action( 'bp_after_group_settings_admin' ); ?>

	<p><input type="submit" value="<?php _e( 'Save Changes', 'bp-magic' ); ?>" id="save" name="save" /></p>
	<?php wp_nonce_field( 'groups_edit_group_settings' ); ?>

<?php endif; ?>

<?php /* Group Avatar Settings */ ?>
<?php if ( bp_is_group_admin_screen( 'group-avatar' ) ) : ?>

	<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>

			<p><?php _e("Upload an image to use as an avatar for this group. The image will be shown on the main group page, and in search results.", 'bp-magic'); ?></p>

			<p>
				<input type="file" name="file" id="file" />
				<input type="submit" name="upload" id="upload" value="<?php _e( 'Upload Image', 'bp-magic' ); ?>" />
				<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
			</p>

			<?php if ( bp_get_group_has_avatar() ) : ?>

				<p><?php _e( "If you'd like to remove the existing avatar but not upload a new one, please use the delete avatar button.", 'bp-magic' ); ?></p>

				<?php bp_button( array( 'id' => 'delete_group_avatar', 'component' => 'groups', 'wrapper_id' => 'delete-group-avatar-button', 'link_class' => 'edit', 'link_href' => bp_get_group_avatar_delete_link(), 'link_title' => __( 'Delete Avatar', 'bp-magic' ), 'link_text' => __( 'Delete Avatar', 'bp-magic' ) ) ); ?>

			<?php endif; ?>

			<?php wp_nonce_field( 'bp_avatar_upload' ); ?>

	<?php endif; ?>

	<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>

		<h3><?php _e( 'Crop Avatar', 'bp-magic' ); ?></h3>

		<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="avatar" alt="<?php _e( 'Avatar to crop', 'bp-magic' ); ?>" />

		<div id="avatar-crop-pane">
			<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="avatar" alt="<?php _e( 'Avatar preview', 'bp-magic' ); ?>" />
		</div>

		<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php _e( 'Crop Image', 'bp-magic' ); ?>" />

		<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />

		<?php wp_nonce_field( 'bp_avatar_cropstore' ); ?>

	<?php endif; ?>

<?php endif; ?>

<?php /* Manage Group Members */ ?>
<?php if ( bp_is_group_admin_screen( 'manage-members' ) ) : ?>

	<?php do_action( 'bp_before_group_manage_members_admin' ); ?>
	
	<div class="bp-widget">
		<h4><?php _e( 'Administrators', 'bp-magic' ); ?></h4>

		<?php if ( bp_has_members( '&include='. bp_group_admin_ids() ) ) : ?>
		
		<ul id="admins-list" class="item-list single-line">
			
			<?php while ( bp_members() ) : bp_the_member(); ?>
			<li class="clearfix">
                            <div class="item-avatar">
                                <a href="<?php bp_member_permalink(); ?>">
                                    <?php echo bp_core_fetch_avatar( array( 'item_id' => bp_get_member_user_id(), 'type' => 'thumb', 'width' => 50, 'height' => 50, 'alt' => sprintf( __( 'Profile picture of %s', 'bp-magic' ), bp_get_member_name() ) ) ); ?>
                                </a>  
                            </div>
                            
                                
                              <div class="item">
				<div class="item-title">
					<a href="<?php bp_member_permalink(); ?>"> <?php bp_member_name(); ?></a>
                                </div>
                              </div>
                            <?php if ( count( bp_group_admin_ids( false, 'array' ) ) > 1 ) : ?>
                              
                            <div class="action">
					<span class="small">
						<a class="btn button confirm admin-demote-to-member" href="<?php bp_group_member_demote_link( bp_get_member_user_id() ); ?>"><?php _e( 'Demote to Member', 'bp-magic' ); ?></a>
					</span>			
					
                            </div>  
                            <?php endif; ?>
			</li>
			<?php endwhile; ?>
		
		</ul>
		
		<?php endif; ?>

	</div>
	
	<?php if ( bp_group_has_moderators() ) : ?>
		<div class="bp-widget">
			<h4><?php _e( 'Moderators', 'bp-magic' ); ?></h4>		
			
			<?php if ( bp_has_members( '&include=' . bp_group_mod_ids() ) ) : ?>
				<ul id="mods-list" class="item-list single-line">
				
					<?php while ( bp_members() ) : bp_the_member(); ?>					
					<li class="clearfix">
                                            <div class="item-avatar">
                                                <a href="<?php bp_member_permalink(); ?>">
                                                    <?php echo bp_core_fetch_avatar( array( 'item_id' => bp_get_member_user_id(), 'type' => 'thumb', 'width' => 50, 'height' => 50, 'alt' => sprintf( __( 'Profile picture of %s', 'bp-magic' ), bp_get_member_name() ) ) ); ?>
                                                </a>  
                                            </div>
                                             <div class="item">
                                                <div class="item-title">
                                                        <a href="<?php bp_member_permalink(); ?>"> <?php bp_member_name(); ?></a>
                                                </div>
                                          </div>
                                           <div class="action">              
                                                                    <span class="small">
                                                                            <a href="<?php bp_group_member_promote_admin_link( array( 'user_id' => bp_get_member_user_id() ) ); ?>" class="btn button confirm mod-promote-to-admin" title="<?php _e( 'Promote to Admin', 'bp-magic' ); ?>"><?php _e( 'Promote to Admin', 'bp-magic' ); ?></a>
                                                                            <a class="btn button confirm mod-demote-to-member" href="<?php bp_group_member_demote_link( bp_get_member_user_id() ); ?>"><?php _e( 'Demote to Member', 'bp-magic' ); ?></a>
                                                                    </span>		
                                           </div>			
					</li>	
					<?php endwhile; ?>			
				
				</ul>
			
			<?php endif; ?>
		</div>
	<?php endif ?>


	<div class="bp-widget">
		<h4><?php _e("Members", "bp-magic"); ?></h4>

		<?php if ( bp_group_has_members( 'per_page=15&exclude_banned=false' ) ) : ?>

			<?php if ( bp_group_member_needs_pagination() ) : ?>

				<div class="pagination navigation no-ajax">

					<div id="member-count" class="pag-count">
						<?php bp_group_member_pagination_count(); ?>
					</div>

					<div id="member-admin-pagination" class="pagination-links">
						<?php bp_group_member_admin_pagination(); ?>
					</div>

				</div>

			<?php endif; ?>

			<ul id="members-list" class="item-list single-line">
				<?php while ( bp_group_members() ) : bp_group_the_member(); ?>

					<li class="<?php bp_group_member_css_class(); ?>">
						<div class="item-avatar">
                                                <a href="<?php bp_group_member_url(); ?>">
                                                    <?php echo bp_core_fetch_avatar( array( 'item_id' => bp_get_group_member_id(), 'type' => 'thumb', 'width' => 50, 'height' => 50, 'alt' => sprintf( __( 'Profile picture of %s', 'bp-magic' ), bp_get_group_member_name() ) ) ); ?>
                                                </a>  
                                            </div>
                                             <div class="item">
                                                <div class="item-title">
                                                        <?php bp_group_member_link();?>
                                                </div>
                                          </div>
                                           <div class="action">

							<?php if ( bp_get_group_member_is_banned() ) _e( '(banned)', 'bp-magic'); ?>

							<span class="small">

							<?php if ( bp_get_group_member_is_banned() ) : ?>

								<a href="<?php bp_group_member_unban_link(); ?>" class="btn button confirm member-unban" title="<?php _e( 'Unban this member', 'bp-magic' ); ?>"><?php _e( 'Remove Ban', 'bp-magic' ); ?></a>

							<?php else : ?>

								<a href="<?php bp_group_member_ban_link(); ?>" class="btn button confirm member-ban" title="<?php _e( 'Kick and ban this member', 'bp-magic' ); ?>"><?php _e( 'Kick &amp; Ban', 'bp-magic' ); ?></a>
								<a href="<?php bp_group_member_promote_mod_link(); ?>" class="btn button confirm member-promote-to-mod" title="<?php _e( 'Promote to Mod', 'bp-magic' ); ?>"><?php _e( 'Promote to Mod', 'bp-magic' ); ?></a>
								<a href="<?php bp_group_member_promote_admin_link(); ?>" class="btn button confirm member-promote-to-admin" title="<?php _e( 'Promote to Admin', 'bp-magic' ); ?>"><?php _e( 'Promote to Admin', 'bp-magic' ); ?></a>

							<?php endif; ?>

								<a href="<?php bp_group_member_remove_link(); ?>" class="btn button confirm" title="<?php _e( 'Remove this member', 'bp-magic' ); ?>"><?php _e( 'Remove from group', 'bp-magic' ); ?></a>

								<?php do_action( 'bp_group_manage_members_admin_item' ); ?>

							</span>
						</div>
                                            <div class="clear"></div>
					</li>

				<?php endwhile; ?>
			</ul>

		<?php else: ?>

			<div id="message" class="info">
				<p><?php _e( 'This group has no members.', 'bp-magic' ); ?></p>
			</div>

		<?php endif; ?>

	</div>

	<?php do_action( 'bp_after_group_manage_members_admin' ); ?>

<?php endif; ?>

<?php /* Manage Membership Requests */ ?>
<?php if ( bp_is_group_admin_screen( 'membership-requests' ) ) : ?>

	<?php do_action( 'bp_before_group_membership_requests_admin' ); ?>

	<?php if ( bp_group_has_membership_requests() ) : ?>

		<ul id="request-list" class="item-list">
			<?php while ( bp_group_membership_requests() ) : bp_group_the_membership_request(); ?>

				<li>
					<?php bp_group_request_user_avatar_thumb(); ?>
					<h4><?php bp_group_request_user_link(); ?> <span class="comments"><?php bp_group_request_comment(); ?></span></h4>
					<span class="activity"><?php bp_group_request_time_since_requested(); ?></span>

					<?php do_action( 'bp_group_membership_requests_admin_item' ); ?>

					<div class="action">

						<?php bp_button( array( 'id' => 'group_membership_accept', 'component' => 'groups', 'wrapper_class' => 'accept', 'link_href' => bp_get_group_request_accept_link(), 'link_title' => __( 'Accept', 'bp-magic' ), 'link_text' => __( 'Accept', 'bp-magic' ) ) ); ?>

						<?php bp_button( array( 'id' => 'group_membership_reject', 'component' => 'groups', 'wrapper_class' => 'reject', 'link_href' => bp_get_group_request_reject_link(), 'link_title' => __( 'Reject', 'bp-magic' ), 'link_text' => __( 'Reject', 'bp-magic' ) ) ); ?>

						<?php do_action( 'bp_group_membership_requests_admin_item_action' ); ?>

					</div>
				</li>

			<?php endwhile; ?>
		</ul>

	<?php else: ?>

		<div id="message" class="info">
			<p><?php _e( 'There are no pending membership requests.', 'bp-magic' ); ?></p>
		</div>

	<?php endif; ?>

	<?php do_action( 'bp_after_group_membership_requests_admin' ); ?>

<?php endif; ?>

<?php do_action( 'groups_custom_edit_steps' ) // Allow plugins to add custom group edit screens ?>

<?php /* Delete Group Option */ ?>
<?php if ( bp_is_group_admin_screen( 'delete-group' ) ) : ?>

	<?php do_action( 'bp_before_group_delete_admin' ); ?>

	<div id="message" class="warning">
		<p><?php _e( 'WARNING: Deleting this group will completely remove ALL content associated with it. There is no way back, please be careful with this option.', 'bp-magic' ); ?></p>
	</div>

	<label><input type="checkbox" name="delete-group-understand" id="delete-group-understand" value="1" onclick="if(this.checked) { document.getElementById('delete-group-button').disabled = ''; } else { document.getElementById('delete-group-button').disabled = 'disabled'; }" /> <?php _e( 'I understand the consequences of deleting this group.', 'bp-magic' ); ?></label>

	<?php do_action( 'bp_after_group_delete_admin' ); ?>

	<div class="submit">
		<input type="submit" disabled="disabled" value="<?php _e( 'Delete Group', 'bp-magic' ); ?>" id="delete-group-button" name="delete-group-button" />
	</div>

	<?php wp_nonce_field( 'groups_delete_group' ); ?>

<?php endif; ?>
</div><!-- admin body -->
<?php /* This is important, don't forget it */ ?>
	<input type="hidden" name="group-id" id="group-id" value="<?php bp_group_id(); ?>" />

<?php do_action( 'bp_after_group_admin_content' ); ?>

</form><!-- #group-settings-form -->

