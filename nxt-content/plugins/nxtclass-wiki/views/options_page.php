<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2><?php _e('NXTClass Wiki Options'); ?></h2>
	<form action="options.php" method="post">
		
	<?php settings_fields('nxtw_options_group'); ?>
		<table class="form-table">
	
	<?php 
		//If we need upgrading...
		
		if( $this->upgrade_check() & $nxtw_options['nxtw_upgrade'] != 'do_upgrade') {
			echo '<p>'.__('An older version of NXTClass Wiki was detected. Before using NXTClass Wiki, you\'ll need to upgrade your existing installation.').'</p>';
			if ($nxt_version >= 3.0) {
				echo '<p>'.__('Your old Wiki pages will be upgraded to custom post types and placed in the trash.').'</p>';
			}
			echo '<p><strong>'.__('WARNING: YOU CANNOT UNDO THIS ACTION. BACK UP YOUR DATA BEFORE UPGRADING!').'</strong></p>';
			echo '<input type="hidden" name="nxtw_options[nxtw_upgrade]" value="do_upgrade" />';
			echo '<input type="submit" value="Upgrade!" />';
		}
		
		//OK, now we're upgrading...
		
		elseif ( $nxtw_options['nxtw_upgrade'] == 'do_upgrade')  {
			$this->upgrade();
		} else {
		
		//If not...
	?>	
		
			<tr valign="top">
				<th scope="row">
				<?php _e('Number of revisions'); ?>
				<p><em><?php _e('Number of revisions to show on the \'View History\' page'); ?></em></p>
				</th>
				<td>
					<input type="text" name="nxtw_options[number_of_revisions]" 
						value="<?php echo $nxtw_options['number_of_revisions']; ?>" />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
				<?php _e('Show Table of Contents on front page'); ?>
				<p><em><?php _e('Whether to show the Table of Contents (if it\'s enabled) on your site\'s index page if a Wiki page is displayed on it.'); ?></em></p>
				</th>
				<td><input type="checkbox" name="nxtw_options[show_toc_on_front_page]" <?php $this->check_option($nxtw_options, 'show_toc_on_front_page', "1"); ?> value="1" /></td>
			</tr>
			
			<tr valign="top">
				<th scope="row">
				<?php _e('Email notification'); ?>
				<p><em><?php _e('Notify administrators when wiki pages are edited'); ?></em></p>
				</th>
				<td><input type="checkbox" name="nxtw_options[email_admins]" <?php $this->check_option($nxtw_options, 'email_admins', "1"); ?> value="1" /></td>
			</tr>
			
			<tr valign="top">
				<th scope="row">
				<?php _e('Weekly email notification'); ?>
				<p><em><?php _e('Send weekly email to admins with most recent changes to Wikis'); ?></em></p>
				</th>
				<td><input type="checkbox" name="nxtw_options[cron_email]" <?php $this->check_option($nxtw_options, 'cron_email', "1"); ?> value="1" /></td>
			</tr>
			
			<tr valign="top">
				<th scope="row">
				<?php _e('Restrict editing to logged in users'); ?>
				<p><em><?php _e('Only allow logged in users to make changes to wiki pages'); ?></em></p>
				</th>
				<td><input type="checkbox" name="nxtw_options[restrict_edits]" <?php $this->check_option($nxtw_options, 'restrict_edits', "1"); ?> value="1" /></td>
			</tr>
			
			<!--tr valign="top">
				<th scope="row">
					Submit revisions for review before publishing
					<p><em>Check this box if you want to review edits submitted
					to your wiki pages before making them live on the site.</em></p>
				</th>
				
				<td><input type="checkbox" name="nxtw_options[revision_pending]" <?php $this->check_option($nxtw_options, "revision_pending", "true"); ?> value="true" /></td>
			</tr-->
			
		<input type="hidden" name="nxtw_options[nxtw_upgrade]" value="done_gone_and_upgraded" />

		<tr>
			<td><input class="button-primary" type="submit" value="Update Options" /></td>
		</tr>
<?php } //end upgrade conditional thingy ?>
		</table>

	</form>
</div>