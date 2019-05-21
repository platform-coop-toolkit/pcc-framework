const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
// const { date } = wp.date;
const { /* DateTimePicker, */ TextareaControl, TextControl } = wp.components;

registerBlockType( 'pcc/event-data', {
	title: 'Event Data',
	icon: 'calendar-alt',
	category: 'common',

	attributes: {
		// start: {
		//   type: 'integer',
		//   source: 'meta',
		//   meta: 'pcc_event_start',
		// },
		// end: {
		//   type: 'integer',
		//   source: 'meta',
		//   meta: 'pcc_event_end',
		// },
		venueName: {
			type: 'string',
			source: 'meta',
			meta: 'pcc_event_venue',
		},
		venueAddress: {
			type: 'string',
			source: 'meta',
			meta: 'pcc_event_venue_address',
		},
		registrationUrl: {
			type: 'string',
			source: 'meta',
			meta: 'pcc_event_registration_url',
		},
	},

	edit( { className, setAttributes, attributes } ) {
		// function updateStart( start ) {
		//   setAttributes( { start: date( 'U', start ) } );
		// }

		// function updateEnd( end ) {
		//   setAttributes( { end: date( 'U', end ) } );
		// }

		function updateVenueName( venueName ) {
			setAttributes( { venueName } );
		}

		function updateVenueAddress( venueAddress ) {
			setAttributes( { venueAddress } );
		}

		function updateRegistrationUrl( registrationUrl ) {
			setAttributes( { registrationUrl } );
		}

		return (
			<div className={ className }>
				{ /* <DateTimePicker
					label={ __( 'Start', 'platformcoop-support' ) }
					currentDate={ date( 'c', attributes.start ) }
					onChange={ updateStart }
					is12Hour={ false }
				/>
				<DateTimePicker
					label={ __( 'End', 'platformcoop-support' ) }
					currentDate={ date( 'c', attributes.end ) }
					onChange={ updateEnd }
					is12Hour={ false }
				/> */ }
				<TextControl
					label={ __( 'Venue', 'platformcoop-support' ) }
					value={ attributes.venueName }
					onChange={ updateVenueName }
				/>
				<TextareaControl
					label={ __( 'Venue Address', 'platformcoop-support' ) }
					value={ attributes.venueAddress }
					onChange={ updateVenueAddress }
				/>
				<TextControl
					label={ __( 'Registration Link', 'platformcoop-support' ) }
					value={ attributes.registrationUrl }
					onChange={ updateRegistrationUrl }
				/>
			</div>
		);
	},

	save() {
		return null;
	},
} );
