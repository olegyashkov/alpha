<?php

$sql = '
	SELECT *
	FROM `menu_items`
	 ';

	 $result = mysqli_query($db, $sql);

     if(!empty($_GET['id']) )
    {
        $id = (int)($_GET['id'] ?? 0);
        $action = $_GET['action'] ?? false;
        if($action =='delete')
        {
            $sql = "
                DELETE 
                FROM `menu_items` 
                WHERE `id` = '{$id}'
            ";
           $result = mysqli_query($db, $sql); 
        }

    }
?>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <td>id</td>
            <td>parent_id</td>
            <td>title</td>
            <td>link</td>
            <td>order</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    	<?php while ($row = mysqli_fetch_assoc($result)): ?>
    
    	
        <tr>
            <td><?=$row['id'] ?></td>
            <td><?=$row['parent_id'] ?></td>
            <td><?=$row['title'] ?></td>
            <td><?=$row['link'] ?></td>
            <td><?=$row['ord'] ?></td>
            <td>
            	<a href="index.php?page=menu_items_form&id=<?=$row['id'] ?>">изменить</a>
            	<a href="index.php?page=menu_items&id=<?=$row['id'] ?>&action=delete">удалить</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
 