<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pengguna
			<small>Pengguna Website</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">

				<a href="<?php echo base_url() . 'dashboard/pengguna_tambah'; ?>" class="btn btn-sm btn-primary">Buat pengguna baru</a>

				<br />
				<br />

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Pengguna</h3>
					</div>
					<div class="card-body">
						<table id="example2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Username</th>
									<th>Level</th>
									<th>Status</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($pengguna as $p) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $p->nama; ?></td>
										<td><?php echo $p->email; ?></td>
										<td><?php echo $p->username; ?></td>
										<td><?php echo $p->level; ?></td>
										<td>
											<?php
											if ($p->status == 1) {
												echo "Aktif";
											} else {
												echo "Non Aktif";
											}
											?>
										</td>
										<td>
											<a href="<?php echo base_url() . 'dashboard/pengguna_edit/' . $p->id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
											<a href="<?php echo base_url() . 'dashboard/pengguna_hapus/' . $p->id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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