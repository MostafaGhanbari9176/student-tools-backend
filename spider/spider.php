<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 19/09/2019
 * Time: 04:27 AM
 */

$url = "https://www.isna.ir/archive?tp=5";
$html = file_get_contents($url);
$d = new DOMDocument();
$d->loadHTML($html); // the variable $ads contains the HTML code above
$xpath = new DOMXPath($d);
$itemList = $xpath->query('//div[@class="items"]');
var_dump($itemList);

$newsDoc = new DOMDocument();
$cloned = $itemList[0]->cloneNode(TRUE);
$newsDoc->appendChild($newsDoc->importNode($cloned, True));
$xpath = new DOMXPath($newsDoc);

$newsItemList = $xpath->query("//li");

foreach($newsItemList as $newsItem)
{

}

//$ad_title = trim($ad_title_tag->item(0)->nodeValue);

var_dump($item->item(0));

//echo json_encode(array("url" => $ad_url, "title" => $ad_title, "image" => $ad_image));

