const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const ServerSideRender = wp.serverSideRender;

/**
 * Internal dependencies
 */
import SelectPage from './components/select-page';

registerBlockType( 'pcc/child-pages', {
	title: 'Child Pages',
	description: 'Generate a list of child pages in various formats',
	icon: 'networking',
	category: 'blocks',
	attributes: {
		exclude: {
			type: 'integer',
		},
		parent: {
			type: 'integer',
		},
	},
	styles: [
		{
			name: 'card',
			label: __( 'Card' ),
		},
		{
			name: 'card-with-excerpt',
			label: __( 'Card with Excerpt' ),
			isDefault: true,
		},
		{
			name: 'text-only',
			label: __( 'Text Only' ),
		},
	],
	edit: ( props ) => {
		const { attributes, isSelected } = props;

		let blockUI;

		if ( isSelected ) {
			blockUI = <SelectPage { ... { ...props } } />;
		} else {
			blockUI = <ServerSideRender block="pcc/child-pages" attributes={ attributes } />;
		}

		return blockUI;
	},
	save: () => {
		return null;
	},
} );
