<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Tutorial
			<small>Edit Tutorial</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url() . 'dashboard/tutorial'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br />
		<br />

		<?php foreach ($tutorial as $h) { ?>

			<form method="post" action="<?php echo base_url('dashboard/tutorial_update') ?>">
				<div class="row">
					<div class="col-lg-12">

						<div class="card">
							<div class="card-body">


								<div class="card-body">
									<div class="form-group">
										<label>Judul Tutorial</label>
										<input type="hidden" name="id" value="<?php echo $h->tutorial_id; ?>">
										<input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Tutorial.." value="<?php echo $h->tutorial_judul; ?>">
										<br />
										<?php echo form_error('judul'); ?>
									</div>
								</div>

								<div class="card-body">
									<div class="form-group">
										<label>Link Tutorial</label>
										<input type="hidden" name="id" value="<?php echo $h->tutorial_id; ?>">
										<input type="text" name="link" class="form-control" placeholder="Masukkan Link Tutorial.." value="<?php echo $h->tutorial_link; ?>">
										<br />
										<?php echo form_error('link'); ?>
									</div>
								</div>

								<div class="card-body">
									<div class="form-group">
										<label>Konten</label>
										<?php echo form_error('konten'); ?>
										<br />
										<textarea class="form-control" id="summernote" name="konten"> <?php echo $h->tutorial_konten; ?> </textarea>
									</div>
								</div>

								<input type="submit" name="status" value="Publish" class="btn btn-success btn-block">

							</div>
						</div>

					</div>

				</div>
			</form>
		<?php } ?>

	</section>

</div>