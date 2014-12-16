<?php

/* Categories */
$categories_obj = get_categories('orderby=id&order=asc');
foreach ($categories_obj as $cat) {
	$cats_arr[$cat->cat_ID] =  $cat->cat_name . ' ('. $cat->count .')';
}

/* Order by */
$orderby_arr = array(
	'' => 'Default', 
	'title'=>'Title',
	'date'=>'Date',
	'rand'=>'Random',
	'post__in'=>'Posts IDs included',
	'comment_count'=>'Comment count'
);

/* Order */
$order_arr = array(
	'DESC' => 'Descending', 
	'ASC'=>'Ascending'
);
