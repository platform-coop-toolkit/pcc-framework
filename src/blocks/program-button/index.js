const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { TextControl } = wp.components;

const programButton = registerBlockType( 'pcc/program-button', {
	title: 'Program',
	description: 'Link to an event’s program page',
	icon: 'calendar',
	category: 'widgets',
	attributes: {
		label: {
			default: __( 'See the full program', 'pcc-framework' ),
			type: 'string',
		},
	},
	styles: [
		{
			name: 'default',
			label: __( 'Default' ),
			isDefault: true,
		},
	],
	edit: ( { attributes, setAttributes, isSelected } ) => {
		const onChangeLabel = ( value ) => {
			setAttributes( { label: value ? value : programButton.attributes.label.default } );
		};

		let blockUI;

		if ( isSelected ) {
			blockUI =
				<div className="wp-block-button">
					<TextControl
						label={ __( 'Label', 'pcc-framework' ) }
						value={ attributes.label }
						onChange={ onChangeLabel }
					/>
				</div>;
		} else {
			blockUI =
				<div className="wp-block-button">
					<a className="wp-block-button__link" href="program">{ attributes.label }</a>
				</div>;
		}

		return blockUI;
	},
	save: () => {
		return null;
	},
} );
