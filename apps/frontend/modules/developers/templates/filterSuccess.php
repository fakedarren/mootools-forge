<?php use_helper('Text') ?>
<div class="row">	
	<h3>Developers</h3>	
	
	<form action="<?php echo url_for('@developers') ?>" method="get" accept-charset="utf-8">
		<?php echo $form['search']->renderLabel('Name') ?>
		<?php echo $form['search']->render() ?>	
		<?php echo $form['with_plugins']->renderLabel('With plugins') ?>
		<?php echo $form['with_plugins']->render() ?></li>	
		<input type="submit" value="Filter" id="submit_filter" />
		<?php if ($params->count()): ?>
		<?php echo link_to('Clear', '@developers') ?>
		<?php endif ?>
		<?php echo $form['search']->renderError() ?>
	</form>
	
	<?php if ($pager->getResults()->count()): ?>
	<div class="row">
		<ul class="thumbnails">
			<?php foreach ($pager->getResults() as $author): ?>
			<li class="span3">
				<a href="<?php echo url_for('user', array('username' => $author->getUsername())) ?>">
					<span class="avatar"><?php echo avatar_for($author) ?></span>
					<span class="name"><?php echo highlight_text($author->getFullName(), $form->getValue('search')) ?></span>
					<?php if ($author->getPluginsCount()): ?><span class="badge"><?php echo $author->getPluginsCount() ?></span><?php endif ?>
				</a>
			</li>			
			<?php endforeach ?>
		</ul>
	</div>
	
	<?php if($pager->haveToPaginate()): ?>
	
	<?php
	    $noprev = !$pager->getPreviousPage() || ($pager->getPreviousPage() == $pager->getPage());
	    $nonext = !$pager->getNextPage() || ($pager->getNextPage() == $pager->getPage());
	?>
	<div class="pagination">
		<ul>
			<?php if ($noprev): ?>				
			<li class="disabled"><a href="#">Previous</a></li>
			<?php else: ?>
			<li><?php echo link_to('Previous', 'developers', array_merge(array_filter($form->getValues()), array('page' => $pager->getPreviousPage()))); ?></li>	
			<?php endif ?>
 			<?php if ($nonext): ?>				
			<li class="disabled"><a href="#">Next</a></li>
			<?php else: ?>
			<li><?php echo link_to('Next', 'developers', array_merge(array_filter($form->getValues()), array('page' => $pager->getNextPage()))); ?></li>	
			<?php endif ?>			
		</ul>
	</div>
	<?php endif ?>
	<?php else: ?>
	<p>No developers to show.</p>
	<?php endif ?>
	
</div>