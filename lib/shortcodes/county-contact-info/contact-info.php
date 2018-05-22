<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

?><div class="county-contact">
	<div class="contact-information">
		<?php if ( $department ) : ?><p class="name"><strong><?php echo esc_html( $department ); ?></strong></p><?php endif; ?>
		<p class="information">
			<?php if ( $address ) : ?><?php echo esc_html( $address ); ?><br /><?php endif; ?>
			<?php if ( $locality ) : ?><?php echo esc_html( $locality ); ?><br /><?php endif; ?>
			<?php if ( $zip_code ) : ?><?php echo esc_html( $zip_code ); ?><br /><?php endif; ?>
			<?php if ( $telephone ) : ?><?php echo esc_html( $telephone ); ?><br /><?php endif; ?>
			<?php if ( 'info@wsu.edu' !== $email ) : ?><a href="mailto:<?php esc_attr( $email ); ?>"><?php esc_html( $email ); ?></a><br /><?php endif; ?>
			<?php if ( $contact_point && $contact_title ) : ?><a href="<?php esc_url( $contact_point ); ?>"><?php esc_html( $contact_title ); ?></a><?php endif; ?>
		</p>
		<?php
		// @codingStandardsIgnoreStart
		echo wpautop( wp_kses_post( $content ) );
		// @codingStandardsIgnoreEnd
		?>
	</div>
	<?php if ( ! empty( $atts['show_map'] ) ) : ?><div class="contact-map"><div id="county-google-map" style="height: 100%; position: absolute; width: 100%;"></div></div><?php endif; ?>
</div>
