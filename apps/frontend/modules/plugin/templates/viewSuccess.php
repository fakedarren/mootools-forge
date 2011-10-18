<?php use_helper('Text') ?>
<?php use_helper('XssSafe') ?>

<?php $raw = $sf_data->getRaw('plugin'); ?>
<div class="block" id="project">
	<h2 class="green"><span><?php echo $plugin->getTitle() ?>
	<?php if ($plugin->getStableTag()): ?><em class="version"><?php echo $plugin->getStableTag()->getName() ?></em><?php endif ?>
	</span></h2>

	<div class="block" id="project-desc">
		<?php if ($plugin->getScreenshot()): ?><p id="thumb"><a href="<?php echo url_for_screenshot($plugin->getScreenshot()) ?>" class="remooz"><span class="project_thumb"><?php echo thumbnail_for($plugin) ?></span></a></p><?php endif; ?>
		<?php echo esc_xsssafe($raw->getDescription()); ?>
	</div>

	<hr />

	<div id="plugin-links" class="link-boxes block">
		<?php if ($plugin->getDocsUrl()): ?>
		<a href="<?php echo $plugin->getDocsUrl() ?>">Docs</a>
		<?php endif; ?>
		<?php if ($plugin->getDemourl()): ?>
		<a href="<?php echo $plugin->getDemourl() ?>">Demo</a>
		<?php endif; ?>

    <?php if ($plugin->getStableTag()): ?>
		<?php echo link_to('Download', 'download', array('project' => $plugin->getSlug(), 'tag' => $plugin->getStableTag()->getName())) ?>
    <?php endif ?>

		<?php if ($sf_user->isAuthenticated() && $sf_user->ownsPlugin($plugin)): ?>
		<?php echo link_to('Update', '@pluginupdate?slug=' . $plugin->getSlug(), array('id' => 'plugin-update')) ?>
		<?php endif ?>
	</div>

	<?php if ($sf_user->isAuthenticated() && $sf_user->ownsPlugin($plugin)): ?>
	<form action="<?php echo url_for('plugin/add') ?>" method="post" accept-charset="utf-8" id="update-form" class="block">
		<input type="hidden" name="id" value="<?php echo $plugin->getSlug() ?>" />
	</form>
	<?php endif ?>

	<hr />

	<div class="block span-8 colborder">
		<h3 class="blue"><span>Details</span></h3>

		<dl class="table">
			<dt>Author</dt>
			<dd><?php echo link_to($plugin->getAuthor()->getFullname(), 'user', array('username' => $plugin->getAuthor()->getUsername())) ?></dd>

			<?php if ($plugin->getStableTag()): ?>
			<dt>Current version</dt>
			<dd><?php echo $plugin->getStableTag()->getName() ?></dd>
			<?php endif ?>

			<dt>GitHub</dt>
			<?php $github = sprintf('%s/%s', $plugin->getGithubuser(), $plugin->getGithubrepo()); ?>
			<dd><a href="http://github.com/<?php echo $github; ?>/"><?php echo $github ?></a></dd>

			<dt>Downloads</dt>
			<dd><?php echo $plugin->getDownloadsCount() ?></dd>

			<?php if ($plugin->getCategory()): ?>
			<dt>Category</dt>
			<dd><?php echo link_to($plugin->getCategory()->getTitle(), 'browse', array('category' => $plugin->getCategory()->getSlug())) ?></dd>
			<?php endif ?>

			<?php if ($termsTags->count() > 0): ?>
			<dt>Tags</dt>
			<dd id="plugin-tags">
				<ul class="tags-list">
					<?php foreach ($termsTags as $term): ?>
					<?php $term = $term->getTerm(); ?>
					<li><?php echo link_to($term, 'browse', array('tag' => $term->getSlug())) ?></li>
					<?php endforeach ?>
				</ul>
			</dd>
			<?php endif ?>

			<dt>Report</dt>
			<dd><a href="http://github.com/<?php echo $github; ?>/issues">GitHub Issues</a></dd>

			<?php if ($sf_user->hasCredential('admin')): ?>
			<dt>Admin</dt>
			<dd><?php echo link_to('Delete', 'plugindelete', array('slug' => $plugin->getSlug()), array('id' => 'plugin-delete')) ?></dd>
			<?php endif ?>
		</dl>
	</div>

	<div class="block span-8 last">
		<h3 class="blue"><span>Releases</span></h3>
		<ul class="versions-list">
			<?php foreach($tags as $tag): ?>
				<li><?php echo link_to($tag->getName(), 'download', array('project' => $plugin->getSlug(), 'tag' => $tag->getName())) ?></li>
			<?php endforeach ?>
		</ul>

		<?php if ($dependencies->count()): ?>
		<hr />

		<h3 class="blue"><span>Dependencies</span></h3>

		<ul>
			<?php $deps = array(); ?>
			<?php foreach ($dependencies as $dep): ?>
				<?php if ($dep->getPluginTag()):
					$plugin = $dep->getPluginTag()->getPlugin();
				?>
				<li><?php echo link_to($plugin->getSlug() . '/' . $dep->getVersion(), 'plugin', array('slug' => $plugin->getSlug())) ?></li>
				<?php else:
					if (!isset($deps[$dep->getScope() . '/' . $dep->getVersion()]))
						$deps[$dep->getScope() . '/' . $dep->getVersion()] = array();
					$deps[$dep->getScope() . '/' . $dep->getVersion()][] = $dep->getComponent();
				?>
				<?php endif ?>
			<?php endforeach ?>

			<?php foreach ($deps as $scope => $components):
				$components = array_unique($components);
			?>
			<li>
				<?php echo $scope ?>:

				<?php if (sizeof($components) == 1): ?>
				<?php echo $components[0] ?>
				<?php else: ?>
				<ul>
					<?php foreach ($components as $component): ?>
					<li><?php echo $component ?></li>
					<?php endforeach ?>
				</ul>
				<?php endif ?>
			</li>
			<?php endforeach ?>
		</ul>
		<?php endif ?>

	</div>

	<hr class="clear" />

	<div class="block section">
		<h3 class="blue"><span>How to use</span></h3>

		<?php echo esc_xsssafe($raw->getHowtouse()); ?>
	</div>

	<?php if ($sections->count()): ?>
	<?php foreach ($sections as $section): ?>
	<hr />
	<div class="block section">
		<h3 class="blue"><span><?php echo $section->getTitle(); ?></span></h3>
		<?php echo esc_xsssafe($section->getRawValue()->getContent()); ?>
	</div>
	<?php endforeach ?>
	<?php endif ?>

	<?php if ($screenshots->count()): ?>
	<hr />

	<div class="block section">
		<h3 class="blue"><span>Screenshots</span></h3>

		<ul class="screenshots-list">
			<?php foreach ($screenshots as $screenshot): ?>
			<li><a href="<?php echo url_for_screenshot($screenshot) ?>" title="<?php echo $screenshot->getTitle() ?>" class="remooz"><?php echo thumbnail_for($screenshot) ?></a></li>
			<?php endforeach ?>
		</ul>
	</div>
	<?php endif ?>

	<div class="block section">
		<h3 class="blue"><span>Discuss</span></h3>
		<p class="about" style="color: #700"><strong>A note on comments here</strong>: These comments are moderated. No comments will show up until they are approved. Comments that are not productive (i.e. inflammatory, rude, etc) will not be approved.
		</p>
		<p><b>Important: Bugs should be posted to <a href="http://github.com/<?php echo $github; ?>/issues">this repository's github issues page</a>, not in the comments below.</b></p>
		<style>
			ul#dsq-comments {
				max-height:800px !important;
				overflow:auto !important;
				padding:0 10px 0 0 !important;
			}
		</style>
		<div id="disqus_thread"></div>
		<script type="text/javascript">
		    var disqus_shortname = 'mootoolsforge';

		    /* * * DON'T EDIT BELOW THIS LINE * * */
		    (function() {
		        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
		        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		    })();
		</script>
		<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		<a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
	</div>
</div>