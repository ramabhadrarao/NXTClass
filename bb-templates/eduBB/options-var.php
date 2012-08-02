<?php
global $bb_option;

foreach ($bb_option as $value) {
if ( bb_get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = bb_get_option( $value['id'] ); } }


?>