<div class="content-wrapper">
	<section class="content">
		<h1>Aplikasi</h1>
		<a href="<?php echo base_url() . 'dashboard/aplikasi_tambah'; ?>" class="btn btn-sm btn-primary">Buat Aplikasi baru</a>
		<br />
		<br />
		<div class="tab-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Aplikasi</h3>
						</div>
						<div class="card-body">
							<table id="example2" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Aplikasi</th>
										<th>Slug</th>
										<th>Untuk</th>
										<th>Link</th>
										<th width="10%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($aplikasi as $k) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $k->nama_aplikasi; ?></td>
											<td><?php echo $k->slug_aplikasi; ?></td>
											<td><?php echo $k->nama_kategori; ?></td>
											<td><?php echo $k->link_aplikasi; ?></td>
											<td>
												<a href="<?php echo base_url() . 'dashboard/aplikasi_edit/' . $k->id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
												<a href="<?php echo base_url() . 'dashboard/aplikasi_hapus/' . $k->id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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