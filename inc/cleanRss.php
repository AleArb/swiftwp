<?php

namespace Swift\CleanRss;

// Remove the WordPress version from RSS feeds
add_filter('the_generator', '__return_false');