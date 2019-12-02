const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { TextControl } = wp.components;

const participantsButton = registerBlockType( 'pcc/participants-button', {
	title: 'Participants',
	description: 'Link to an event’s participants page',
	icon: 'groups',
	category: 'blocks',
	attributes: {
		label: {
			default: __( 'View all participants', 'pcc-framework' ),
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
			setAttributes( { label: value ? value : participantsButton.attributes.label.default } );
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
					<a className="wp-block-button__link" href="participants">{ attributes.label }</a>
				</div>;
		}

		return blockUI;
	},
	save: () => {
		return null;
	},
} );
