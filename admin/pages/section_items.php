<?php

$sql = '
	SELECT *
	FROM `section_img`
	 ';

	 $result = mysqli_query($db, $sql);
?>
<table border="1" style="width: 100%">
    <thead>
        <tr>
            <td>id</td>
            <td>img_class</td>
            <td>title_en</td>
            <td>subtitle_en</td>
            <!-- <td>title_ru</td> -->
            <!-- <td>subtitle_ru</td> -->
        </tr>
    </thead>
    <tbody>
    	<?php while ($row = mysqli_fetch_assoc($result)): ?>
    
    	
        <tr>
            <td><?=$row['id'] ?></td>
            <td><?=$row['img_class'] ?></td>
            <td><?=$row['title_en'] ?></td>
            <td><?=$row['subtitle_en'] ?></td>
            
            <td>
            	<a href="index.php?page=section_items_form&id=<?=$row['id'] ?>">изменить</a>
            	<a href="#">удалить</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
 