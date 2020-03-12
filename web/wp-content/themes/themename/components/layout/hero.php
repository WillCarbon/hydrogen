<?php

    $heading = '';

    if ( is_singular() ) {

        $heading = get_the_title();

    } elseif ( !is_home() ) {

        $heading = get_the_archive_title();

    }

?>

<h1><?php $heading; ?></h1>
