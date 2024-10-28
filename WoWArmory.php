<?php
if ( function_exists( 'wfLoadExtension' ) ) {
    wfLoadExtension( 'WoWArmory' );
    wfWarn(
        'Deprecated PHP entry point used for the CopyLink extension. ' .
        'Please use wfLoadExtension instead, ' .
        'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
    );
    return;
} else {
    die( 'This version of the WoWArmory extension requires MediaWiki 1.25+' );
}
