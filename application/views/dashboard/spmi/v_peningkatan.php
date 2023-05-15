<div class="content-wrapper">
	<section class="content">
		<h1>
			<center>PENINGKATAN</center>
		</h1>
		<?php
		if ($this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "admin") {
		?>
			<a href="<?php echo base_url() . 'spmi/peningkatan_tambah'; ?>" class="btn btn-sm btn-primary">Tambah File Baru</a>
		<?php
		}
		?>
		<br />
		<br />
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
												if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor") {
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
											foreach ($auditor as $a) {
											?>
												<tr>
													<td><?php echo $no++; ?></td>
													<td><?php echo $a->peningkatan_judul; ?></td>
													<td>

														<a href="<?php echo base_url() . '/dokumen/spmi/pelaksanaan/' . $a->peningkatan_file; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-file"></i> <?php echo $a->peningkatan_file; ?></a>

													</td>
													<td><?php echo $a->peningkatan_tanggal; ?></td>
													<td>
														<?php
														if ($a->peningkatan_status == "Terverifikasi") {
															echo "<span class='badge bg-success'>Terverifikasi</span>";
														} elseif ($a->peningkatan_status == "Ditolak") {
															echo "<span class='badge bg-danger'>Ditolak</span>";
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
															<a href="<?php echo base_url() . 'spmi/peningkatan_edit/' . $a->peningkatan_id; ?>" class="btn btn-success btn-sm"> <i class="fas fa-eye"></i> Verifikasi</a>
															<a href="<?php echo base_url() . 'spmi/peningkatan_edit/' . $a->peningkatan_id; ?>" class="btn btn-success btn-sm"> <i class="fas fa-times"></i> Tolak</a>
														<?php
														}
														?>
														<?php
														if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor") {
														?>
															<a href="<?php echo base_url() . 'spmi/peningkatan_edit/' . $a->peningkatan_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
															<a href="<?php echo base_url() . 'spmi/peningkatan_hapus/' . $a->peningkatan_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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
			<div id="menu1" class="tab-pane fade">

			</div>

		</div>

	</section>

</div>