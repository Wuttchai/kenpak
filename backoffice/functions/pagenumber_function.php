<?php
/* 
maximun_page() Parameters :: 
	$file_name = "<name-in-html>"
	$file_target = "<String-Path>"
*/
function maximun_page($max_recore, $recore_perpage){
	if($max_recore!="0" OR $max_recore!=""){
		$page = ceil($max_recore/$recore_perpage);
	}else{
		$page = 0;
	}
	return $page;
}

/* 
pagination_number() Parameters :: 
	$file_name = "<name-in-html>"
	$file_target = "<String-Path>"
*/
function pagination_number($maximun_page, $page_now, $link_page, $boostrap_version){
	if($boostrap_version == "3")
	{
		if($page_now=="")
		{
			$page_now = 1;
		}
			echo '<nav aria-label="Page navigation">';
			echo '<ul class="pagination pagination-lg">';
			
		if($page_now<="1")
		{
			echo '<li class="disabled"><span aria-hidden="true">&laquo;</span></li>';
		}else{
			echo '<li><a href="'.$link_page.'&page='.($page_now-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
		}
		
		if($maximun_page=="")
		{
			echo '<li class="disabled"><span aria-hidden="true">1</span></li>';
			echo '<li class="disabled"><span aria-hidden="true">2</span></li>';
			echo '<li class="disabled"><span aria-hidden="true">3</span></li>';
			echo '<li class="disabled"><span aria-hidden="true">4</span></li>';
			echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
		}elseif($maximun_page=="1")
		{
			echo '<li class="active"><span aria-hidden="true">1</span></li>';
			echo '<li class="disabled"><span aria-hidden="true">2</span></li>';
			echo '<li class="disabled"><span aria-hidden="true">3</span></li>';
			echo '<li class="disabled"><span aria-hidden="true">4</span></li>';
			echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
		}elseif($maximun_page=="2")
		{
			if($page_now=="1")
			{
				echo '<li class="active"><span aria-hidden="true">1</span></li>';
				echo '<li><a href="'.$link_page.'&page=2">2</a></li>';
				echo '<li class="disabled"><span aria-hidden="true">3</span></li>';
				echo '<li class="disabled"><span aria-hidden="true">4</span></li>';
				echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
			}else{
				echo '<li><a href="'.$link_page.'&page=1">1</a></li>';
				echo '<li class="active"><span aria-hidden="true">2</span></li>';
				echo '<li class="disabled"><span aria-hidden="true">3</span></li>';
				echo '<li class="disabled"><span aria-hidden="true">4</span></li>';
				echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
			}
		}elseif($maximun_page=="3")
		{
			if($page_now=="1"){
				echo '<li class="active"><span aria-hidden="true">1</span></li>';
				echo '<li><a href="'.$link_page.'&page=2">2</a></li>';
				echo '<li><a href="'.$link_page.'&page=3">3</a></li>';
				echo '<li class="disabled"><span aria-hidden="true">4</span></li>';
				echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
			}elseif($page_now=="2"){
				echo '<li><a href="'.$link_page.'&page=1">1</a></li>';
				echo '<li class="active"><span aria-hidden="true">2</span></li>';
				echo '<li><a href="'.$link_page.'&page=3">3</a></li>';
				echo '<li class="disabled"><span aria-hidden="true">4</span></li>';
				echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
			}else{
				echo '<li><a href="'.$link_page.'&page=1">1</a></li>';
				echo '<li><a href="'.$link_page.'&page=2">2</a></li>';
				echo '<li class="active"><span aria-hidden="true">3</span></li>';
				echo '<li class="disabled"><span aria-hidden="true">4</span></li>';
				echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
			}
		}elseif($maximun_page=="4")
		{
			if($page_now=="1"){
				echo '<li class="active"><span aria-hidden="true">1</span></li>';
				echo '<li><a href="'.$link_page.'&page=2">2</a></li>';
				echo '<li><a href="'.$link_page.'&page=3">3</a></li>';
				echo '<li><a href="'.$link_page.'&page=4">4</a></li>';
				echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
			}elseif($page_now=="2"){
				echo '<li><a href="'.$link_page.'&page=1">1</a></li>';
				echo '<li class="active"><span aria-hidden="true">2</span></li>';
				echo '<li><a href="'.$link_page.'&page=3">3</a></li>';
				echo '<li><a href="'.$link_page.'&page=4">4</a></li>';
				echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
			}elseif($page_now=="3"){
				echo '<li><a href="'.$link_page.'&page=1">1</a></li>';
				echo '<li><a href="'.$link_page.'&page=2">2</a></li>';
				echo '<li class="active"><span aria-hidden="true">3</span></li>';
				echo '<li><a href="'.$link_page.'&page=4">4</a></li>';
				echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
			}else{
				echo '<li><a href="'.$link_page.'&page=1">1</a></li>';
				echo '<li><a href="'.$link_page.'&page=2">2</a></li>';
				echo '<li><a href="'.$link_page.'&page=3">3</a></li>';
				echo '<li class="active"><span aria-hidden="true">4</span></li>';
				echo '<li class="disabled"><span aria-hidden="true">5</span></li>';
			}
		}else
		{
			if($page_now == "1"){
				echo '<li class="active"><span aria-hidden="true">'.$page_now.'</span></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now+1).'">'.($page_now+1).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now+2).'">'.($page_now+2).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now+3).'">'.($page_now+3).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now+4).'">'.($page_now+4).'</a></li>';
			}elseif($page_now == "2"){
				echo '<li><a href="'.$link_page.'&page='.($page_now-1).'">'.($page_now-1).'</a></li>';
				echo '<li class="active"><span aria-hidden="true">'.$page_now.'</span></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now+1).'">'.($page_now+1).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now+2).'">'.($page_now+2).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now+3).'">'.($page_now+3).'</a></li>';
			}elseif($page_now > "2" AND $page_now < ($maximun_page-1)){
				echo '<li><a href="'.$link_page.'&page='.($page_now-2).'">'.($page_now-2).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now-1).'">'.($page_now-1).'</a></li>';
				echo '<li class="active"><span aria-hidden="true">'.$page_now.'</span></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now+1).'">'.($page_now+1).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now+2).'">'.($page_now+2).'</a></li>';
			}elseif($page_now == ($maximun_page-1)){
				echo '<li><a href="'.$link_page.'&page='.($page_now-3).'">'.($page_now-3).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now-2).'">'.($page_now-2).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now-1).'">'.($page_now-1).'</a></li>';
				echo '<li class="active"><span aria-hidden="true">'.$page_now.'</span></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now+1).'">'.($page_now+1).'</a></li>';
			}else{
				echo '<li><a href="'.$link_page.'&page='.($page_now-4).'">'.($page_now-4).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now-3).'">'.($page_now-3).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now-2).'">'.($page_now-2).'</a></li>';
				echo '<li><a href="'.$link_page.'&page='.($page_now-1).'">'.($page_now-1).'</a></li>';
				echo '<li class="active"><span aria-hidden="true">'.$page_now.'</span></li>';
			}
		}
			
		if($page_now>=$maximun_page)
		{
			echo '<li class="disabled"><span aria-hidden="true">&raquo;</span></li>';
		}else{
			echo '<li><a href="'.$link_page.'&page='.($page_now+1).'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
		}
		
			echo '</ul>';
			echo '</nav>';
	}
}

?>