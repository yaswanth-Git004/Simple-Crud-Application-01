<?php
    require_once("backend/utilities.php");

   function pagination_query($totalposts,$query,$conn,&$pagination_info,$bindvalues = []){
        $posts_per_page = 6;
        $total_pages = ceil($totalposts / $posts_per_page);

        $page = isset($_GET["page_no"]) ? ((int)$_GET["page_no"]) : 1;
        $page = max(1, min($page, $total_pages));
        
        $starting_page = ($page-1) * $posts_per_page; 

        $pagination_info['page'] = $page;
        $pagination_info['total_pages'] = $total_pages;

        $array1 = [
            ":start" => (int)$starting_page,  
            ":end" => (int)$posts_per_page  
        ];

        $bindvalues = array_merge($array1, $bindvalues);
        $posts = getPosts($query, $conn, $bindvalues);

         if ($page == 1) {
            $pagination_info['start'] = 1;
            $pagination_info['end'] = min(3, $total_pages);
        } elseif ($page == $total_pages) {
            $pagination_info['start'] = max(1, $total_pages - 2);
            $pagination_info['end'] = $total_pages;
        } elseif($page == $total_pages-1){
            $pagination_info['start'] = $page-1;
            $pagination_info['end'] = $total_pages;
        }else {
            $pagination_info['start'] = $page-1;
            $pagination_info['end'] = $page + 1;
        }

        return $posts;
   }
   
?>