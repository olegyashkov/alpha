<?php

/**
* 
*/
class Template
{

	static public function render_header($user_params = [])
	{
		$params = [
		'title' => PROGECT_TITLE,
		'is_home' => false,
		'menu_active_item' => 'home'
		];
		$params = array_merge($params, $user_params);

		include PATH_PARTIALS.'header.php';
	}

	
	static public function render_footer(){
		include PATH_PARTIALS.'footer.php';
	}

	
	static public function render_menu()
	{
	// global $db;
	ini_set('display_errors', '1');
	error_reporting(E_ALL);

	$sql = '
		SELECT * 
		FROM `menu_items`
		ORDER BY `ord` ASC
	';	
	$result = Db::$instance->query($sql);

	$items = [];
	while($row = $result->fetch_assoc())
	{
		$items[$row['id']] = $row;
	}

	$result = self::build_menu_items($items);

	foreach ($result as $elems) {
				
		if(isset($elems['children']) and !empty($elems['children']))
		{
			foreach ($elems['children'] as $elem) 
			{
				if(!isset($elem['children']))
				{ 
				$nav ='';
				$nav ='<li><a href="generic.html">'.$elem['title'].'</a></li>';
				echo $nav;
				}
				else//(isset($elem['children']))
				{
					$nav = '<li><a href ="#">'.$elem['title'].'</a><ul>';
						// echo $nav;
					foreach ($elem['children'] as $subelem) 
					{
						
						 $nav .= '<li><a href="#">'.$subelem['title'].'</a></li>';
						 

					}
					$nav .= '</ul></li>';
					echo $nav;

					
				}
				
				
				
			}
		}	
	}
			
	

	// 
}



static protected function build_menu_items($items, $parent_id = 0)
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
				$item['children'] = self::build_menu_items($items, $id);
					

			$return[] = $item;
		}
	}

	return $return;
	
}
}


