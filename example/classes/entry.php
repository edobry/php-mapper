<?php

class Entry {
	public $author;
	public $content;
	public $timestamp;
	public $comments;

	public function populate($_author, $_content, $_timestamp, $_comments) {
		$this->author = $_author;
		$this->content = $_content;
		$this->timestamp = $_timestamp;
		$this->comments = $_comments;

		// $this.$author = $Mapper.query(new Entry(), "SELECT * FROM <table>", []);
	}
	
	function render() {
	?>
	<div class="entry"> 
		<span class="entry_author">
			<?=$this->author?>
		</span>
		wrote
		<div class="entry_content">
			<?=$this->content?>
		</div>
		<span class="entry_timestamp">
			<?=$this->timestamp?>
		</span>
	</div>
	<?php
	}
}

?>