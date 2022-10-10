<?php

function clear_data($data)
{
	return trim(htmlspecialchars($data));
}  


if(isset($_POST["limit"], $_POST["start"]))
{

	$start=clear_data($_POST['start']);
	$limit=clear_data($_POST['limit']);

	if(is_numeric($start) and is_numeric($limit))
	{
		include "db.php";

		$sorgu = $baglanti->prepare('SELECT * FROM makale ORDER BY id DESC LIMIT :start, :max');
		$sorgu->bindValue(':start', (int) $start, PDO::PARAM_INT);
		$sorgu->bindValue(':max', (int) $limit, PDO::PARAM_INT);
		$sorgu->execute();


		if($sorgu->rowCount()>0)
		{

			while ($veri=$sorgu->fetch(PDO::FETCH_ASSOC)) {
				?>


				<div class="card w-100 mb-3">
					<div class="card-body">
						<h5 class="card-title"><?=$veri['baslik']?></h5>
						<p class="card-text"><?=$veri['aciklama']?></p>
					</div>
					<div class="card-footer text-right">
						<button class="btn btn-primary btn-detail" style="width: 150px;">
							Detay <i class="fas fa-angle-double-right"></i> 
						</button>
					</div>
				</div>

			<?php	} ?>

			<div class="row spinner mt-5 mb-5">
				<div class="col text-center">
					<i class="fas fa-spinner fa-spin fa-3x"></i>

				</div>
			</div>

			<?php 
		}
		else
		{
			?>
			<div class="row completed mt-5 mb-5"> 
				<div class="col text-center"> 
					<div class="alert alert-primary"> Tüm Veriler Yüklendi</div>
				</div> 
			</div>
			<?php 
		}
	}
	else
	{
		?>

		<div class="row mt-5 mb-5"> 
			<div class="col text-center"> 
				<div class="alert alert-danger"> Hata!</div>
			</div> 
		</div>


		<?php 
	}
}

?>





