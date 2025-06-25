<?php
require_once("backend/dbConnection.php");
require_once("backend/utilities.php");
require_once("pagination.php");

$total_pages = 0;

if(isset($_GET['search_button'])){
    if(!empty($_GET["search"])){   
        $posts_per_page = 6;
        $search=$_GET['search'];
     
        $query="select count(*) as total from posts where lower(title) like lower(:searcH) or lower(content) like lower(:searcH)";
        $bindvalues = [":searcH" => '%' . $search . '%'];
        $total_posts = getTotalPosts($query,$conn,$bindvalues);

        $query = "select * from posts where lower(title) like lower(:searcH) or lower(content) like lower(:searcH) limit :start, :end";
        $pagination_info = [];

        $results = pagination_query($total_posts,$query, $conn,$pagination_info,$bindvalues);
        $page=$pagination_info['page'];
        $total_pages = $pagination_info["total_pages"];
        $start = $pagination_info['start'];
        $end = $pagination_info['end'];

    }else{
            header("Location: index.php");
            exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php
include_once "nav.php";
if($total_posts > 0){?>
    <div class="container">
       <div class="wrapper">
         <?php
            foreach($results as $result){
         ?>
            <div class="post-container flex-box flex-col">
                <div class="post-img">
                    <img src="https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=" alt="post-image">
                </div>
                <div class="post-content flex-box flex-col">
                    <h3 class="post-title"><?php echo $result['title']?></h3>
                    <p class="post-description"><?php echo substr($result['content'],0, 150).'...'?></p>
                </div>
                <div class="post-btns flex-box content-center">
                    <a href="view.php?id=<?php echo $result['id'];?>"><button class="btn">view</button></a>
                </div>
            </div>
         <?php } ?>
        </div>
    </div>

    <div class="pagination">
            <a class="btn" href="?search=<?php echo urlencode($search); ?>&search_button=Search&page_no=1">first</a>

            <a class="btn" href="?search=<?php echo urlencode($search); ?>&search_button=Search&page_no=<?php echo $page > 1 ? $page - 1 : 1; ?>"><span class="arrow-icon">&laquo;</span> <span class="page-btn-text">Previous</span></a>

            <div class="page_buttons">
                <?php for($i = $start; $i<= $end; $i++) {
                $activeClass = ($i == $page) ? 'active' : "";    
                ?>
                    <a href="?search=<?php echo urlencode($search);?>&search_button=Search&page_no=<?php echo $i;?>" class="<?php echo $activeClass?>"><span class="page_btn"><?php echo $i?></span></a>
                <?php } ?>
            </div>

            <a class="btn" href="?search=<?php echo urlencode($search); ?>&search_button=Search&page_no=<?php echo $page < $total_pages ? $page + 1 : $total_pages; ?>"><span class="page-btn-text">Next</span> <span class="arrow-icon">&raquo;</span></a>

            <a class="btn" href="?search=<?php echo urlencode($search); ?>&search_button=Search&page_no=<?php echo $total_pages; ?>">last</a>
        </div>

        <?php
    }else{  ?>
            <div class="flex-box content-center">
                <h1>not found</h1>
            </div>
        <?php
        }?>
</body>
</html>