<?php
class Helper extends Prefab {

/* Limit Desc */
function crop($string,$length,$dots = "...") {
return (strlen($string) > $length) ? mb_strcut($string, 0, $length - strlen($dots)) . $dots : $string;
}

/* Strip Tags */
function striptags($val){
return strip_tags($val);
}

/* Strip Slashes */
function remove_slash($val){
return stripslashes($val);
}

/* Remove WhiteSpaces */
function remove_spaces($string){
return trim($string);
}

/* Replace Hashtag, Mentions, Emoji */
function replace_data($string){
$home_url = Base::instance()->get("home_url");

$patterns = array(
"/:(.*?):/i", //Emoji
"/@(\w+)/", // Mentions
"/#(\w+)/" // Hashtag
);

$replacements = array(
"<i class=\"twa twa-lg twa_$1\" title=\"$0\"></i>", //Emoji
"<a href=\"$home_url/$1\">@$1</a>",
"<a href=\"$home_url/hashtag/$1\">#$1</a>"
);

return preg_replace($patterns,$replacements,$string);
}

}