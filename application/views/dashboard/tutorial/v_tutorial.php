<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Tutorial
			<small>Manajemen Halaman Website</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">

				<a href="<?php echo base_url() . 'dashboard/tutorial_tambah'; ?>" class="btn btn-sm btn-primary">Buat halaman baru</a>

				<br />
				<br />

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Halaman</h3>
					</div>
					<div class="card-body">
						<table id="example2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Judul</th>
									<th>Link</th>
									<th width="15%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($tutorial as $h) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $h->tutorial_judul; ?></td>
										<td><?php echo $h->tutorial_link; ?></td>
										<td>
											<a href="<?php echo base_url() . 'dashboard/tutorial_edit/' . $h->tutorial_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
											<a href="<?php echo base_url() . 'dashboard/tutorial_hapus/' . $h->tutorial_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>


					</div>
				</div>

			</div>
		</div>

	</section>

</div>