<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

?><div class="county-program-contact">
	<h2>Program Contact Info</h1>
	<div class="county-program-icon-wrapper">
		<select id="county-program-icon" name="_cahnrswp_program_icon" class="cahnrswp-program-icon">
			<option value="">(Icon)</option>
			<?php foreach ( $program_icons as $name => $url ) : ?>
				<option value="<?php echo esc_attr( $url ); ?>" <?php selected( $program_icon, $url ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="county-program-contact-wrapper">
		<p><strong>Specialist Contact Information</strong></p>
		<div class="cahnrswp-program-contact-info">
			<div class="county-program-field">
				<label for="cahnrswp-program-specialist">Name, Title</label>
				<input type="text" name="_cahnrswp_program_specialist" id="cahnrswp-program-specialist" class="widefat" value="<?php echo esc_html( $program_contact_name ); ?>" />
			</div>
			<div class="county-program-field half">
				<label for="cahnrswp-program-phone">Phone (xxx) xxx-xxxx</label>
				<input type="text" name="_cahnrswp_program_phone" id="cahnrswp-program-phone" class="widefat" value="<?php echo esc_html( $program_contact_phone ); ?>" />
			</div>
			<div class="county-program-field half">
				<label for="cahnrswp-program-email">Email</label>
				<input type="text" name="_cahnrswp_program_email" id="cahnrswp-program-email" class="widefat" value="<?php echo esc_html( $program_contact_email ); ?>" />
			</div>
		</div>
	</div>
	<div id="cahnrswp-program-boilerplate"></div>
</div>
