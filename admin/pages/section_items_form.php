<?php


$id = (int)($_GET['id'] ?? 0);
$action = $_GET['action'] ?? false;

if($action == 'save')
{
    $img_class = (int) $_POST['img_class'];
    $title = (string) $_POST['title'];
    $subtitle = (string) $_POST['subtitle'];

    if(strlen($title) > 250)
        die('too long title');
    else
    {
        if($id){
        $sql ="
            UPDATE `section_img`
            SET 
                `img_class` ='{$img_class}',
                `title_en` = '{$title}',
                `subtitle_en` = '{$subtitle}'
            WHERE `id` = '{$id}'

        ";
        $result = mysqli_query($db, $sql);
        }
        else
        {
            $sql = "
                INSERT INTO `section_img`
                (`img_class`, `title_en`, `subtitle_en`)
                VALUES ('{$img_class}' , '{$title}','{$subtitle}')
            ";
            $result = mysqli_query($db, $sql);
            header('Location: index.php?page=section_items');
        }
    }
}

if($id) {

$handler = 'index.php?page=section_items_form&id='.$id.'&action=save';
$sql = "
	SELECT `img_class`, `title_en`, `subtitle_en`
	FROM `section_img`
    WHERE `id` ='{$id}'
	 ";
    

	 $result = mysqli_query($db, $sql);

     $row = mysqli_fetch_assoc($result);

     
}
else
{
    $handler = 'index.php?page=section_items_form&action=save';
    $row = [
        'img_class' => '',
        'title_en' => '',
        'subtitle_en' => ''
        
    ];
}
?>
<form method="post" action="<?=$handler ?>">
    <input type="text" name="img_class" placeholder="image class" value="<?=$row['img_class'] ?>">
    <input type="text" name="title" placeholder="Title" value="<?=$row['title_en'] ?>">
    <input type="text" name="subtitle" placeholder="subtitle" value="<?=$row['subtitle_en'] ?>">
    <button type="submit">Сохранить</button>
</form>