<?php

/**
 * This is a file of helper functions.
 *
 * Right now, it only exists because the built in handling
 * for URL generation in Dingo is horrible, and I wanted
 * an at least reasonable solution to use
 */

function getRoute($version, $name, $parameters) {
    return app('Dingo\Api\Routing\UrlGenerator')->version($version)->route($name, $parameters);
}
