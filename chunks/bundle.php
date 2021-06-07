<?php
// Bundle file
?>

<script
    defer
    async
    src="<?php echo $url; ?>?ver=<?php echo ENDERECO_CLIENT_VERSION; ?>"
    onload="if(typeof enderecoLoadAMSConfig === 'function'){enderecoLoadAMSConfig();}"
></script>
