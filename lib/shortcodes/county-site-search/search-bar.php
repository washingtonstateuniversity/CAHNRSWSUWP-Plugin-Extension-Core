<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

?><form role="search" method="get" class="cahnrs-search" action="<?php echo esc_url( home_url( '/' ) ); ?>"><label><span class="screen-reader-text">Search for:</span><input type="search" class="cahnrs-search-field" placeholder="Search" value="<?php echo esc_html( get_search_query() ); ?>" name="s" title="Search for:" /></label><input type="submit" class="cahnrs-search-submit" value="$" /></form>
