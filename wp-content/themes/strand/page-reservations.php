<?php 
/*
Template Name: Reservations Template
*/

$check_in= $_POST['check-in'];
$check_out = $_POST['check-out'];
$adults = $_POST['adults']; 
?>
<style>
	#header-wrapper, #footer-wrapper, #copyright-wrapper {
		display: none;
	}	 
</style>
<?php get_header(); ?>
<?php get_footer(); ?>
<script>
	$('document').ready(function(){
		checkAvailability('WBE', '<?php echo $check_in; ?>', '<?php echo $check_out; ?>', '<?php echo $adults; ?>');
	});
</script>