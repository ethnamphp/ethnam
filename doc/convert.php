#!/usr/bin/env php
<?php
/**
 * a converter from md to html
 *
 * Usage $0 <md_file> <target_dir>
 */
require_once __DIR__ . '/vendor/autoload.php';


global $argv;
$file = $argv[1];
$targetDir = $argv[2];

// use github markdown

// this is broken
//$parser = new \cebe\markdown\GithubMarkdown();
//echo $parser->parse(file_get_contents($file));

$Parsedown = new Parsedown();
$mdContent = file_get_contents($file);
$html = $Parsedown->text($mdContent);

$html = preg_replace('/\.md/', '.html', $html);
$htmlFile = preg_replace('/\.md$/', '.html', $file);
file_put_contents($targetDir . '/' . $htmlFile, $html);
