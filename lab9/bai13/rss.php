<?php
require '../includes/app.php'; $news=query('SELECT * FROM news ORDER BY id DESC')->fetchAll();
$host=$_SERVER['HTTP_HOST']??'localhost'; if(!preg_match('/^[a-zA-Z0-9.\-]+(:\d+)?$/',$host)) $host='localhost';
$base=(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off'?'https':'http').'://'.$host.rtrim(dirname($_SERVER['SCRIPT_NAME']),'/');
$xml=new DOMDocument('1.0','UTF-8'); $xml->formatOutput=true;
$rss=$xml->appendChild($xml->createElement('rss')); $rss->setAttribute('version','2.0'); $channel=$rss->appendChild($xml->createElement('channel'));
function element($parent,$name,$text) { global $xml; $node=$parent->appendChild($xml->createElement($name)); $node->appendChild($xml->createTextNode($text)); }
element($channel,'title','Thực hành PHP Lab 9'); element($channel,'link',$base.'/index.php'); element($channel,'description','Các bài thực hành PHP và MySQL'); element($channel,'language','vi');
foreach($news as $row) {
    $item=$channel->appendChild($xml->createElement('item'));
    $link=preg_match('~^https?://~i',$row['link'])?$row['link']:$base.'/'.$row['link'];
    element($item,'title',$row['title']); element($item,'link',$link); element($item,'description',$row['description']); element($item,'guid',$link);
}
header('Content-Type: application/rss+xml; charset=UTF-8'); echo $xml->saveXML();
