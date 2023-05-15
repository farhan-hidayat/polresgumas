<div class="content-wrapper">
	<section class="content">
		<h1>Kategori</h1>
		<a href="<?php echo base_url() . 'dashboard/kategori_tambah'; ?>" class="btn btn-sm btn-primary">Buat Kategori baru</a>
		<br />
		<br />
		<div class="tab-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Kategori</h3>
						</div>
						<div class="card-body">
							<table id="example2" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Kategori</th>
										<th>Slug</th>
										<th>Untuk</th>
										<th width="10%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($kategori as $k) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $k->nama_kategori; ?></td>
											<td><?php echo $k->slug_kategori; ?></td>
											<td><?php echo $k->ket_kategori; ?></td>
											<td>
												<a href="<?php echo base_url() . 'dashboard/kategori_edit/' . $k->id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
												<a href="<?php echo base_url() . 'dashboard/kategori_hapus/' . $k->id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>