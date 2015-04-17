#!/usr/bin/env php
<?php $header = <<<COMMENT

JSON print_r v201504172014
Louis T. Getterman IV (@LTGIV)
www.GotGetLLC.com | www.opensour.cc/programming/php

Thanks:
http://stackoverflow.com/questions/11968244/php-reading-line-by-line-from-stdin
http://stackoverflow.com/questions/3684367/php-cli-how-to-read-a-single-character-of-input-from-the-tty-without-waiting-f

COMMENT;
$header	=	implode( "\n", array_slice( explode( "\n", trim($header) ), 0, 3) );

// Loop
while(1) {

	system('clear');

	echo "{$header}\n";
	echo str_repeat( '-', 79 )."\n";
	echo "Paste JSON contents in, press CTRL-D (^D) on a newline when finished.\n";
	echo str_repeat( '-', 79 )."\n";
	
	$json	=	'';
	while( $f = fgets(STDIN) ){
		$json	.=	$f;
	} // END WHILE LOOP
	$json	=	trim($json);

	system('clear');
	
	echo "{$header}\n";
	echo str_repeat( '-', 79 )."\n";
	echo "Output in PHP's print_r() format:\n";
	echo str_repeat( '-', 79 )."\n";
	print_r( json_decode($json) );
	echo str_repeat( '-', 79 )."\n";

	// Save existing tty configuration
	$term = `stty -g`;	
	// Make changes to the tty
	system("stty -icanon");

	// Prompt
	echo "Parse more JSON? : ";
	$loopCont	=	fread(STDIN, 1);

	// Reset the tty back to the original configuration
	system("stty '" . $term . "'");

	if ( strtoupper($loopCont) == 'N' ) {
		echo "\n";
		echo str_repeat( '-', 79 )."\n";
		echo "\n";
		break;
	} // END IF

} // END WHILE LOOP
