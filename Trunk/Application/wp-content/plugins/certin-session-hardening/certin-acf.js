(function($){

    acf.add_action('ready append', function($el){

        // Get fields using ACF field names
        var fromField = acf.getField('blacklisted_from');
        var toField   = acf.getField('blacklisted_upto');

        if (!fromField || !toField) return;

        // When "from" date changes
        fromField.$input().on('change', function(){

            var fromDate = $(this).val();

            if (fromDate) {
                // Set minimum date for "to" field
                toField.$input().datepicker('option', 'minDate', fromDate);
            }
        });

    });

})(jQuery);