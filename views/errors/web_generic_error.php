<?php
/**
 * Generic error page for errors on web. Note that this is NOT a full View model, and the template
 * and other classes are not available.
 * This view should be as simple as humanly possible to avoid any potential cascade in errors,
 *
 * @var Exception $e
 * @var array     $trace
 * @var string    $file
 * @var string    $line
 * @var string    $message
 * @var string    $code
 */

$config = Kohana::$config->load('errors');

if (!Kohana::message('errors', 'codes.'.$code.'.title'))
	$code = $config['default_error_code'];	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo Kohana::message('errors', 'codes.'.$code.'.title') ?></title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.my-page-header {margin-top: 50px;}
	</style>
</head>

<body>
	<!-- Begin page content -->
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-push-3">
				<div class="panel panel-danger my-page-header">
					<div class="panel-heading"><?php echo Kohana::message('errors', 'header_text') ?></div>
					<div class="panel-body">
						<p>
							<strong><?=($message AND !$config['show_alter_text_always']) ? HTML::chars($message) : Kohana::message('errors', 'codes.'.$code.'.alter_text')?></strong>
							<?php if ($class == "ORM_Validation_Exception"): $errors = $e->errors('validation'); print "<ul>"; foreach($errors as $error): ?>
							<small><li><?=HTML::chars($error)?></li></small>
							<?php endforeach; print "</ul>"; endif; ?>
						</p>
						<p><?php echo str_replace(':contact_email', $config['contact_email'], Kohana::message('errors', 'footer_text')) ?></p>
					</div>
					<?php if ((is_array($config['show_debug_info']) AND in_array(@$_SERVER['REMOTE_ADDR'], $config['show_debug_info'])) OR $config['show_debug_info'] === TRUE): ?>
					<div class="panel-footer">
						<p>
							<strong>Отладачная информация: </strong>
						</p>
						<p>
							<small><?php echo $class ?></small><br>
							<small><?php echo $message ?></small>
						</p>
						<ul>
						<li><?=Debug::path($file)?> [ <?=HTML::chars($line);?> ] </li>
							<?php foreach($trace as $step): ?>
								<li>
									<small>
									<?php if (isset($step['file'])): ?>
										<?php echo Debug::path($step['file']) ?> [ <?php echo $step['line'] ?> ]
									<?php else: ?>
										{'PHP internal call'}
									<?php endif ?>
									</small>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>

