<?php
if ($argc != 3)
	die('Too few arguments.');

$sourceFilename = trim($argv[1]);
$destinationFilename = trim($argv[2]);

if (!is_file($argv[1]))
	die($argv[1].' is not a file.');

echo "S1/9\n";
echo exec('git mv "'.$sourceFilename.'" "'.$destinationFilename.'"');
echo "S2/9\n";
echo exec('git commit -m "Move 1"');

echo "S3/9\n";
$savedRevision = trim(exec('git rev-parse HEAD'));
echo exec('git reset --hard HEAD~1 ');
echo "S4/9\n";
echo exec ('git mv "'.$sourceFilename.'" copy');
echo "S5/9\n";
echo exec('git commit -m "Move 2"');

echo "S6/9\n";
echo exec('git merge '.$savedRevision);
echo "S7/9\n";
echo exec( 'git commit -a -m "Move 3"');

echo "S8/9\n";
echo exec ('git mv copy "'.$sourceFilename.'"');
echo "S9/9\n";
echo exec('git commit -m "Copied '.$sourceFilename.' to '.$destinationFilename.' with maintained history."');