import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { TextControl } from '@wordpress/components';
import { withSelect, withDispatch } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import { isURL } from '@wordpress/url';
// import { apiFetch } from '@wordpress/api-fetch';
// import { addFilter } from '@wordpress/hooks';
// import { Fragment } from '@wordpress/element';
// import { Autocomplete } from '@wordpress/components';


// GET
// apiFetch( { path: '/pcc-framework/v1/story-orgs/', method: 'GET', parse: true} ).then( results => {
// 		console.log (results);
// } ).catch( e => { console.log (e);
// });

// addFilter( 'altis-publishing-workflow.item.image-texts', 'pcc-framework/test', () => {
// 	return props => {
// 		return (
// 			<Fragment>
// 				{ props.renderStatusIcon() }
// 				<a href="http://example.com/">{ props.message }</a>
// 			</Fragment>
// 		);
// 	};
// } );

let PluginMetaFields = ( props ) => {

	return (
		<>
			<TextControl
				value={ props.pcc_story_name }
				label={ __( 'Custom Post Author', 'pcc-framework' ) }
				onChange={(value)=>props.onChangeName(value)}
			/>

			<TextControl
				value={ props.pcc_story_organization }
				label={ __( 'Organization', 'pcc-framework' ) }
				onChange={(value)=>props.onChangeOrganization(value)}
			/>

			<TextControl
				value={ props.pcc_story_video_link }
				label={ __( 'Video Link', 'pcc-framework' ) }
				onChange={ (value) => props.onChangeVideoLink(value)}
			/>
		</>
	);
};

PluginMetaFields = withSelect( ( select ) => {
	return {
		pcc_story_video_link: select( 'core/editor' ).getEditedPostAttribute('meta').pcc_story_video_link,
		pcc_story_organization: select('core/editor').getEditedPostAttribute('meta').pcc_story_organization,
		pcc_story_name: select('core/editor').getEditedPostAttribute('meta').pcc_story_name,
	};
} )( PluginMetaFields );


PluginMetaFields = withDispatch( ( dispatch ) => {
	const setLock = (lockName, condition) => {
		if (condition) {
			dispatch('core/editor').unlockPostSaving(lockName);
		} else {
			dispatch('core/editor').lockPostSaving(lockName);
		}
	};

	return {
		onChangeVideoLink: ( video_link_value ) => {
			dispatch( 'core/editor' ).editPost( {
				meta: { pcc_story_video_link: video_link_value },
			} );

			setLock ('requiredVideoLock', isURL(video_link_value));
		},

		onChangeOrganization: ( organization_value ) => {
			dispatch('core/editor').editPost( {
				meta: {pcc_story_organization: organization_value }
			} );

			setLock ('requiredOrganizationLock', organization_value);
		},

		onChangeName: ( name_value ) => {
			dispatch('core/editor').editPost( {
				meta: {pcc_story_name: name_value }
			} );

			setLock ('requiredNameValue', name_value);
		},
	};
} )( PluginMetaFields );

registerPlugin( 'pcc-story', {
	icon: 'microphone',
	render: () => {
		return (
			<>
				<PluginDocumentSettingPanel
					title={ __( 'Story Data', 'pcc-framework' ) }
				>
					<PluginMetaFields />
				</PluginDocumentSettingPanel>
			</>
		);
	},
} );
