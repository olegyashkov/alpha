<?php

/**
* 
*/
class HomeFeatures
{
	
	// static public function get()
	// {
	// 	$msql = '
	// SELECT *
	// FROM `section_img`
	// ';

	// $res = Db::$instance->query($msql);
	// $counter = mysqli_num_rows($res);

	

	// $items = [];
	// while($row2 = $res->fetch_assoc())
	// {
	// 	$items[] = $row2;
	// }
		//return $items;
		//return $res;
	// }

	static public function render()
	{
				$msql = '
	SELECT *
	FROM `section_img`
	';

	$res = Db::$instance->query($msql);
	$counter = mysqli_num_rows($res);

	

	$items = [];
	while($row2 = $res->fetch_assoc())
	{
		$items[] = $row2;
	}
		//$items = self::get();
		
		// $res = Db::$instance->query($msql);
		 //$counter = mysqli_num_rows($res);

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
}