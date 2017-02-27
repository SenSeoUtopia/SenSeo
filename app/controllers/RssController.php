<?php
class RssController extends Controller{

// Rss Feed
public function rss_feed($f3){

$home_url = $this->home_url;

$base_dir = $this->base_dir;

$rss_title = $f3->get('site_title');

$data = '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:wfw="http://wellformedweb.org/CommentAPI/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:atom="http://www.w3.org/2005/Atom"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/">
<channel>
<title>'.$rss_title.' - Latest Updates</title>
<description>Recent "Updates" and "Changes" to the Manga and Comics hosted @ '.$rss_title.'</description>
<link>'.$home_url.'</link>
<image>
<title>'.$rss_title.' - Latest Updates</title>
<url>'.$home_url.'/img/logo-full.png</url>
<link>'.$home_url.'</link>
</image>
<language>en</language>
<atom:link href="'.$home_url.'/rss" rel="self" type="application/rss+xml" />
';

$new = new Manga($this->db);

$page = 1;

// Get Latest Releases.

if(file_exists($base_dir)){
	
$dirs = glob("$base_dir/*/*",GLOB_ONLYDIR);
array_multisort(array_map('filemtime', $dirs), SORT_NUMERIC, SORT_DESC, $dirs);

$results_per_page = 240;

$slice = array_slice($dirs,(($page - 1) * $results_per_page), $results_per_page);

foreach($slice as $updated) {

$series = omv_encode(basename(dirname($updated)));

$new->load(array("slug = ? ",$series),array('limit' => 1));

$series_title = !empty($new->title) ? $new->title : omv_decode($series);
$series_id = !empty($new->id) ? $new->id : null;

$chapter = $updated;
$latest = basename($updated);

$date = date ("r", filemtime($chapter));
// Get Title
$pos = strpos($latest, ' - ');
if ($pos === false) {
$chapter_number = $latest;
} else {
$chapter_number = trim(substr($latest, 0, $pos - 0));
}
$chapter_title = omv_decode($latest);
$chapter_number = omv_encode($chapter_number);

$chapter_title = htmlspecialchars($chapter_title);

// Latest Result 
$chapter_url = "$home_url/$series/$chapter_number/1";

$data .= "<item>\r\n";
$data .= "<title>$series Chapter $chapter_title</title>\r\n";

$data .= "<link>$chapter_url</link>\r\n";
$data .= "<description><![CDATA[$series_title Chapter $chapter_number Raw Read Online]]></description>\r\n";
$data .= "<guid>$chapter_url</guid>\r\n";

$data .= "<pubDate>$date</pubDate>\r\n";
$data .= "</item>\r\n";

}

} else {
$results = null;
}
$data .= "</channel>
</rss>";

echo Response::rss($data);
}

// Series Rss Feed
public function rss_feed_series($f3,$args){
	
$home_url = $this->home_url;	
	
$series_slug = $args['series_slug'];

$rss_title = $f3->get('site_title');

$get_chapters = new Chapter($this->db);

$get_chapter_list = $get_chapters->chapter_drop_down($series_id);

$chapter_list = array();

if(isset($get_chapter_list)){

echo '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
<title>'.$rss_title.' - Latest Updates</title>
<link>'.$home_url.'</link>
<description>Recently Series Updated</description>
';

foreach($get_chapter_list as $chapter){

$chapter_number = $chapter['slg'];
$chapter_title = $chapter['ttl'];
$upload_time = nicetime($chapter['dte_add']);
$chapter_title = isset($chapter_title) ? "$chapter_number - $chapter_title" : $chapter_number;	
	
// Latest Result 
$chapter_list[] = array(
"series_title" => $series_title,
"series_slug" => $series_slug,
"chapter_number" => $chapter_number,
"chapter_title" => $chapter_title,
"last_update" => $upload_time,
"chapter_url" => "$home_url/$series_slug/$chapter_number/"
);

}



} else {
$chapter_list = null;
}

echo Response::rss($chapter_list);
}

}