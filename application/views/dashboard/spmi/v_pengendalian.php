<div class="content-wrapper">
	<section class="content">
		<h1>
			<center>PENGENDALIAN</center>
		</h1>

		<?php
		if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
		?>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example2" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="1%">NO</th>
											<th>Nama Pengaturan</th>
											<th>Tautan</th>
											<th>Fakultas</th>
											<th>Jurusan</th>
											<th>Tanggal ditetapkan</th>
											<th>Status</th>
											<th>Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($auditor as $a) {
										?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $a->pengendalian_judul; ?></td>
												<td>

													<a href="<?php echo base_url() . '/dokumen/spmi/pengendalian/' . $a->pengendalian_file; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-file"></i> <?php echo $a->pengendalian_file; ?></a>

												</td>
												<td><?php echo $a->fakultas_nama; ?></td>
												<td><?php echo $a->prodi_nama; ?></td>
												<td><?php echo $a->pengendalian_tanggal; ?></td>
												<td>
													<?php
													if ($a->pengendalian_status == "terverifikasi") {
														echo "<span class='badge bg-success'>Terverifikasi</span>";
													} else {
														echo "<span class='badge bg-danger'>Belum Terverifikasi</span>";
													}
													?>

												</td>
												<td>
													<!-- <?php
															// cek apakah penggun yang login adalah penulis
															if ($this->session->userdata('level') == "verifikator") {
																// jika penulis, maka cek apakah penulis artikel ini adalah si pengguna atau bukan
																if ($this->session->userdata('id') == $a->user) {
															?>
															<a href="<?php echo base_url() . 'spmi/penetapan_edit/' . $a->penetapan_id; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> </a>
													<input type="submit" name="status" value="Verifikasi" class="btn btn-success btn-block">
														<?php
																}
															} else {
																// jika yang login adalah admin
														?>
														<a href="<?php echo base_url() . 'spmi/penetapan_edit/' . $a->penetapan_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
														<a href="<?php echo base_url() . 'spmi/penetapan_hapus/' . $a->penetapan_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
													<?php
															}
													?> -->
													<?php
													if ($this->session->userdata('level') == "verifikator") {
													?>
														<a href="<?php echo base_url() . 'spmi/pengendalian_edit/' . $a->pengendalian_id; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> Verifikasi</a>
														<a href="<?php echo base_url() . 'spmi/pengendalian_tolak/' . $a->pengendalian_id; ?>" class="btn btn-danger btn-sm"> <i class="fas fa-times"></i> Tolak</a>
													<?php
													}
													?>
													<?php
													if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor") {
													?>
														<a href="<?php echo base_url() . 'spmi/peningkatan_tambah/' . $a->pengendalian_id; ?>" class="btn btn-success btn-sm"> <i class="fa fa-file"></i> Peningkatan</a>
														<a href="<?php echo base_url() . 'spmi/pengendalian_edit/' . $a->pengendalian_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
														<a href="<?php echo base_url() . 'spmi/pengendalian_hapus/' . $a->pengendalian_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
													<?php
													}
													?>
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
		<?php
		}
		?>
		<?php
		if ($this->session->userdata('level') == "auditee") {
		?>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example2" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="1%">NO</th>
											<th>Nama Pengaturan</th>
											<th>Tautan</th>
											<th>Tanggal ditetapkan</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($auditee as $a) {
										?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $a->pengendalian_judul; ?></td>
												<td>

													<a href="<?php echo base_url() . '/dokumen/spmi/pengendalian/' . $a->pengendalian_file; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-file"></i> <?php echo $a->pengendalian_file; ?></a>

												</td>
												<td><?php echo $a->pengendalian_tanggal; ?></td>
												<td>
													<?php
													if ($a->pengendalian_status == "Terverifikasi") {
														echo "<span class='badge bg-success'>Terverifikasi</span>";
													} elseif ($a->pengendalian_status == "Ditolak") {
														echo "<span class='badge bg-danger'>Ditolak</span>";
													} else {
														echo "<span class='badge bg-danger'>Belum Terverifikasi</span>";
													}
													?>
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
		<?php
		}
		?>

	</section>

</div>