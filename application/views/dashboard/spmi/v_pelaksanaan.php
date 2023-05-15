<div class="content-wrapper">
	<section class="content">
		<h1>
			<center>PELAKSANAAN</center>
		</h1>
		<?php
		if ($this->session->userdata('level') == "auditee") {
		?>
			<a href="<?php echo base_url() . 'spmi/pelaksanaan_tambah'; ?>" class="btn btn-sm btn-primary">Tambah File Baru</a>
		<?php
		}
		?>
		<br />
		<br />
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Form</a></li>
			<?php
			if ($this->session->userdata('level') == "auditee") {
			?>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">Pengajuan Form</a></li>
			<?php
			}
			?>
			<?php
			if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
			?>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu2">Pengajuan Form</a></li>
			<?php
			}
			?>
		</ul>
		<div class="tab-content">
			<div id="home" class="tab-pane fade show active">
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
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach ($institusi as $a) {
											?>
												<tr>
													<td><?php echo $no++; ?></td>
													<td><?php echo $a->penetapan_judul; ?></td>
													<td>
														<a href="<?php echo base_url() . '/dokumen/spmi/penetapan/' . $a->penetapan_form; ?>" class="btn btn-primary btn-sm"> <i class="fa fa-file"></i> Form-<?php echo $a->penetapan_form; ?></a>
													</td>
													<td><?php echo $a->penetapan_tanggal; ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="menu1" class="tab-pane fade">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example3" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width="1%">NO</th>
												<th>Nama Pengaturan</th>
												<th>Nama</th>
												<th>Tautan</th>
												<th>Tanggal Pengajuan</th>
												<th>Status</th>
												<?php
												if ($this->session->userdata('level') == "auditee") {
												?>
													<th>Opsi</th>
												<?php
												}
												?>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach ($auditee as $a) {
											?>
												<tr>
													<td><?php echo $no++; ?></td>
													<td><?php echo $a->pelaksanaan_judul; ?></td>
													<td><?php echo $a->penetapan_judul; ?></td>
													<td>
														<a href="<?php echo base_url() . '/dokumen/spmi/pelaksanaan/' . $a->pelaksanaan_file; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-file"></i> <?php echo $a->pelaksanaan_file; ?></a>
													</td>
													<td><?php echo $a->pelaksanaan_tanggal; ?></td>
													<td>
														<?php
														if ($a->pelaksanaan_status == "Terverifikasi") {
															echo "<span class='badge bg-success'>Terverifikasi</span>";
														} elseif ($a->pelaksanaan_status == "Ditolak") {
															echo "<span class='badge bg-danger'>Ditolak</span>";
														} else {
															echo "<span class='badge bg-danger'>Belum Terverifikasi</span>";
														}
														?>
													</td>
													<td>
														<?php
														if ($this->session->userdata('level') == "verifikator") {
														?>
															<a href="<?php echo base_url() . 'spmi/pelaksanaan_verif/' . $a->pelaksanaan_id; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> Verifikasi</a>
														<?php
														}
														?>
														<?php
														if ($this->session->userdata('level') == "auditee") {
														?>
															<a href="<?php echo base_url() . 'spmi/pelaksanaan_edit/' . $a->pelaksanaan_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
															<a href="<?php echo base_url() . 'spmi/pelaksanaan_hapus/' . $a->pelaksanaan_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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
			</div>
			<div id="menu2" class="tab-pane fade" id="custom-tabs-five-overlay">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example4" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width="1%">NO</th>
												<th>Nama</th>
												<th>Nama Pengaturan</th>
												<th>Tautan</th>
												<th>Fakultas</th>
												<th>Jurusan</th>
												<th>Tanggal Pengajuan</th>
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
													<td><?php echo $a->pelaksanaan_judul; ?></td>
													<td><?php echo $a->penetapan_judul; ?></td>
													<td>
														<a href="<?php echo base_url() . '/dokumen/spmi/pelaksanaan/' . $a->pelaksanaan_file; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-file"></i> <?php echo $a->pelaksanaan_file; ?></a>
													</td>
													<td><?php echo $a->fakultas_nama; ?></td>
													<td><?php echo $a->prodi_nama; ?></td>
													<td><?php echo $a->pelaksanaan_tanggal; ?></td>
													<td>
														<?php
														if ($a->pelaksanaan_status == "Terverifikasi") {
															echo "<span class='badge bg-success'>Terverifikasi</span>";
														} elseif ($a->pelaksanaan_status == "Ditolak") {
															echo "<span class='badge bg-danger'>Ditolak</span>";
														} else {
															echo "<span class='badge bg-danger'>Belum Terverifikasi</span>";
														}
														?>
													</td>
													<td>
														<?php
														if ($this->session->userdata('level') == "verifikator") {
														?>
															<a href="<?php echo base_url() . 'spmi/pelaksanaan_verif/' . $a->pelaksanaan_id; ?>" class="btn btn-success btn-sm"> <i class="fas fa-eye"></i> Verifikasi</a>
															<a href="<?php echo base_url() . 'spmi/pelaksanaan_tolak/' . $a->pelaksanaan_id; ?>" class="btn btn-danger btn-sm"> <i class="fas fa-times"></i> Tolak</a>
														<?php
														}
														?>
														<?php
														if ($this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "admin") {
														?>
															<a href="<?php echo base_url() . 'spmi/evaluasi_tambah/' . $a->pelaksanaan_id; ?>" class="btn btn-success btn-sm"> <i class="fa fa-file"></i> Evaluasi</a>
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
			</div>
		</div>
	</section>
</div>