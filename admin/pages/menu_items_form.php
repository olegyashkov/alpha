<?php


$id = (int)($_GET['id'] ?? 0);
$action = $_GET['action'] ?? false;
var_dump($action);

if($action == 'save')
{
    $parent_id = (int) $_POST['parent_id'];
    $title = (string) $_POST['title'];
    $link = (string) $_POST['link'];
    $ord = (int) $_POST['ord'];

    if(strlen($title) > 250)
        die('too long title');
    else
    {
        if($id){
        $sql ="
            UPDATE `menu_items`
            SET 
                `parent_id` ='{$parent_id}',
                `title` = '{$title}',
                `link` = '{$link}', 
                `ord` = '{$ord}'
            WHERE `id` = '{$id}'

        ";
        $result = mysqli_query($db, $sql);
        }
        else
        {
            $sql = "
                INSERT INTO `menu_items`
                (`parent_id`, `title`, `link`, `ord`)
                VALUES ('{$parent_id}' , '{$title}','{$link}','{$ord}')
            ";
            $result = mysqli_query($db, $sql);
            header('Location: index.php?page=menu_items');
        }
    }
}

if($id) {

$handler = 'index.php?page=menu_items_form&id='.$id.'&action=save';
$sql = "
	SELECT *
	FROM `menu_items`
    WHERE `id` ='{$id}'
	 ";
    

	 $result = mysqli_query($db, $sql);
     $row = mysqli_fetch_assoc($result);
     
}
else
{
    $handler = 'index.php?page=menu_items_form&action=save';
    $row = [
        'parent_id' => '',
        'title' => '',
        'link' => '',
        'ord' => ''
    ];
}
?>
<form method="post" action="<?=$handler ?>">
    <input type="number" name="parent_id" placeholder="Parent ID" value="<?=$row['parent_id'] ?>">
    <input type="text" name="title" placeholder="Title" value="<?=$row['title'] ?>">
    <input type="text" name="link" placeholder="Link" value="<?=$row['link'] ?>">
    <input type="number" name="ord" placeholder="Order" value="<?=$row['ord'] ?>">
    <button type="submit">Сохранить</button>
</form>
 