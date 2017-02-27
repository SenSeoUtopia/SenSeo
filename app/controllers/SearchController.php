<?php
class SearchController extends Controller{

protected $tpl = 'layouts/base.htm';

// Search Page
public function search($f3,$args){

$keyword = ($f3->get('GET.s')) ? $f3->get('GET.s') : $args['keyword'];

if($f3->get('GET.s')){
$f3->reroute("/search/$keyword");	
}

if(isset($keyword)){

$title = "Search Results for <q>$keyword</q>";

$home_url = $this->home_url;

/* Get Series List from Database */

$article = new Manga($this->db);

$limit = 40;
$page = Pagination::findCurrentPage();


$subset = $article->paginate($page-1, $limit,array('title like ? or alt_name like ?',"%$keyword%","%$keyword%"),array('order' => 'title'));

// build page links
$pages = new Pagination($subset['total'], $subset['limit']);

$pages->setLinkPath("search/$keyword/page/");

// add some configuration if needed
$pages->setTemplate('pagebrowser.html');
// for template usage, serve generated pagebrowser to the hive
$f3->set('pagebrowser', $pages->serve());

} else {
$title = " Search";
}

$total_results = $subset['total'];

$f3->set('manga_list', $subset);

$f3->set ('search_keyword',$keyword);
/* Set Content */
$f3->set('page', array('title'=> $title,'content' => 'search.htm','total_results' => $total_results));

}

// Search by Completed
public function search_completed($f3){
$title = "Manga List - Completed Series List";

/* Get Series List from Database */
$article = new Manga($this->db);

$limit = 40;
$page = Pagination::findCurrentPage();

$subset = $article->paginate($page-1, $limit,array('status = 4'),array('order' => 'title'));

$total_results = $subset['total'];

// build page links
$pages = new Pagination($subset['total'], $subset['limit']);

$pages->setLinkPath("search/status/completed/page/");

// add some configuration if needed
$pages->setTemplate('pagebrowser.html');
// for template usage, serve generated pagebrowser to the hive
$f3->set('pagebrowser', $pages->serve());

$f3->set('manga_list', $subset);

$f3->set('series_status',true);

/* Set Content */
$f3->set('page', array('title'=> $title,'content' => 'search.htm','total_results' => $total_results));
}

// Search by Ongoing
public function search_ongoing($f3){
	
$title = "Manga List - Ongoing Series List";	
	
/* Get Series List from Database */

$article = new Manga($this->db);

$limit = 40;
$page = Pagination::findCurrentPage();


$subset = $article->paginate($page-1, $limit,array('status = 1'),array('order' => 'title'));

$total_results = $subset['total'];

// build page links
$pages = new Pagination($subset['total'], $subset['limit']);

$pages->setLinkPath("search/status/ongoing/page/");

// add some configuration if needed
$pages->setTemplate('pagebrowser.html');
// for template usage, serve generated pagebrowser to the hive
$f3->set('pagebrowser', $pages->serve());

$f3->set('manga_list', $subset);

$f3->set('series_status',true);

/* Set Content */
$f3->set('page', array('title'=> $title,'content' => 'search.htm','total_results' => $total_results));
}

// Search by Last Update
public function search_last_update($f3){

$title = "Recently Updated Series List";	
	
/* Get Series List from Database */

$article = new Manga($this->db);

$limit = 40;
$page = Pagination::findCurrentPage();

$subset = $article->paginate($page-1, $limit,null,array('order' => 'last_update desc'));

$total_results = $subset['total'];

// build page links
$pages = new Pagination($subset['total'], $subset['limit']);

$pages->setLinkPath("search/status/updated/page/");

// add some configuration if needed
$pages->setTemplate('pagebrowser.html');
// for template usage, serve generated pagebrowser to the hive
$f3->set('pagebrowser', $pages->serve());

$f3->set('manga_list', $subset);

$total_results = $subset['total'];

$f3->set('series_status',true);

/* Set Content */
$f3->set('page', array('title'=> $title,'content' => 'search.htm','total_results' => $total_results));
}

// Search by New Series
public function search_new_series($f3){

$title = "New Added Series List";	
	
/* Get Series List from Database */

$article = new Manga($this->db);

$limit = 40;
$page = Pagination::findCurrentPage();


$subset = $article->paginate($page-1, $limit,null,array('order' => 'id desc'));

$total_results = $subset['total'];

// build page links
$pages = new Pagination($subset['total'], $subset['limit']);

$pages->setLinkPath("search/status/new/page/");

// add some configuration if needed
$pages->setTemplate('pagebrowser.html');
// for template usage, serve generated pagebrowser to the hive
$f3->set('pagebrowser', $pages->serve());

$f3->set('manga_list', $subset);

$f3->set('series_status',true);

/* Set Content */
$f3->set('page', array('title'=> $title,'content' => 'search.htm','total_results' => $total_results));
}

}