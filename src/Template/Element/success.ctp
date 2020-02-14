<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message success" onclick="this.classList.add('hidden')" style="color:green;"><?= $message ?> 
<span><img src="<?= PATH.'img/close-button.svg'; ?>" ></span></div>

<script type="text/javascript">
$(document).ready(function () {
		$('.success').fadeIn('slow').delay(4000).fadeOut(); 
});
</script>