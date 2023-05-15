<div class="content-wrapper">
	<section class="content">
		<center>
			<h1>Fakultas & Prodi</h1>
		</center>
		<!-- <a href="<?php echo base_url() . 'dashboard/kategori_tambah'; ?>" class="btn btn-sm btn-primary">Buat Kategori baru</a> -->
		<br />
		<br />
		<div class="tab-content">
			<div class="row">
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><b>Fakultas</b></h3>
							<div class="float-right">
								<a href="<?php echo base_url() . 'dashboard/fakultas_tambah'; ?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Tambah Fakultas</a>
							</div>
						</div>
						<div class="card-body">
							<table id="example2" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Fakultas</th>
										<th width="20%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($fakultas as $k) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $k->fakultas_nama; ?></td>
											<td>
												<a href="<?php echo base_url() . 'dashboard/fakultas_edit/' . $k->fakultas_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
												<a href="<?php echo base_url() . 'dashboard/fakultas_hapus/' . $k->fakultas_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><b>Prodi</b></h3>
							<div class="float-right">
								<a href="<?php echo base_url() . 'dashboard/prodi_tambah'; ?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Tambah Prodi</a>
							</div>
						</div>
						<div class="card-body">
							<table id="example3" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Prodi</th>
										<th>Fakultas</th>
										<th width="20%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($prodi as $k) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $k->prodi_nama; ?></td>
											<td><?php echo $k->fakultas_nama; ?></td>
											<td>
												<a href="<?php echo base_url() . 'dashboard/prodi_edit/' . $k->prodi_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
												<a href="<?php echo base_url() . 'dashboard/prodi_hapus/' . $k->prodi_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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