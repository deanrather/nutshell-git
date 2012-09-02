<?php $this->displayMessages(); ?>
<h1>Versions</h1>
<div class="container">
	<div class="row-fluid">
		<div class="span12">
			
			<style>
				#git-versions ul {margin:0; padding:0}
				#git-versions span { display:inline-block; }
				#git-versions li { list-style:none; margin:0; padding:0}
				#git-versions .log .type	{ width:8%; font-weight: bold}
				#git-versions .log .message	{ width:66%;}
				#git-versions .log .date	{ width:13%;}
				#git-versions .log .author	{ width:11%;}
			</style>
			
			<div id="git-versions">
				<?php foreach($this->versions as $version): ?>
				
				<h2><?php echo $version['name']; ?></h2>
				<ul id="git-log">
					<?php foreach($version['logs'] as $log): ?>
					<li class="log">
						<span class="type"><?php echo $log['type']; ?></span>
						<span class="message"><?php echo $log['message']; ?></span>
						<span class="date"><?php echo $log['datetime']; ?></span>
						<span class="author"><?php echo $log['author']; ?></span>
					</li>
					<?php endforeach; // logs ?>
				</ul>
				
				<?php endforeach; // versions ?>
			</div>
			
			
			
		</div>
	</div>
</div>
