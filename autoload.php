<?php
/**
 * Oirë URL-safe Base64 handling
 * PSR-4 compatible autoloader
 */
spl_autoload_register(function($class) {
	// Project-specific namespace prefix
	$prefix = "Oire";

	// Base directory for the namespace prefix
	$baseDir = __DIR__."/src/";

	// Does the class use the namespace prefix?
	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		// no, move to the next registered autoloader
		return;
	}

	// Get the relative class name
	$relativeClass = substr($class, $len);

	// Replace the namespace prefix with the base directory, replace namespace separators with directory separators in the relative class name, append with .php
	$file = $baseDir . str_replace(["\\", "_"], "/", $relativeClass) . ".php";

	// If the file exists, require it
	if (file_exists($file)) {
		require $file;
	}
});

if (file_exists(__DIR__ . "/vendor/autoload.php")) {
	include_once __DIR__ . '/vendor/autoload.php';
}
?>