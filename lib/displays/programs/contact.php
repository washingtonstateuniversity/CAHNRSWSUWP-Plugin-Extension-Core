<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

?><div class="program-contact">
<?php if ( ! empty( $program_contact['icon'] ) ) : ?><img src="<?php echo esc_url( ecore_get_plugin_url( 'lib/images/' . esc_html( $program_contact['icon'] ) . '.png' ) ); ?>" height="75" width="75" class="extension-program-icon" /><?php endif; ?>
	<div class="program-contact-info"><?php if ( ! empty( $program_contact['name'] ) ) : ?>Program Contact: <?php echo esc_html( $program_contact['name'] ); ?><br /><?php endif; ?>
	<?php if ( ! empty( $program_contact['phone'] ) ) : ?><?php echo esc_html( $program_contact['phone'] ); ?><?php endif; ?>
	<?php if ( ! empty( $program_contact['email'] ) ) : ?>  &bull;  <a href="mailto:<?php echo esc_attr( $program_contact['email'] ); ?>"><?php echo esc_html( $program_contact['email'] ); ?></a><?php endif; ?>
</div></div>
