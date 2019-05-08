/**
	 * External dependencies
	 */
	import { isUndefined } from 'lodash';

	/**
	 * WordPress dependencies
	 */
	const { __ } = wp.i18n;
	const { withSelect } = wp.data;
	const { SelectControl, Placeholder, Spinner } = wp.components;

	/**
	 * Render page select UI
	 */
	const pageOptionsDefault = { value: '0', label: __( '-- Select Page --' ) };

	const SelectPage = ( { pages, attributes, setAttributes } ) => {
		// Attributes
		const { prevId } = attributes;

		// Event(s)
		const getPageOptions = () => {
			// Add API Data To Select Options

			let pageOptions = [];

			if ( ! isUndefined( pages ) ) {
				pageOptions = pages.map(
					( { id, title: { rendered: title } } ) => {
						return {
							value: id,
							label: title === '' ? `${ id } : ${ __( 'No page title' ) }` : title,
						};
					}
				);
			}
			// Add Default option
			pageOptions.unshift( pageOptionsDefault );

			return pageOptions;
		};

		const setPageIdTo = id => {
			setAttributes( { parent: Number( id ) } );
		};

		// Render Component UI
		let componentUI;

		if ( ! pages ) {
			componentUI = <Placeholder><Spinner/></Placeholder>;
		} else if ( pages && pages.length === 0 ) {
			componentUI = <div></div>;
		} else {
			componentUI = (
				<div>
					<SelectControl
						className="give-blank-slate__select"
						options={ getPageOptions() }
						onChange={ setPageIdTo }
					/>
				</div>
			);
		}

		return componentUI;
	};

	/**
	 * Export with pages data
	 */
	export default withSelect( ( select ) => {
		const query = {
            per_page: -1,
            orderby: 'menu_order',
            order: 'asc',
        }
		return {
			pages: select( 'core' ).getEntityRecords( 'postType', 'page', query ),
		};
	} )( SelectPage );
