<?php 

		$dir = new Folder('./path/to/folder');

		$files = $dir->find('.*\.ctp');


	    foreach ($files as $file) {
	    $file = new File($dir->pwd() . DS . $file);
	    $contents = $file->read();
	     $file->write('I am overwriting the contents of this file');
	     $file->append('I am adding to the bottom of this file.');
	    // $file->delete(); // I am deleting this file
	    $file->close(); // Be sure to close the file when you're done
		}

		pr($dir);
	    pr($files);
	    pr($contents);
	    pr($file);
