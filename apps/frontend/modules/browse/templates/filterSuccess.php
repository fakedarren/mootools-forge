<div class="row">	
	<h3>Browse</h3>	
	<form action="<?php echo url_for('@browse') ?>" method="get" accept-charset="utf-8" class="well">
		<?php echo $form['search']->renderLabel('Name') ?>
		<?php echo $form['search']->render() ?>
		<?php echo $form['official']->renderLabel('Official') ?>
		<?php echo $form['official']->render() ?>
		<?php echo $form['category']->renderLabel('Category') ?>
		<?php echo $form['category']->render() ?>
		<?php echo $form['sort']->renderLabel('Sort') ?>
		<?php echo $form['sort']->render() ?>
		<ul>
			<li class="input_submit"><input type="submit" value="Filter" id="submit_filter" />
			<?php if ($params->count() && !$form->getValue('tag')): ?>
			<?php echo link_to('Clear', '@browse') ?>
			<?php endif ?>
			</li>
			<?php if ($form->getValue('tag')): ?>
	 		<li><br />Filtering by tag: <strong><?php echo $form->getValue('tag') ?></strong>. <?php echo link_to('Clear', '@browse') ?></li>
			<?php endif ?>
		</ul>
		<?php echo $form['tag']->render(); ?>
		<?php if ($form->hasGlobalErrors()): ?>
		<ul class="form-global-errors error_list">
		<?php foreach ($form->getGlobalErrors() as $name => $error): ?>
		<li><?php echo $error ?></li>
		<?php endforeach; ?>
		</ul>
		<?php endif; ?>
		<?php echo $form['search']->renderError() ?>		
	</form>
	<?php if ($pager->getResults()->count()): ?>
	<div class="row">
		<ul>
			<?php foreach ($pager->getResults() as $i => $plugin): ?>
			<?php include_partial('plugin/bit', array('plugin' => $plugin, 'i' => $i, 'search' => $form->getValue('search'))) ?>
			<?php endforeach ?>
		</ul>
	</div>
	<?php if($pager->haveToPaginate()): ?>
	<div class="pagination">
		<ul>
	  	<?php foreach ($pager->getLinks() as $page): ?>
	    <?php if ($page == $pager->getPage()): ?>
	      	<li class="active"><a href="#"><?php echo $page ?></a></li>
	    <?php else: ?>
	    	<li><?php echo link_to($page, 'browse', array_merge(array_filter($form->getValues()), array('page' => $page))); ?></li>
	    <?php endif; ?>
	  	<?php endforeach; ?>
		</ul>  
	</div>
	<?php endif ?>
	<?php else: ?>
	<p>No projects to show.</p>
	<?php endif ?>	
</div>