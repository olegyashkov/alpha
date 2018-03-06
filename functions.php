<?php

function render_header($user_params = [])
{
	$params = [
	'title' => PROGECT_TITLE,
	'is_home' => false,
	'menu_active_item' => 'home'
	];
	$params = array_merge($params, $user_params);

	include PATH_PARTIALS.'header.php';
}

function render_footer(){
	include PATH_PARTIALS.'footer.php';
}

function render_menu()
{
	global $db;
	ini_set('display_errors', '1');
	error_reporting(E_ALL);

	$sql = '
		SELECT * 
		FROM `menu_items`
		ORDER BY `ord` ASC
	';	
	$result = mysqli_query($db, $sql);

	$items = [];
	while($row = mysqli_fetch_assoc($result))
	{
		$items[$row['id']] = $row;
	}

	$result = build_menu_items($items);

	foreach ($result as $elems) {
				
		if(isset($elems['children']))
		{
			foreach ($elems['children'] as $elem) {
				$nav ='';
				$nav ='<li><a href="generic.html">'.$elem['title'].'</a></li>';
				echo $nav;
				if(isset($elem['children']))
				{
					$nav = '<ul>';
					foreach ($elem['children'] as $subelem) 
					{
						
						 $nav .= '<li><a href="#">'.$subelem['title'].'</a></li>';
						 

					}
					$nav .= '</ul>';
					echo $nav;

					
				}
				
				
			}
		}	
	}
			
	

	// 
}



function build_menu_items($items, $parent_id = 0)
{
	$return = [];

	foreach($items as $id => $item)
	{
		
		if($item['parent_id'] == $parent_id)
		{
			$has_children = false;
			foreach($items as $child_item)
			{

				if($id == (int)$child_item['parent_id'])
				{
					$has_children = true;
					break;
				}
			}

			if($has_children)
				$item['children'] = build_menu_items($items, $id);
					

			$return[] = $item;
		}
	}

	return $return;
	
}

function render_section()
{
	global $db;
	$msql = '
	SELECT *
	FROM `section_img`
	';

	$res = mysqli_query($db, $msql);
	$counter = mysqli_num_rows($res);

	$items = [];
	while($row2 = mysqli_fetch_assoc($res))
	{
		$items[] = $row2;
	}

	// echo '<pre>';
	// var_dump($items);
	// echo '</pre>';
	$i = 0;
	foreach ($items as $item ) { 
		$block ='';
		$block ='<section><span class="icon major '.$item['img_class'].'">'.'</span>';
		$block .='<h3>'.$item['title_en'].'</h3>';
		$block .='<p>'.$item['subtitle_en'].'</p></section>';
		if(++$i % 2 == 0 AND $i != $counter)
		{
			$block .= '</div><div class="features-row">';
		}
		if($i == $counter)
		{
			$block .='</div>';
		}

		echo $block;
	 } 
	 
}

//render_menu();