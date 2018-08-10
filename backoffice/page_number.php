<div align="right">
	<ul class="pagination pagination-sm">
		<li>
			<a href="<?=$_SERVER["PHP_SELF"]?>?page=1&text=<?=$_GET[text]?>">
				<i class="fa fa-angle-left"></i>
			</a>
		</li>
		<?php for($i=1;$i<=$total_page;$i++){ ?>
		<li <?php if($_GET[page]==$i){echo "class=\"active\"";}?>>
			<a href="<?=$_SERVER["PHP_SELF"]?>?page=<?=$i?>&text=<?=$_GET[text]?>"> <?=$i?> </a>
		</li>
		<?php } ?>
		<li>
			<a href="<?=$_SERVER["PHP_SELF"]?>?page=<?=$total_page?>&text=<?=$_GET[text]?>">
				<i class="fa fa-angle-right"></i>
			</a>
		</li>
	</ul>
</div>