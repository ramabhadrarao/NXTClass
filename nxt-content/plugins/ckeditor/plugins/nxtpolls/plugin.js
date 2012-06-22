/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'nxtpolls',
{
	init : function( editor )
	{
		// Register the toolbar buttons.
		editor.ui.addButton( 'nxtPolls',
			{
				label : 'Insert Poll',
				icon : this.path + 'images/poll.gif',
				command : 'nxtpolls'
			});

		// Register the commands.
		editor.addCommand( 'nxtpolls',
		{
			exec : function()
			{
				var pollId = insertPoll('visual', '');
				if (pollId)
					editor.insertText(pollId);
			}
		});
	}
});
