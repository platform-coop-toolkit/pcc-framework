const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { ServerSideRender } = wp.components;

registerBlockType( 'pcc/recent-content', {
	title: __( 'Recent Content', 'pcc' ),
	description: __( 'Generate a grid of recent content from various sources', 'pcc' ),
	icon: 'screenoptions',
	category: 'widgets',
	edit: () => {
		return <ServerSideRender block="pcc/recent-content" />;
	},
	save: () => {
		return null;
	},
} );
