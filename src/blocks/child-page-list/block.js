const { registerBlockType } = wp.blocks;
const { select } = wp.data;
const { ServerSideRender } = wp.components;

import SelectPage from '../../components/select-page';

registerBlockType( 'pcc/child-page-list', {
    title: 'Child Pages',
    icon: 'megaphone',
	category: 'widgets',
	attributes: {
		parent: {
			type: 'number'
		}
	},

    edit: (props) => {
		const { attributes, isSelected } = props;
		const { parent } = attributes;

		setAttributes( { current: Number( post_id ) } );

		// Render block UI
		let blockUI;

		if ( ! parent ) {
			blockUI = <SelectPage { ... { ...props } } />;
		} else {
			blockUI = (
				<div className={ !! isSelected ? `isSelected` : '' } >
					<ServerSideRender block="pcc/child-page-list" attributes={ attributes } />
				</div>
			);
		}

		return blockUI;
	},

	save: () => {
		return null;
	}
} );

