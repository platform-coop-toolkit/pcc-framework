const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Path, SVG, TextControl } = wp.components;

const socialLinks = registerBlockType( 'pcc/social-links', {
	title: 'Social Links',
	description: 'Links to Facebook and Twitter',
	icon: 'share',
	category: 'widgets',
	attributes: {
		label_facebook: {
			default: __( 'Platform Cooperativism – Discussion & Linkshare', 'pcc-framework' ),
			type: 'string',
		},
		label_twitter: {
			default: __( 'Platform Co-op Development Kit', 'pcc-framework' ),
			type: 'string',
		},
	},
	styles: [
		{
			name: 'default',
			label: __( 'Default' ),
			isDefault: true,
		},
		{
			name: 'icon-only',
			label: __( 'Icon Only' ),
		},
	],
	edit: ( { attributes, setAttributes, className, isSelected } ) => {
		const networks = [
			{
				label: attributes.label_facebook,
				url: '#',
				icon: <SVG className="social-links__icon" width="35" height="35"viewBox="0 0 35 35" xmlns="http://www.w3.org/2000/svg" >
					<Path fill="currentColor" transform="translate(-3 -4)" d="M18.03,31.02h3.934V21.5h2.624l.348-3.281H21.964l0-1.643c0-.855.082-1.314,1.309-1.314h1.64V11.98H22.292c-3.153,0-4.262,1.592-4.262,4.268v1.97H16.064V21.5H18.03ZM20.5,39A17.5,17.5,0,1,1,38,21.5,17.5,17.5,0,0,1,20.5,39Z" />
				</SVG>,
			},
			{
				label: attributes.label_twitter,
				url: '#',
				icon: <SVG className="social-links__icon" width="35" height="35" viewBox="0 0 35 35" xmlns="http://www.w3.org/2000/svg">
					<Path fill="currentColor" transform="translate(-3.723 -5.157)" d="M21.224,5.157a17.5,17.5,0,1,0,17.5,17.5A17.5,17.5,0,0,0,21.224,5.157Zm8.815,13.972c.009.189.013.379.013.571A12.544,12.544,0,0,1,10.743,30.267a9.019,9.019,0,0,0,1.052.061,8.848,8.848,0,0,0,5.477-1.888,4.417,4.417,0,0,1-4.119-3.064,4.307,4.307,0,0,0,.829.079,4.383,4.383,0,0,0,1.162-.154,4.414,4.414,0,0,1-3.539-4.324c0-.019,0-.038,0-.057a4.4,4.4,0,0,0,2,.552,4.416,4.416,0,0,1-1.365-5.889,12.521,12.521,0,0,0,9.091,4.607,4.413,4.413,0,0,1,7.515-4.022,8.809,8.809,0,0,0,2.8-1.07,4.423,4.423,0,0,1-1.94,2.44,8.817,8.817,0,0,0,2.534-.694A8.91,8.91,0,0,1,30.039,19.129Z" />
				</SVG>,
			},
		];

		const onChangeLabelFaceBook = ( value ) => {
			setAttributes( { label_facebook: value ? value : socialLinks.attributes.label_facebook.default } );
		};

		const onChangeLabelTwitter = ( value ) => {
			setAttributes( { label_twitter: value ? value : socialLinks.attributes.label_twitter.default } );
		};

		let blockUI;

		if ( isSelected ) {
			blockUI =
				<div className={ className }>
					<TextControl
						label={ __( 'Facebook Label', 'pcc-framework' ) }
						value={ attributes.label_facebook }
						onChange={ onChangeLabelFaceBook }
					/>
					<TextControl
						label={ __( 'Twitter Label', 'pcc-framework' ) }
						value={ attributes.label_twitter }
						onChange={ onChangeLabelTwitter }
					/>
				</div>;
		} else {
			blockUI =
				<ul className={ className }>
					{ networks.map( ( item, index ) => (
						<li key={ index } className="social-links__item">
							<a className="social-links__link" rel="external" href={ item.url }>{ item.icon }<span className="social-links__label">{ item.label }</span></a>
						</li>
					) ) }
				</ul>;
		}

		return blockUI;
	},
	save: () => {
		return null;
	},
} );
