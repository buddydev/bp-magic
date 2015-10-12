/**
 * Progressive enhancement
 */

jQuery( document ).ready( function () {

	var jq = jQuery;

	/**** Page Load Actions *******************************************************/
	jq( "#container select, :radio,:checkbox,:file" ).uniform( {
		selectClass: 'uni-selector',
		radioClass: 'uni-radio',
		checkboxClass: 'uni-checker',
		fileClass: 'uni-uploader',
		filenameClass: 'uni-filename',
		fileBtnClass: 'uni-action',
		fileDefaultText: 'No file selected',
		fileBtnText: 'Choose File',
		checkedClass: 'uni-checked',
		focusClass: 'uni-focus',
		disabledClass: 'uni-disabled',
		buttonClass: 'uni-button',
		activeClass: 'uni-active',
		hoverClass: 'uni-hover',
		useID: true,
		idPrefix: 'uniform',
		resetSelector: false,
		autoHide: true
	} );


	function select_to_list( $select ) {


	}

	//enhance post lists for multilevel list
	jq( '.post li ol' ).parent().addClass( 'has-list-elements' );
	//multi step form
	// jq('.register-section').addClass('step');
	/*
	 number of fieldsets
	 */
	//to manipulate the registration form
	jq( '#custom-registration-step' ).prev().append( jq( '#custom-registration-step' ) );
	//ok progressive enhancement

	jq( '.multistep-form' ).each( function () {
		var mform = jq( this );//the multi step form
		var current_tab = null;//which li is currently selected/clicked


		//current step
		var current = 1;
		//an step is a slide here
		//set the width of steps div by adding total step width

		var no_of_step = mform.find( '.step' ).length;

		if ( no_of_step < 2 ) {
			return;
		}

		//let us clone the submit button and append to each step

		var submit = mform.find( '.submit' );
		//hide the submit button if this is not the last step
		submit.hide();//hide submit button

		var prev_next = jq( "<div></div>" ).attr( 'id', 'previous-next' ).addClass( 'prev-next clearfix' );
		var prev_anchor = jq( "<a href='#' class='btn btn-prev'>Prev</a>" );
		var next_anchor = jq( "<a href='#' class='btn btn-next'>Next</a>" );
		//for each step
		mform.find( '.step' ).each( function ( index, val ) {

			var x = prev_next.clone();
			jq( this ).append( x );
			
			if ( index == 0 ) {
				//add next button
				x.append( next_anchor.clone() );
			} else if ( index == no_of_step - 1 ) {
				//add a previous button
				x.append( prev_anchor.clone() );
				var ap = submit.clone();
				x.append( ap.show() );
			} else {
				//add both prev/next button

				x.append( prev_anchor.clone() );
				x.append( next_anchor.clone() );
			}
			//should not we add a prev/next functionality

		} );
		
		submit.hide();

		//find width of single step
		//assuming all step has same width, it may be a fallacy

		var step_width = jq( mform.find( '.step' ).get( 0 ) ).outerWidth();

		mform.find( '.steps' ).width( no_of_step * step_width );

		//jq('.mnavigation').show();
		//if there is no tab selected
		if ( !jq( '.mnavigation li.current' ).get( 0 ) ) {
			current_tab = jq( '.mnavigation li:first-child' );
			current_tab.addClass( 'current' );
		} else {
			current_tab = jq( jq( '.mnavigation li.current' ).get( 0 ) );
		}
		
		/*
		 when clicking on a navigation link
		 the form slides to the corresponding fieldset
		 */
		jq( '.mnavigation a' ).bind( 'click', function ( e ) {
			var $this = jq( this );
			var prev = current;
			$this.closest( 'ul' ).find( 'li' ).removeClass( 'current' );
			current_tab = $this.parent();
			current_tab.addClass( 'current' );
			/*
			 we store the position of the link
			 in the current variable
			 */
			current = $this.parent().index() + 1;
			/*
			 animate / slide to the next or to the corresponding
			 fieldset. The order of the links in the navigation
			 is the order of the fieldsets.
			 Also, after sliding, we trigger the focus on the first
			 input element of the new fieldset
			 If we clicked on the last link (confirmation), then we validate
			 all the fieldsets, otherwise we validate the previous one
			 before the form slided
			 */

			//is this the last step?
			//  if(current==no_of_step)
			//   mform.find('.submit').show();
			//else
			//   mform.find('.submit').hide();//keep it hidden

			mform.find( '.steps' ).stop().animate( {
				marginLeft: '-' + ( current - 1 ) * step_width + 'px'
			}, 500, function () {

				mform.children( ':nth-child(' + parseInt( current ) + ')' ).find( ':input:first' ).focus();
			} );
			e.preventDefault();
		} );


		mform.find( '.prev-next' ).on( 'click', 'a', function ( evt ) {

			if ( jq( this ).hasClass( 'btn-next' ) ) {
				current_tab.next().children( 'a' ).click();
			} else if ( jq( this ).hasClass( 'btn-prev' ) ) {
				current_tab.prev().children( 'a' ).click();
			}
			
			///scroll to the form begining if required
			jq.scrollTo( mform, 500, {
				offset: -125,
				easing: 'easeOutQuad'
			} );
			return false;
		} )
		//bind previous next


	} );//end of multistep form


} );//end of dom ready     
//uniform js/css

//further enhancement for drop down etc