<div class="content-wrapper">
	<section class="content">
		<h1>
			<center>PENGATURAN/PENETAPAN</center>
		</h1>
		<?php
		if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor") {
		?>
			<a href="<?php echo base_url() . 'spmi/penetapan_tambah'; ?>" class="btn btn-sm btn-primary">Tambah File Baru</a>
		<?php
		}
		?>
		<br />
		<br />
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Standar Nasional Pendidikan Tinggi</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">Standar yang Ditetapkan Institusi</a></li>
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
												<th>Status</th>
												<?php
												if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
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
											foreach ($nasional as $a) {
											?>
												<tr>
													<td><?php echo $no++; ?></td>
													<td><?php echo $a->penetapan_judul; ?></td>
													<td>

														<a href="<?php echo base_url() . '/dokumen/spmi/penetapan/' . $a->penetapan_file; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-file"></i> <?php echo $a->penetapan_file; ?></a>

													</td>
													<td><?php echo $a->penetapan_tanggal; ?></td>
													<td>
														<?php
														if ($a->penetapan_status == "Terverifikasi") {
															echo "<span class='badge bg-success'>Terverifikasi</span>";
														} elseif ($a->penetapan_status == "Ditolak") {
															echo "<span class='badge bg-danger'>Ditolak</span>";
														} else {
															echo "<span class='badge bg-danger'>Belum Terverifikasi</span>";
														}
														?>
													</td>
													<?php
													if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
													?>
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
																<a href="<?php echo base_url() . 'spmi/penetapan_verif/' . $a->penetapan_id; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> Verifikasi</a>
																<a href="<?php echo base_url() . 'spmi/penetapan_tolak/' . $a->penetapan_id; ?>" class="btn btn-danger btn-sm"> <i class="fas fa-times"></i> Tolak</a>
															<?php
															}
															?>
															<?php
															if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor") {
															?>
																<a href="<?php echo base_url() . 'spmi/penetapan_edit/' . $a->penetapan_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
																<a href="<?php echo base_url() . 'spmi/penetapan_hapus/' . $a->penetapan_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
															<?php
															}
															?>
														</td>
													<?php
													}
													?>
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
												<th>Tautan</th>
												<th>Form</th>
												<th>Tanggal ditetapkan</th>
												<th>Status</th>
												<?php
												if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
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
											foreach ($institusi as $a) {
											?>
												<tr>
													<td><?php echo $no++; ?></td>
													<td><?php echo $a->penetapan_judul; ?></td>
													<td>

														<a href="<?php echo base_url() . '/dokumen/spmi/penetapan/' . $a->penetapan_file; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-file"></i> <?php echo $a->penetapan_file; ?></a>

													</td>
													<td>

														<a href="<?php echo base_url() . '/dokumen/spmi/penetapan/' . $a->penetapan_form; ?>" class="btn btn-sm btn-primary"> <i class="fa fa-file"></i> <?php echo $a->penetapan_form; ?></a>
														<?php
														if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor") {
														?>
															<a href="<?php echo base_url() . 'spmi/penetapan_form/' . $a->penetapan_id; ?>" class="btn btn-primary btn-sm"> <i class="fa fa-cog"></i> </a>
														<?php } ?>
													</td>
													<td><?php echo $a->penetapan_tanggal; ?></td>
													<td>
														<?php
														if ($a->penetapan_status == "Terverifikasi") {
															echo "<span class='badge bg-success'>Terverifikasi</span>";
														} elseif ($a->penetapan_status == "Ditolak") {
															echo "<span class='badge bg-danger'>Ditolak</span>";
														} else {
															echo "<span class='badge bg-danger'>Belum Terverifikasi</span>";
														}
														?>
													</td>
													<?php
													if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
													?>
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
																<a href="<?php echo base_url() . 'spmi/penetapan_verif/' . $a->penetapan_id; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> Verifikasi</a>
																<a href="<?php echo base_url() . 'spmi/penetapan_tolak/' . $a->penetapan_id; ?>" class="btn btn-danger btn-sm"> <i class="fas fa-times"></i> Tolak</a>
															<?php
															}
															?>
															<?php
															if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor") {
															?>
																<a href="<?php echo base_url() . 'spmi/penetapan_edit/' . $a->penetapan_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
																<a href="<?php echo base_url() . 'spmi/penetapan_hapus/' . $a->penetapan_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
															<?php
															}
															?>
														</td>
													<?php
													}
													?>
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
	</section>
</div>