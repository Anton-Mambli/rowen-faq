$(function() {
    $('.js-accordion-trigger').on('click', function() {
        var $this        = $(this);
        var accordionNum = $this.data('trigger');
        $this.toggleClass('active');
        $('.js-accordion.trigger_' + accordionNum).slideToggle(250)
    });

});