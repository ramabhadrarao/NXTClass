<?php

/**
 * Sends HTTP request
 *
 * @param $url string
 * @param $args array
 * @return nxt_Error|array
 */
function w3_http_request($url, $args = array()) {
    $args = array_merge(array(
        'user-agent' => W3TC_POWERED_BY
    ), $args);

    return nxt_remote_request($url, $args);
}

/**
 * Sends HTTP GET request
 *
 * @param string $url
 * @param array $args
 * @return array|nxt_Error
 */
function w3_http_get($url, $args = array()) {
    $args = array_merge($args, array(
        'method' => 'GET'
    ));

    return w3_http_request($url, $args);
}

/**
 * Downloads URL into a file
 *
 * @param string $url
 * @param string $file
 * @return boolean
 */
function w3_download($url, $file) {
    if (strpos($url, '//') === 0) {
        $url = (w3_is_https() ? 'https:' : 'http:') . $url;
    }

    $response = w3_http_get($url);

    if (!is_nxt_error($response) && $response['response']['code'] == 200) {
        return @file_put_contents($file, $response['body']);
    }

    return false;
}

/**
 * Returns upload info
 *
 * @return array
 */
function w3_upload_info() {
    static $upload_info = null;

    if ($upload_info === null) {
        $upload_info = @nxt_upload_dir();

        if (empty($upload_info['error'])) {
            $parse_url = @parse_url($upload_info['baseurl']);

            if ($parse_url) {
                $baseurlpath = (!empty($parse_url['path']) ? trim($parse_url['path'], '/') : '');
            } else {
                $baseurlpath = 'nxt-content/uploads';
            }

            $upload_info['baseurlpath'] = '/' . $baseurlpath . '/';
        } else {
            $upload_info = false;
        }
    }

    return $upload_info;
}
