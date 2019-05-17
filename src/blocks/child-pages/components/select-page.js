import { isUndefined } from 'lodash';

const { __ } = wp.i18n;
const { withSelect } = wp.data;
const { SelectControl, Placeholder, Spinner } = wp.components;

const pageDefault = { value: '0', label: __( '-- Select Page --' ) };

const SelectPage = ( { pages, attributes, setAttributes, className } ) => {
  const { parent } = attributes;

  const getPageOptions = () => {
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
    pageOptions.unshift( pageDefault );

    return pageOptions;
  };

  const setParentIdTo = parent => {
    setAttributes( { parent: Number( parent ) } );
  };

  let componentUI;

  if ( ! pages ) {
    componentUI = <Placeholder><Spinner/></Placeholder>;
  } else if ( pages && pages.length === 0 ) {
    componentUI = (
      <div className={ className }>
        <p><em>{ __('No pages found.') }</em></p>;
      </div>
    );
  } else {
    componentUI = (
      <div className={ className }>
        <SelectControl
          label={ __('Parent Page') }
          value={ parent }
          options={ getPageOptions() }
          onChange={ setParentIdTo }
        />
      </div>
    );
  }

  return componentUI;
}

export default withSelect( ( select ) => {
  return {
    pages: select( 'core' ).getEntityRecords( 'postType', 'page', { per_page: -1, orderby: 'menu_order' } ),
  };
} )( SelectPage );
