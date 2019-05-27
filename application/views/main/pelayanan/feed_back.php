<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
<div class="container">
<div class="row">
	<div class="col-md-3">
		<?php include('menu.php'); ?>
	</div>
	<div class="col-md-9">
		<?php 
			if($this->session->get('ERROR') != null){
		?>
			<div class="alert alert-danger" role="alert" >
				<?php echo $this->session->get('ERROR'); ?>
			</div>
		<?php
				$this->session->delete('ERROR');
			}
		?>
		<?php 
			if($this->session->get('SUCCESS') != null){
		?>
			<div class="alert alert-success" role="alert" >
				<?php echo $this->session->get('SUCCESS'); ?>
			</div>
		<?php
				$this->session->delete('SUCCESS');
			}
		?>
		<div class="menu-left-head">
			<h5> <strong>Survei</strong> kepuasan Pasien</h5>
			<form id="form" class="form-signin" method="POST" autocomplete="off" action="<?php echo base_url()?>pelayanan/saveFeedback">
			<div class="menu-left" style="padding: 10px;">
				<div class="form-group row">
					<div class="col-md-3">
						<label for="gelar">Email :</label>
					</div>
					<div class="col-md-4">
						<input type="email" class="form-control" name="email">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="gelar">Nomor Telepon :</label>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control" name="phone" required>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="gelar">Nama :</label>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control" name="nama" required>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="kdFaskes">Deskripsi :</label>
					</div>
					<div class="col-md-4">
						<textarea class="form-control" name="deskripsi" required></textarea>
					</div>
				</div>
				<div class="menu-left-head sub">
					<strong>Ratting</strong>
					<div class="menu-left" style="padding: 10px;">
						<div class="form-group row">
							<div class="col-md-3">
								<label for="gelar">Kenyamanan Fasilitas :</label>
							</div>
							<div class="col-md-4">
								<input type="number" class="rating form-control" name="kenyamanan" data-min="1" data-max="5" value="3" required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label for="gelar">Keramahan Petugas/Dokter :</label>
							</div>
							<div class="col-md-4">
								<input type="number" class="rating" id="test" name="keramahan" data-min="1" data-max="5" value="3" required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label for="gelar">Keterjangkauan Biaya :</label>
							</div>
							<div class="col-md-4">
								<input type="number" class="rating" id="test" name="keterjangkauan" data-min="1" data-max="5" value="3" required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label for="gelar">Kecepatan Respon :</label>
							</div>
							<div class="col-md-4">
								<input type="number" class="rating" id="test" name="kecepatan" data-min="1" data-max="5" value="3" required>
							</div>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-success">Kirim</button>
			</div>
			</form>
		</div>	
	</div>
</div>
</div>
<script>
	(function ($) {

	  $.fn.rating = function () {

	    var element;

	    // A private function to highlight a star corresponding to a given value
	    function _paintValue(ratingInput, value) {
	      var selectedStar = $(ratingInput).find('[data-value=' + value + ']');
	      selectedStar.removeClass('glyphicon-star-empty').addClass('glyphicon-star');
	      selectedStar.prevAll('[data-value]').removeClass('glyphicon-star-empty').addClass('glyphicon-star');
	      selectedStar.nextAll('[data-value]').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
	    }

	    // A private function to remove the selected rating
	    function _clearValue(ratingInput) {
	      var self = $(ratingInput);
	      self.find('[data-value]').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
	      self.find('.rating-clear').hide();
	      self.find('input').val('').trigger('change');
	    }

	    // Iterate and transform all selected inputs
	    for (element = this.length - 1; element >= 0; element--) {

	      var el, i, ratingInputs,
	        originalInput = $(this[element]),
	        max = originalInput.data('max') || 5,
	        min = originalInput.data('min') || 0,
	        clearable = originalInput.data('clearable') || null,
	        stars = '';

	      // HTML element construction
	      for (i = min; i <= max; i++) {
	        // Create <max> empty stars
	        stars += ['<span class="glyphicon glyphicon-star-empty" data-value="', i, '"></span>'].join('');
	      }
	      // Add a clear link if clearable option is set
	      if (clearable) {
	        stars += [
	          ' <a class="rating-clear" style="display:none;" href="javascript:void">',
	          '<span class="glyphicon glyphicon-remove"></span> ',
	          clearable,
	          '</a>'].join('');
	      }

	      el = [
	        // Rating widget is wrapped inside a div
	        '<div class="rating-input">',
	        stars,
	        // Value will be hold in a hidden input with same name and id than original input so the form will still work
	        '<input type="hidden" name="',
	        originalInput.attr('name'),
	        '" value="',
	        originalInput.val(),
	        '" id="',
	        originalInput.attr('id'),
	        '" />',
	        '</div>'].join('');

	      // Replace original inputs HTML with the new one
	      originalInput.replaceWith(el);

	    }

	    // Give live to the newly generated widgets
	    $('.rating-input')
	      // Highlight stars on hovering
	      .on('mouseenter', '[data-value]', function () {
	        var self = $(this);
	        _paintValue(self.closest('.rating-input'), self.data('value'));
	      })
	      // View current value while mouse is out
	      .on('mouseleave', '[data-value]', function () {
	        var self = $(this);
	        var val = self.siblings('input').val();
	        if (val) {
	          _paintValue(self.closest('.rating-input'), val);
	        } else {
	          _clearValue(self.closest('.rating-input'));
	        }
	      })
	      // Set the selected value to the hidden field
	      .on('click', '[data-value]', function (e) {
	        var self = $(this);
	        var val = self.data('value');
	        self.siblings('input').val(val).trigger('change');
	        self.siblings('.rating-clear').show();
	        e.preventDefault();
	        false
	      })
	      // Remove value on clear
	      .on('click', '.rating-clear', function (e) {
	        _clearValue($(this).closest('.rating-input'));
	        e.preventDefault();
	        false
	      })
	      // Initialize view with default value
	      .each(function () {
	        var val = $(this).find('input').val();
	        if (val) {
	          _paintValue(this, val);
	          $(this).find('.rating-clear').show();
	        }
	      });

	  };

	  // Auto apply conversion of number fields with class 'rating' into rating-fields
	  $(function () {
	    if ($('input.rating[type=number]').length > 0) {
	      $('input.rating[type=number]').rating();
	    }
	  });

	}(jQuery));
</script>