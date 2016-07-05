<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>MVC</title>
    <?php if (count($css)): ?>
    <style>
        <?php foreach ($css as $path): ?>
        @import '<?php print l($path); ?>';
        <?php endforeach; ?>
    </style>
    <?php endif; ?>
    <script type="text/javascript">
        window['MVC'] = <?php print json_encode($js['settings']); ?>;
    </script>
    <?php foreach ($js['head'] as $path): ?>
        <script src="<?php print l($path); ?>"></script>
    <?php endforeach; ?>

</head>
<body>
<?php foreach ($js['top'] as $path): ?>
    <script src="<?php print l($path); ?>"></script>
<?php endforeach; ?>
<?php print $page; ?>
<?php foreach ($js['bottom'] as $path): ?>
    <script src="<?php print l($path); ?>"></script>
<?php endforeach; ?>
</body>
</html>
