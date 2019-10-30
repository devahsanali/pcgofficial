<!-- Success Alert -->
<div class="alert alert-icon-info alert-dismissible" id="success" style="display: none; {{ (session('success')) ? 'display: block;' : ''}}" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<div class="alert-icon icon-part-info">
	<i class="icon-info"></i>
	</div>
	<div class="alert-message">
	  <span id="success-text">{{(session('success')) ? session('success')[0] : '' }}</span>
	</div>
</div>

<!-- Fail alert -->
<div class="alert alert-icon-danger alert-dismissible" id="fail" style="display: none; {{ ($errors->any()) ? 'display: block;' : ''}}" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<div class="alert-icon icon-part-danger">
	 <i class="icon-close"></i>
	</div>
	<div class="alert-message">
	  <span id="fail-text">{{ ($errors->any()) ? $errors->first() : ''}}</span>
	</div>
</div>