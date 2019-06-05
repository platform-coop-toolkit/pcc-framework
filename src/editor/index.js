/**
 * Internal dependencies
 */
import editorConfig from './config.json';

wp.domReady( () => {
	editorConfig.unregisterBlocks.forEach( ( block ) => {
		wp.blocks.unregisterBlockType( block );
	} );
} );
