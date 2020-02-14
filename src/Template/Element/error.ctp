<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div>
<style>
.error{
	color:red;	
    }
</style>

<script>
$('.message').fadeIn('slow').delay(5000).fadeOut();
</script>