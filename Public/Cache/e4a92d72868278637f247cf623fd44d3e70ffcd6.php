<html>
<head>
    <title><?php echo e($title); ?></title>
</head>
<body>
<?php $__currentLoopData = $page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    id : <?php echo e($page->page_id); ?><br>
    Title : <?php echo e($page->page_title); ?><br>
    <b><?php echo e($page->page_content); ?></b>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html>