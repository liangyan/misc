<?php require_once("structs/header.php"); ?>

<div class="page-header">
	<h1>Daily Input <small>fill in the blanks</small></h1>
</div>

<form id="main" method="post" action="save-form.php" autocomplete="off">
	
	<label><i class="icon-flag"></i> Location</label>
	<label class="radio inline">
		<input type="radio" name="location" value="#1: Ros">
		Ros
	</label>
	<label class="radio inline">
		<input type="radio" name="location" value="#2: Mar">
		Mar
	</label>
	<label class="radio inline">
		<input type="radio" name="location" value="#3: Nor">
		Nor
	</label>
	<label class="radio inline">
		<input type="radio" name="location" value="#4: Ken">
		Ken
	</label>

	<label><i class="icon-calendar"></i> Date</label>
	<input type="text" class="datepicker" name="date" required>

	<label><i class="icon-shopping-cart"></i> Server and Sales</label>
	<?php for ($i = 0; $i < 15; $i++): ?>
		<div class="input-prepend input-append">
			<span class="add-on">server #</span>
			<input class="input-mini numeric" type="text" name="servers[<?php echo $i; ?>][no]">
			<span class="add-on">sales $</span>
			<input class="input-mini numeric server-sales" type="text" name="servers[<?php echo $i; ?>][sales]">
		</div>
	<?php endfor; ?>
	<hr>

	<label><i class="icon-plus"></i> Total Sales</label>
	<div class="input-prepend input-append">
		<span class="add-on">$</span>
		<input class="input-mini numeric" required type="text" name="total-sales" id="total-sales" data-sum="0">
	</div>
	<span class="help-inline text-error hide wrong-number" style="color: red;">Wrong number</span>

	<label><i class="icon-user"></i> Did you have more than one person using same CC #?</label>
	<label class="radio inline">
		<input type="radio" name="more-than-one-person" value="yes">
		Yes
	</label>
	<label class="radio inline">
		<input type="radio" name="more-than-one-person" value="no">
		No
	</label>

	<label><i class="icon-pencil"></i> If yes, what # and who were the people?</label>
	<textarea rows="3" class="input-xxlarge" name="comments"></textarea>
	
	<label><i class="icon-comment"></i> Any special notes for today regarding CC info?</label>
	<textarea rows="3" class="input-xxlarge" name="notes"></textarea>

	<div class="form-actions">
		<button class="btn btn-large btn-primary" type="submit"> Submit</button>
		<input  class="btn btn-large" type="reset" value="Reset Form">
	</div>
</form>

<?php require_once("structs/footer.php"); ?>